<?php

namespace App\Http\Requests;

use App\Models\BookCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_category_create');
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
