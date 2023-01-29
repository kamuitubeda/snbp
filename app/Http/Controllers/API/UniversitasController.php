<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Universitas;
use App\Models\DayaTampung;
use Validator;
use DB;
use App\Http\Resources\UniversitasResource;

class UniversitasController extends BaseController
{
    public function getAllUniversitas()
    {
        $universitas = Universitas::select('id', 'nama')->get();

        if (is_null($universitas)) {
            return $this->sendError('Universitas not found.');
        }
      
        return $this->sendResponse(UniversitasResource::collection($universitas), 'Universitas retrieved successfully.');
    }

    public function getUniversitasByIdTahun($id, $tahun)
    {
        $universitas = DayaTampung::select('daya_tampungs.*')
                                ->join('universitas', 'universitas.nama', '=', 'daya_tampungs.nama_universitas')
                                ->where('universitas.id', $id)
                                ->where('daya_tampungs.tahun', $tahun)
                                ->orderBy('bidang', 'asc')
                                ->orderBy('nama_jurusan', 'asc')
                                ->get();

        if (is_null($universitas)) {
            return $this->sendError('Universitas not found.');
        }
      
        return $this->sendResponse(UniversitasResource::collection($universitas), 'Universitas retrieved successfully.');
    }
}