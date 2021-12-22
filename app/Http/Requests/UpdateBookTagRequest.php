<?php

namespace App\Http\Requests;

use App\Models\BookTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_tag_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
