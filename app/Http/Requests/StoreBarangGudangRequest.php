<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangGudangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'satuan' => 'required|string|max:50', // Pcs, Rim, Box
            'stok_saat_ini' => 'required|integer|min:0', // Stok Awal
        ];
    }
}
