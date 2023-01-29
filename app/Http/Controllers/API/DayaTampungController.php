<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DayaTampung;
use Validator;
use DB;
use App\Http\Resources\DayaTampungResource;

class DayaTampungController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dayaTampungs = DayaTampung::all();
      
        return $this->sendResponse(DayaTampungResource::collection($dayaTampungs), 'Daya Tampungs retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
     
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
     
        $dayaTampung = DayaTampung::create($input);
     
        return $this->sendResponse(new DayaTampungResource($dayaTampung), 'Daya Tampung created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dayaTampung = DayaTampung::find($id);
    
        if (is_null($dayaTampung)) {
            return $this->sendError('Daya Tampung not found.');
        }
     
        return $this->sendResponse(new DayaTampungResource($dayaTampung), 'Daya Tampung retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayaTampung $dayaTampung)
    {
        $input = $request->all();
     
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
     
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
     
        $dayaTampung->name = $input['name'];
        $dayaTampung->detail = $input['detail'];
        $dayaTampung->save();
     
        return $this->sendResponse(new DayaTampungResource($dayaTampung), 'Daya Tampung updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayaTampung $dayaTampung)
    {
        $dayaTampung->delete();
     
        return $this->sendResponse([], 'Daya Tampung deleted successfully.');
    }

    public function getAllByJurusan($kode)
    {
        $dayaTampungs = DayaTampung::where('kode', $kode)->get();

        if (is_null($dayaTampungs)) {
            return $this->sendError('Daya Tampung not found.');
        }
      
        return $this->sendResponse(DayaTampungResource::collection($dayaTampungs), 'Daya Tampungs retrieved successfully.');
    }

    public function getAllByKampusAndTahun($kampus, $tahun)
    {
        $dayaTampungs = DayaTampung::where('kode', 'like', $kampus . '%')->where('tahun', $tahun)->get();

        if (is_null($dayaTampungs)) {
            return $this->sendError('Daya Tampung not found.');
        }
      
        return $this->sendResponse(DayaTampungResource::collection($dayaTampungs), 'Daya Tampungs retrieved successfully.');
    }

    public function getAllByNamaJurusan($nama)
    {
        $dayaTampungs = DayaTampung::where(DB::raw('lower(nama_jurusan)'), 'like', '%' . strtolower($nama) . '%')->get();

        if (is_null($dayaTampungs)) {
            return $this->sendError('Daya Tampung not found.');
        }
      
        return $this->sendResponse(DayaTampungResource::collection($dayaTampungs), 'Daya Tampungs retrieved successfully.');
    }

    public function getAllByNamaJurusanAndTahun($nama, $tahun)
    {
        $dayaTampungs = DayaTampung::where('tahun', $tahun)->where(DB::raw('lower(nama_jurusan)'), 'like', '%' . strtolower($nama) . '%')->get();

        if (is_null($dayaTampungs)) {
            return $this->sendError('Daya Tampung not found.');
        }
      
        return $this->sendResponse(DayaTampungResource::collection($dayaTampungs), 'Daya Tampungs retrieved successfully.');
    }
}