<?php

namespace App\Http\Requests;

use App\Models\BookList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:book_lists,id',
        ];
    }
}
