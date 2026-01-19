<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Import Rule

class UpdateInventarisRequest extends FormRequest
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
            // Unik tapi ignore diri sendiri saat edit
            'kode_inventaris' => ['required', 'string', Rule::unique('inventaris', 'kode_inventaris')->ignore($this->inventaris)],
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
        ];
    }
}
