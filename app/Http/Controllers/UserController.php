<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $list = User::get();
        return view('users.index', compact('list'));
    }

    public function delete($id)
    {
        $delete = DB::table('users')->where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('users.index')->with('success', 'User Berhasil Dihapus');
        } else {
            return redirect()->route('users.index')->with('error', 'User Gagal Dihapus');
        }
        log($delete);
    }

    public function AddUser()
    {
        $list = DB::table('users')->get();
        return view('users.add', compact('list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.add')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan pengguna. Silakan periksa kembali data yang dimasukkan.');
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2, // Role 2 sesuai dengan kebutuhan Anda.
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan');
    }
}
