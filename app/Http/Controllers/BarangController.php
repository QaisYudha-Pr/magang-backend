<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\SatuanBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller 
{
    public function index()
    {
        // Tampilkan list barang
        $barang = Barang::with('satuanBarang')->get();
        return response()->json($barang);
    }

    public function store(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            '*.nama_barang' => 'required|string',
            '*.img_url' => 'required|url',
            '*.qty' => 'required|numeric|min:0',
            '*.status' => 'required|boolean',
            '*.satuan' => 'required|array',
            '*.satuan.*.nama_satuan' => 'required|string',
            '*.satuan.*.harga' => 'required|numeric|min:0',
            '*.satuan.*.status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            foreach ($request->all() as $data) {
                $barang = Barang::create([
                    'nama_barang' => $data['nama_barang'],
                    'img_url' => $data['img_url'],
                    'qty' => $data['qty'],
                    'status' => $data['status'],
                ]);

                foreach ($data['satuan'] as $satuan) {
                    SatuanBarang::create([
                        'id_barang' => $barang->id,
                        'nama_satuan' => $satuan['nama_satuan'],
                        'harga' => $satuan['harga'],
                        'status' => $satuan['status'],
                    ]);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Data berhasil disimpan'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}