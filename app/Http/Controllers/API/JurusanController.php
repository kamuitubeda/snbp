<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Jurusan;
use App\Models\DayaTampung;
use Validator;
use DB;
use App\Http\Resources\JurusanResource;

class JurusanController extends BaseController
{
    public function getAllJurusan()
    {
        $jurusans = Jurusan::select('id', 'nama')->get();

        if (is_null($jurusans)) {
            return $this->sendError('Jurusan not found.');
        }
      
        return $this->sendResponse(JurusanResource::collection($jurusans), 'Jurusans retrieved successfully.');
    }

    public function getJurusanByIdTahun($id, $tahun)
    {
        $jurusans = DayaTampung::select('daya_tampungs.*')
                                ->join('jurusans', 'jurusans.nama', '=', 'daya_tampungs.nama_jurusan')
                                ->where('jurusans.id', $id)
                                ->where('daya_tampungs.tahun', $tahun)
                                ->orderBy('nama_universitas', 'asc')
                                ->get();

        if (is_null($jurusans)) {
            return $this->sendError('Jurusan not found.');
        }
      
        return $this->sendResponse(JurusanResource::collection($jurusans), 'Jurusans retrieved successfully.');
    }
}