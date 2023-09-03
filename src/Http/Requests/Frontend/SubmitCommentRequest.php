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

class SubmitCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required']
        ];
    }
}
