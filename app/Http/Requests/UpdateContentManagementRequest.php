<?php

namespace App\Http\Requests;

use App\Models\ContentManagement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContentManagementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_management_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
