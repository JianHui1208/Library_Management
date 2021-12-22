<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookTagRequest;
use App\Http\Requests\UpdateBookTagRequest;
use App\Http\Resources\Admin\BookTagResource;
use App\Models\BookTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookTagApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookTagResource(BookTag::all());
    }

    public function store(StoreBookTagRequest $request)
    {
        $bookTag = BookTag::create($request->all());

        return (new BookTagResource($bookTag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookTag $bookTag)
    {
        abort_if(Gate::denies('book_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookTagResource($bookTag);
    }

    public function update(UpdateBookTagRequest $request, BookTag $bookTag)
    {
        $bookTag->update($request->all());

        return (new BookTagResource($bookTag))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookTag $bookTag)
    {
        abort_if(Gate::denies('book_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookTag->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
