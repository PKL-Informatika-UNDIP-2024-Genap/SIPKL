<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return view('koordinator.profile.index', [
                'koordinator' => auth()->user()->koordinator,
            ]);
        } else {
            return view('mahasiswa.profile.index', [
                'mahasiswa' => auth()->user()->mahasiswa,
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Password lama tidak sesuai');
                    }
                },
            ],
            'password_baru' => 'required|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'konfirmasi_password_baru' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Password lama harus diisi',
            'password_baru.required' => 'Password baru harus diisi',
            'password_baru.min' => 'Password baru minimal 8 karakter. ',
            'password_baru.max' => 'Password baru maksimal 32 karakter',
            'password_baru.regex' => 'Password baru harus mengandung huruf dan angka',
            'konfirmasi_password_baru.required' => 'Konfirmasi password baru harus diisi',
            'konfirmasi_password_baru.same' => 'Konfirmasi password baru tidak sesuai',
        ]);
        auth()->user()->update([
            'password' => Hash::make($request->password_baru),
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateNoWa(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|numeric|digits_between:6,20',
        ], [
            'no_wa.required' => 'Nomor Whatsapp harus diisi',
            'no_wa.numeric' => 'Nomor Whatsapp harus berupa angka',
            'no_wa.digits_between' => 'No. WA harus berisi 6-20 angka',
        ]);
        auth()->user()->mahasiswa->update([
            'no_wa' => $request->no_wa,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->user()->username . ',username',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);
        auth()->user()->update([
            'email' => $request->email,
        ]);
        if (auth()->user()->is_admin) {
            auth()->user()->koordinator->update([
                'email' => $request->email,
            ]);
        } else {
            auth()->user()->mahasiswa->update([
                'email' => $request->email,
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function tmpUploadFotoProfil(Request $request)
    {
        if ($request->hasFile('filepond')) {
            $file = $request->file('filepond');
            $folder = uniqid('fp-') . '-' . now()->timestamp;
            $filename = auth()->user()->username . '.' . $file->getClientOriginalExtension();
            $file->storeAs('private/foto_profil/tmp/' . $folder, $filename);
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
    }

    public function tmpDeleteFotoProfil(Request $request)
    {
        $tmp_file = TemporaryFile::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('private/foto_profil/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
        }
        return response('');
    }

    public function updateFotoProfil(Request $request)
    {
        $user = auth()->user();
        $tmp_file = TemporaryFile::where('folder', $request->foto_profil)->first();
        if ($tmp_file) {
            if ($user->foto_profil != null) {
                Storage::delete($user->foto_profil);
            }
            $extension = pathinfo(storage_path('/private/foto_profil/tmp/' . $tmp_file->folder . '/' . $tmp_file->filename), PATHINFO_EXTENSION);
            $new_filename = auth()->user()->username.'-'.now()->timestamp.'-'.uniqid().'.'.$extension;
            Storage::move('private/foto_profil/tmp/'.$tmp_file->folder.'/'.$tmp_file->filename, 'private/foto_profil/'.$new_filename);

            $user->update([
                'foto_profil' => 'private/foto_profil/' . $new_filename,
            ]);
            Storage::deleteDirectory('private/foto_profil/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Request successful',
                'foto_profil' => $user->foto_profil,
            ], 200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Request failed',
        ], 400);
    }
}
