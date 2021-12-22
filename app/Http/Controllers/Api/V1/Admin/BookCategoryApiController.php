<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;
use App\Http\Resources\Admin\BookCategoryResource;
use App\Models\BookCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookCategoryResource(BookCategory::all());
    }

    public function store(StoreBookCategoryRequest $request)
    {
        $bookCategory = BookCategory::create($request->all());

        return (new BookCategoryResource($bookCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookCategory $bookCategory)
    {
        abort_if(Gate::denies('book_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookCategoryResource($bookCategory);
    }

    public function update(UpdateBookCategoryRequest $request, BookCategory $bookCategory)
    {
        $bookCategory->update($request->all());

        return (new BookCategoryResource($bookCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookCategory $bookCategory)
    {
        abort_if(Gate::denies('book_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
