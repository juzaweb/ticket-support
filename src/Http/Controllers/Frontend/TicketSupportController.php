<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\TicketSupport\Http\Controllers\Frontend;

use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Juzaweb\CMS\Events\EmailHook;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Juzaweb\TicketSupport\Events\CreateTicketSupportSuccess;
use Juzaweb\TicketSupport\Http\Requests\Frontend\SubmitCommentRequest;
use Juzaweb\TicketSupport\Http\Requests\Frontend\SubmitTicketRequest;
use Juzaweb\TicketSupport\Http\Resources\TicketSupportCommentResource;
use Juzaweb\TicketSupport\Models\TicketSupport;
use Juzaweb\TicketSupport\Repositories\TicketSupportAttachmentRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportCommentRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportRepository;

class TicketSupportController extends FrontendController
{
    public function __construct(
        protected TicketSupportRepository $ticketSupportRepository,
        protected TicketSupportCommentRepository $ticketSupportCommentRepository,
        protected TicketSupportAttachmentRepository $ticketSupportAttachmentRepository
    ) {
    }

    public function submit(SubmitTicketRequest $request): JsonResponse|RedirectResponse
    {
        DB::transaction(fn() => $this->createTicketSupport($request));

        return $this->success(['message' => 'Ticket submit successful.']);
    }

    public function downloadAttachment(Request $request, string $id, int $attachmentId)
    {
        $ticket = $this->ticketSupportRepository->find($id);
        $attachment = $this->ticketSupportAttachmentRepository->withFilters(['ticket_support_id' => $id])->find($attachmentId);
        abort_if($ticket->created_by != $request->user()->id, 403);

        if (!File::isFile(Storage::disk('protected')->path($attachment->path))) {
            abort(404);
        }
        return Storage::disk('protected')->download($attachment->path);
    }

    public function comment(SubmitCommentRequest $request, string $id): JsonResponse|RedirectResponse
    {
        $ticket = $this->ticketSupportRepository->find($id);

        abort_if($ticket->created_by != $request->user()->id, 403);

        $comment = DB::transaction(
            function () use ($request, $id, $ticket) {
                $model = $this->ticketSupportCommentRepository->create(
                    [
                        'content' => $request->input('content'),
                        'ticket_support_id' => $id,
                    ]
                );

                $ticket->update(['status' => TicketSupport::STATUS_PENDING]);
                if ($files = $request->file('files')) {
                    foreach ($files as $file) {
                        $extension = $file->extension();
                        $originalFileName = $file->getClientOriginalName();
                        $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
                        $path = 'ticket-supports/'. date('Y/m/d');

                        $nameFile = $this->getUniqueFileUpload($path, $baseName, $extension);
                        $path = Storage::disk('protected')->putFileAs($path, $file, $nameFile);

                        $model->attachments()->create(
                            [
                                'ticket_support_id' => $id,
                                'path' => $path,
                                'name' => $originalFileName,
                                'extension' => $file->extension(),
                                'minetype' => $file->getMimeType(),
                            ]
                        );
                    }
                }

                event(
                    new EmailHook(
                        'ticket_support_comment',
                        [
                            'to' => [$model->user->email],
                            'params' => [
                                'name' => $model->user->name,
                                'email' => $model->user->email,
                                'ticket' => $ticket->title,
                            ],
                        ]
                    )
                );

                return $model;
            }
        );

        return $this->success(
            [
                'message' => 'Submit comment successful.',
                'comment' => TicketSupportCommentResource::make($comment),
            ]
        );
    }

    private function createTicketSupport(SubmitTicketRequest $request)
    {
        $model = $this->ticketSupportRepository->create(
            $request->safe()->all()
        );

        if ($files = $request->file('files')) {
            foreach ($files as $file) {
                $extension = $file->extension();
                $originalFileName = $file->getClientOriginalName();
                $baseName = pathinfo($originalFileName, PATHINFO_FILENAME);
                $path = 'ticket-supports/'. date('Y/m/d');

                $nameFile = $this->getUniqueFileUpload($path, $baseName, $extension);
                $path = Storage::disk('protected')->putFileAs($path, $file, $nameFile);

                $model->attachments()->create(
                    [
                        'path' => $path,
                        'name' => $originalFileName,
                        'extension' => $file->extension(),
                        'minetype' => $file->getMimeType(),
                    ]
                );
            }
        }

        event(new CreateTicketSupportSuccess($model));

        event(
            new EmailHook(
                'ticket_support_submited',
                [
                    'to' => [$model->user->email],
                    'params' => [
                        'name' => $model->user->name,
                        'email' => $model->user->email,
                        'ticket' => $model->title,
                    ],
                ]
            )
        );

        return $model;
    }

    private function getUniqueFileUpload(string $path, string $baseName, string $extension): string
    {
        $fileName = $baseName.'.'.$extension;
        $newFile = Storage::disk('protected')->path($path.'/'.$fileName);

        $i = 1;
        while (File::isFile($newFile)) {
            $fileName = $baseName.'-'.$i++.'.'.$extension;
            $newFile = Storage::disk('protected')->path($path.'/'.$fileName);
        }

        return $fileName;
    }
}
