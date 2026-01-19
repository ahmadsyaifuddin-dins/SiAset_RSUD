<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
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
            'barang_id' => 'required|exists:barang,id',
            'ruangan_id' => 'required|exists:ruangan,id',
            // Kode Inventaris (Label Stiker) Wajib Unik
            'kode_inventaris' => 'required|string|unique:inventaris,kode_inventaris',
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
        ];
    }
}
