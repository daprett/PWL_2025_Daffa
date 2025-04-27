<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenjualanDetailModel;
use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = PenjualanDetailModel::with(['sales', 'barang'])->get();
        return response()->json($data);
    }
    
    public function show($transaksi)
    {
        $penjualan = PenjualanDetailModel::with(['sales', 'barang'])->findOrFail($transaksi);
        return response()->json($penjualan);
    }

    /** POST /api/transaksi */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = basename($request->file('image')->store('post', 'public'));
        }
    
        $penjualandetail = PenjualanDetailModel::create($validated);
    
        return response()->json($penjualandetail->load('barang', 'sales'), 201);
    }

    // /** GET /api/transaksi/{transaksi} */
    // public function show($transaksi)
    // {
    //     $trx = PenjualanDetailModel::findOrFail($transaksi);
    //     return response()->json($trx);
    // }

    /** PUT /api/transaksi/{transaksi} */
    public function update(Request $request, $transaksi)
    {
        $trx = PenjualanDetailModel::findOrFail($transaksi);

        $v = Validator::make($request->all(), [
            'pembeli'           => 'sometimes|required|string|max:100',
            'penjualan_kode'    => 'sometimes|required|string|unique:t_penjualan,penjualan_kode,'.$transaksi.',penjualan_id',
            'penjualan_tanggal' => 'sometimes|required|date',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($v->fails()) {
            return response()->json(['success'=>false,'errors'=>$v->errors()], 422);
        }

        $trx->update($v->validated());

        if ($request->hasFile('image')) {
            if ($trx->image) {
                Storage::delete('public/transaksi/'.$trx->image);
            }
            $fn = time().'.'.$request->image->extension();
            $request->image->storeAs('public/transaksi', $fn);
            $trx->update(['image'=>$fn]);
        }

        return response()->json($trx);
    }

    /** DELETE /api/transaksi/{transaksi} */
    public function destroy($transaksi)
    {
        $trx = PenjualanDetailModel::findOrFail($transaksi);
        if ($trx->image) {
            Storage::delete('public/transaksi/'.$trx->image);
        }
        $trx->delete();
        return response()->json(['success'=>true,'message'=>'Transaksi dihapus']);
    }
}