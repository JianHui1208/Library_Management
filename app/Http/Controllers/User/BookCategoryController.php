<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Models\BookList;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function getBookCategory()
    {
        $bookCategoies = BookCategory::where('status', 1)->get();
        return view('users.bookCategory.index',compact('bookCategoies'));
    }

    public function showBookCategory($id)
    {
        $bookCategory = BookCategory::where('id', $id)->first();
        $bookLists = BookList::where('book_category_id', $id)->get();

        return view('users.bookCategory.show', compact('bookCategory', 'bookLists'));
    }
}
