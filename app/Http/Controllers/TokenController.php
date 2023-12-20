<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{

    // insert di view blade
    // <a href="{{ route('form', ['token' => $token]) }}" class="btn btn-primary btn-sm">Kirim formulir</a>

    public function index()
    {
        $token = $this->createFormToken();

        return view('employee.index', compact('token'));
    }

    public function showForm($token)
    {
        // Periksa apakah token valid dan waktu masih tersisa
        $formData = Token::where('token', $token)->first();

        if (!$formData || now()->gt($formData->expiration_time)) {
            return redirect('/');
        }

        return view('form', compact('formData'));
    }

    public function submitForm(Request $request, $token)
    {
        // Memeriksa apakah token valid dan waktu masih tersisa
        $formData = Token::where('token', $token)->first();

        if (!$formData || now()->gt($formData->expiration_time)) {
            return redirect('/')->with('error', 'Token tidak valid atau batas waktu telah berakhir.');
        }

        // Melakukan validasi form
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        // Simpan data ke database
        $formData->nama = $validatedData['nama'];
        $formData->email = $validatedData['email'];
        $formData->pesan = $validatedData['pesan'];
        $formData->status = 'sudah dikirim';
        $formData->expiration_time = now(); // waktu kadaluarsa diupdate menjadi saat ini
        $formData->save();

        dd ($formData);
        // return redirect('/')->with('success', 'Formulir berhasil dikirim!');
    }

    public function createFormToken()
    {
        $token = Str::random(32); // membuat token acak
        $kadaluarsa = strtotime('+1 day'); // waktu kadaluarsa 1 hari ke depan
        $expiration_time = Carbon::createFromTimestamp($kadaluarsa);

        $formData = new Token();
        $formData->token = $token;
        $formData->expiration_time = $expiration_time;
        $formData->save();

        return $token;
    }

}
