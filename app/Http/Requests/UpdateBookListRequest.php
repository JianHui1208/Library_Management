<?php

namespace App\Http\Requests;

use App\Models\BookList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_list_edit');
    }

    public function rules()
    {
        return [
            // 'uid' => [
            //     'string',
            //     'required',
            //     'unique:book_lists,uid,' . request()->route('book_list')->id,
            // ],
            'title' => [
                'string',
                'nullable',
            ],
            'book_tags.*' => [
                'integer',
            ],
            'book_tags' => [
                'array',
            ],
            'year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
