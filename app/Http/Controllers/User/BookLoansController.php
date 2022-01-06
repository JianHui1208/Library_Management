<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Models\BookLoan;
use Carbon\Carbon;
use Exception;

class BookLoansController extends Controller
{
    public function getBookLoan()
    {
        $loans = BookLoan::with('book', 'book.book_category')->where('user_id', Auth::id())->get();

        return view('users.bookLoans.index', compact('loans'));
    }

    public function addBookloan(Request $request)
    {
        DB::beginTransaction();
        try {
            $expired_day = SystemSetting::where('key', 'book_expired_time')->first();

            $request['user_id'] = Auth::id();
            $request['expired_time'] = Carbon::now()->addDays($expired_day->value);
            if($request['type'] == "1") {
                $request['status'] = 5;
                BookLoan::create($request->all());
            }

            if($request['type'] == "2") {
                BookLoan::where('book_id', $request['book_id'])->where('user_id', Auth::id())->update(['status' => 4]);
                DB::commit();
                return redirect()->back()->with('message', 'You have cancelled your reservation.');
            }

            if($request['type'] == "3") {
                BookLoan::where('book_id', $request['book_id'])->where('user_id', Auth::id())->update(['status' => 4]);

                $request['status'] = 1;
                BookLoan::create($request->all());
            }

            DB::commit();
            return redirect()->route('users.my-book-loan');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again');
        } catch (\Error $e) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Somethings Wrong. Please Try Angin');
        }
    }
}
