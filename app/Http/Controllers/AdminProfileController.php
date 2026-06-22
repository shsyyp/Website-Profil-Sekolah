<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8'],
            'password_confirmation' => ['nullable', 'required_with:password', 'same:password'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password_confirmation.required_with' => 'Konfirmasi kata sandi wajib diisi.',
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak sesuai.',
            'avatar.image' => 'Foto profil harus berupa gambar.',
            'avatar.mimes' => 'Foto profil harus berformat JPG, JPEG, atau PNG.',
            'avatar.max' => 'Ukuran foto profil maksimal 2 MB.',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('admin-profile', 'public');
        }

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }
        unset($data['password_confirmation']);

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
