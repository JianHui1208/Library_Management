<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookList;

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
        return view('users.bookLists.show',compact('bookLists'));
    }
}
