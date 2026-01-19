<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
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
            'sn' => 'nullable|string|max:255|unique:barang,sn', // SN Unik saat Create
            'jenis_barang' => 'required|string|max:100', // Elektronik, Medis
            'kategori_barang' => 'required|string|max:100', // Laptop, Printer
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
