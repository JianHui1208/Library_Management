<?php

namespace App\Http\Requests;

use App\Models\BookLoan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookLoanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('book_loan_edit');
    }

    public function rules()
    {
        return [
            'expired_time' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
