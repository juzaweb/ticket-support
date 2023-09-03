<?php

namespace Juzaweb\TicketSupport\Http\Controllers\Backend;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Abstracts\DataTable;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Juzaweb\TicketSupport\Http\Datatables\TicketSupportDatatable;
use Juzaweb\TicketSupport\Http\Requests\Backend\ReplyRequest;
use Juzaweb\TicketSupport\Models\TicketSupport;
use Juzaweb\TicketSupport\Repositories\TicketSupportCommentRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportRepository;
use Juzaweb\TicketSupport\Repositories\TicketSupportTypeRepository;

class TicketSupportController extends BackendController
{
    protected string $viewPrefix = 'jwts::backend.ticket_support';

    use ResourceController {
        getDataForForm as DataForForm;
    }

    public function __construct(
        protected TicketSupportRepository $ticketSupportRepository,
        protected TicketSupportTypeRepository $supportTypeRepository,
        protected TicketSupportCommentRepository $supportCommentRepository
    ) {
    }

    public function comment(ReplyRequest $request, $id): JsonResponse|RedirectResponse
    {
        $ticket = $this->ticketSupportRepository->find($id);

        $data = $request->only(['content']);
        $data['ticket_support_id'] = $id;

        $comment = DB::transaction(
            function () use ($data, $ticket) {
                $ticket->updateQuietly(['status' => TicketSupport::STATUS_REPLIED]);

                return $this->supportCommentRepository->create($data);
            }
        );

        $comment->load(['createdBy']);
        $comment->created_date = jw_date_format($comment->created_at);

        return $this->success(
            [
                'status' => true,
                'message' => 'Reply ticket successfull.',
                'comment' => $comment,
            ]
        );
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, ...$params);

        $data['supportTypes'] = $this->supportTypeRepository->all()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name]);
        $data['comments'] = $this->supportCommentRepository
            ->with(['createdBy'])
            ->scopeQuery(fn($q) => $q->where(['ticket_support_id' => $model->id]))
            ->paginate(10);

        return $data;
    }

    protected function getDataTable(...$params): DataTable
    {
        return TicketSupportDatatable::make();
    }

    protected function validator(array $attributes, ...$params): ValidatorContract
    {
        return Validator::make(
            $attributes,
            [
                'title' => ['required'],
                'content' => ['required'],
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return TicketSupport::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('Ticket supports');
    }
}
