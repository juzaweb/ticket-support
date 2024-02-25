<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\TicketSupport\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;
use Juzaweb\TicketSupport\Models\TicketSupportType;

class SubmitTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return apply_filters(
            'jwts.tickets.submit_rules',
            [
                'title' => ['required'],
                'content' => ['required'],
                'support_type_id' => ['required', Rule::modelExists(TicketSupportType::class)],
                'product_id' => ['nullable', Rule::modelExists(Post::class)],
                'files' => ['nullable', 'array'],
                'files.*' => ['required', 'file', 'max:5120', 'mimes:jpeg,jpg,png,gif,doc,pdf,xls,xlsx'],
            ]
        );
    }

    public function attributes(): array
    {
        return [
            'support_type_id' => __('Type'),
        ];
    }
}
