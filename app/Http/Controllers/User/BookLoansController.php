<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BookLoan;

class BookLoansController extends Controller
{
    public function getBookLoan()
    {
        $loan = BookLoan::where('user_id', Auth::id())->get();
    }
}
