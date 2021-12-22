<?php

namespace App\Http\Requests;

use App\Models\BookCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_category_edit');
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
