<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookLoanRequest;
use App\Http\Requests\StoreBookLoanRequest;
use App\Http\Requests\UpdateBookLoanRequest;
use App\Models\BookList;
use App\Models\BookLoan;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookLoansController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('book_loan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookLoan::with(['user', 'book'])->select(sprintf('%s.*', (new BookLoan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'book_loan_show';
                $editGate = 'book_loan_edit';
                $deleteGate = 'book_loan_delete';
                $crudRoutePart = 'book-loans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('book_uid', function ($row) {
                return $row->book ? $row->book->uid : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? BookLoan::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('expired_pay', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->expired_pay ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'book', 'expired_pay']);

            return $table->make(true);
        }

        return view('admin.bookLoans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('book_loan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $books = BookList::pluck('uid', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookLoans.create', compact('books', 'users'));
    }

    public function store(StoreBookLoanRequest $request)
    {
        $bookLoan = BookLoan::create($request->all());

        return redirect()->route('admin.book-loans.index');
    }

    public function edit(BookLoan $bookLoan)
    {
        abort_if(Gate::denies('book_loan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $books = BookList::pluck('uid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookLoan->load('user', 'book');

        return view('admin.bookLoans.edit', compact('bookLoan', 'books', 'users'));
    }

    public function update(UpdateBookLoanRequest $request, BookLoan $bookLoan)
    {
        $bookLoan->update($request->all());

        return redirect()->route('admin.book-loans.index');
    }

    public function show(BookLoan $bookLoan)
    {
        abort_if(Gate::denies('book_loan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookLoan->load('user', 'book');

        return view('admin.bookLoans.show', compact('bookLoan'));
    }

    public function destroy(BookLoan $bookLoan)
    {
        abort_if(Gate::denies('book_loan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookLoan->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookLoanRequest $request)
    {
        BookLoan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
