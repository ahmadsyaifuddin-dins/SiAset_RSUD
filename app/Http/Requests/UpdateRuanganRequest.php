<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRuanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_ruangan' => 'required|string|max:255',
            'kepala_ruangan' => 'required|string|max:255',

            // Validasi Foto (Opsional / Boleh kosong saat edit)
            // Kalau user tidak upload foto baru, foto lama tetap aman (dihandle di Controller)
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        ];
    }
}
