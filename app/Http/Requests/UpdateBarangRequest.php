<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Jangan lupa TRUE
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            // SN Unik tapi abaikan (ignore) punya diri sendiri saat edit
            'sn' => ['nullable', 'string', 'max:255', Rule::unique('barang', 'sn')->ignore($this->barang)],
            'jenis_barang' => 'required|string|max:100',
            'kategori_barang' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
