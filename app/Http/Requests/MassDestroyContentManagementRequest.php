<?php

namespace App\Http\Requests;

use App\Models\ContentManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyContentManagementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('content_management_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:content_managements,id',
        ];
    }
}
