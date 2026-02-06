<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('master.users.index', compact('users'));
    }

    public function create()
    {
        return view('master.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('master.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Logic Update Password:
        // Jika input password diisi, kita hash dan simpan.
        // Jika kosong, kita hapus dari array $data supaya password lama tidak tertimpa null.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pengguna diperbarui!');
    }

    public function destroy(User $user)
    {
        // Cegah menghapus diri sendiri agar tidak terkunci dari sistem
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun yang sedang login!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna dihapus!');
    }
}
