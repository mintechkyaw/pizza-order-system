<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //register and login for admin

    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#orders#list');
        } elseif (Auth::user()->role == 'user') {
            return redirect()->route('user#shop');
        } else {
            return 'Who the hell are you?😕😕';
        }
    }

    public function adminList()
    {
        $admins = User::where('role', 'admin')->paginate(5);

        return view('admin.permissions.list', compact('admins'));
    }

    public function adminRole($id)
    {

        $user = User::findOrFail($id);
        if ($user->role == 'admin') {
            $user->role = 'user';
            $user->save();
            return back()->with('msg', 'That Account has change to user');
        } elseif ($user->role == 'user') {
            $user->role = 'admin';
            $user->save();
            return back()->with('msg', 'That Account has change to admin');
        }
    }

    public function adminDelete($id)
    {
        if ($id == Auth::user()->id) {
            return back();
        } else {
            User::where('id', $id)->delete();
            return back()->with('msg', 'account delete successfully!');
        }
    }


    public function adminSearch(Request $request)
    {
        $searchKey = $request->has('searchKey') ? $request->searchKey : '';
        $admins = User::where('role', 'admin')
            ->where('name', 'like', '%' . $searchKey . '%')
            ->orderBy('id', 'asc')
            ->paginate(5);
        $admins->appends($request->all());
        return view('admin.permissions.list', compact('admins'));
    }
    public function customerList()
    {
        $customers = User::where('role', 'user')->paginate(10);

        return view('admin.permissions.customer.list', compact('customers'));
    }
}
