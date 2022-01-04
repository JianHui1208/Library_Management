<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookCategoryRequest;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BookCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('book_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BookCategory::query()->select(sprintf('%s.*', (new BookCategory())->table))->orderBy('id', 'DESC');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'book_category_show';
                $editGate = 'book_category_edit';
                $actionGate = 'book_category_edit';
                $deleteGate = 'book_category_delete';
                $crudRoutePart = 'book-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'actionGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? BookCategory::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bookCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('book_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookCategories.create');
    }

    public function store(StoreBookCategoryRequest $request)
    {
        $bookCategory = BookCategory::create($request->all());

        return redirect()->route('admin.book-categories.index');
    }

    public function edit(BookCategory $bookCategory)
    {
        abort_if(Gate::denies('book_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookCategories.edit', compact('bookCategory'));
    }

    public function update(UpdateBookCategoryRequest $request, BookCategory $bookCategory)
    {
        $bookCategory->update($request->all());

        return redirect()->route('admin.book-categories.index');
    }

    public function show(BookCategory $bookCategory)
    {
        abort_if(Gate::denies('book_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bookCategories.show', compact('bookCategory'));
    }

    public function destroy(BookCategory $bookCategory)
    {
        abort_if(Gate::denies('book_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookCategoryRequest $request)
    {
        BookCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function actions(Request $request)
    {
        $itemCategory = BookCategory::where('id', $request->input('id'))->first();

        if($itemCategory->status == 1){
            $itemCategory->status = 2;
        } else {
            $itemCategory->status = 1;
        }

        $itemCategory->save();

        Toastr::success('Book Category Status Updated Successfully','Success');
        return back();
    }
}
