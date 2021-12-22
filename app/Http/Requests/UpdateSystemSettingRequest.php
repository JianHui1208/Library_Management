<?php

namespace App\Http\Requests;

use App\Models\SystemSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSystemSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('system_setting_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'key' => [
                'string',
                'required',
                'unique:system_settings,key,' . request()->route('system_setting')->id,
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
