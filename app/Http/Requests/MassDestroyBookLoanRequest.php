<?php

namespace App\Http\Requests;

use App\Models\BookLoan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookLoanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('book_loan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:book_loans,id',
        ];
    }
}
