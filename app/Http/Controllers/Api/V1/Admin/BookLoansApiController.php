<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookLoanRequest;
use App\Http\Requests\UpdateBookLoanRequest;
use App\Http\Resources\Admin\BookLoanResource;
use App\Models\BookLoan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookLoansApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_loan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookLoanResource(BookLoan::with(['user', 'book'])->get());
    }

    public function store(StoreBookLoanRequest $request)
    {
        $bookLoan = BookLoan::create($request->all());

        return (new BookLoanResource($bookLoan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookLoan $bookLoan)
    {
        abort_if(Gate::denies('book_loan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookLoanResource($bookLoan->load(['user', 'book']));
    }

    public function update(UpdateBookLoanRequest $request, BookLoan $bookLoan)
    {
        $bookLoan->update($request->all());

        return (new BookLoanResource($bookLoan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookLoan $bookLoan)
    {
        abort_if(Gate::denies('book_loan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookLoan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
