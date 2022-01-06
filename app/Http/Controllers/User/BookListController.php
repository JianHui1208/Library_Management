<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BookCategory;
use App\Models\BookList;
use App\Models\BookLoan;
use App\Models\BookTag;

class BookListController extends Controller
{
    public function getBookList()
    {
        $bookLists = BookList::with(['book_category'])->where('status', 1)->orderBy('id', 'asc')->get();

        return view('users.bookLists.index',compact('bookLists'));
    }

    public function showBookList($uid)
    {
        $bookLists = BookList::with(['book_category'])->where('uid', $uid)->first();

        $bookLoan = BookLoan::where('user_id', Auth::id())->where('book_id', $bookLists->id)->where('status', '!=', 4)->first();

        return view('users.bookLists.show',compact('bookLists', 'bookLoan'));
    }

    public function searchPages()
    {
        $categories = BookCategory::get();
        $tags = BookTag::get();
        return view('users.search', compact('categories', 'tags'));
    }

    public function searchResult(Request $request)
    {
        $dataTag = $request->tag;

        $bookLists = BookList::with(['book_category', 'book_tags'])
        ->whereIn('book_category_id', $request->category)
        ->whereHas('book_tags', function ($query) use ($dataTag){
            $query->whereIn('id', $dataTag);
        })->get();

        return view('users.result', compact('bookLists'));
    }
}
