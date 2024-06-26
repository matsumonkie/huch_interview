<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSearchController extends Controller
{
    public function showSearchForm()
    {
        return view('search-users');
    }

    public function searchUsers(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
        ]);

        $email = $request->input('email');

        $startTime = microtime(true);
        $users = User::where('email', 'like', '%' . $email . '%')->get();
        $endTime = microtime(true);

        $queryDuration = $endTime - $startTime;

        return view('search-users', [
            'users' => $users,
            'queryDuration' => $queryDuration,
        ]);
    }
}
