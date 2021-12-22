<?php

namespace App\Http\Requests;

use App\Models\BookCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:book_categories,id',
        ];
    }
}
