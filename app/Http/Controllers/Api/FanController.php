<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fan;
use Illuminate\Http\Request;
use Validator;

class FanController extends Controller
{
    public function index()
    {
        $fans = Fan::with('klub')->latest()->get();
        $res = [
            'success' => true,
            'message' => 'Daftar Fans',
            'data' => $fan,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_fan' => 'required|unique:fans',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $fan = new Fan;
            $fan->nama_fan = $request->nama_fan;
            $fan->save();
            return response()->json([
                'success' => true,
                'message' => 'data fans berhasil dibuat',
                'data' => $fan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $fan = Fan::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Detail Liga',
                'data' => $fan,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan!',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_fan' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $fan = Fan::findOrFail($id);
            $fan->nama_fan = $request->nama_fan;
            $fan->save();
            return response()->json([
                'success' => true,
                'message' => 'data fans berhasil dirubah',
                'data' => $fan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $liga = Liga::findOrFail($id);
            $liga->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data ' . $liga->nama_liga . 'berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan!',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
}
