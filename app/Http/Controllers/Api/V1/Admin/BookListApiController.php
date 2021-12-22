<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookListRequest;
use App\Http\Requests\UpdateBookListRequest;
use App\Http\Resources\Admin\BookListResource;
use App\Models\BookList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookListApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookListResource(BookList::with(['book_category', 'book_tags'])->get());
    }

    public function store(StoreBookListRequest $request)
    {
        $bookList = BookList::create($request->all());
        $bookList->book_tags()->sync($request->input('book_tags', []));

        return (new BookListResource($bookList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookList $bookList)
    {
        abort_if(Gate::denies('book_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookListResource($bookList->load(['book_category', 'book_tags']));
    }

    public function update(UpdateBookListRequest $request, BookList $bookList)
    {
        $bookList->update($request->all());
        $bookList->book_tags()->sync($request->input('book_tags', []));

        return (new BookListResource($bookList))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookList $bookList)
    {
        abort_if(Gate::denies('book_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
