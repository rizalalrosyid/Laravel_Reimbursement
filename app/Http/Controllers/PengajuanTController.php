<?php

namespace App\Http\Controllers;

use App\Models\PengajuanT;
use Illuminate\Http\Request;
use DB;

class PengajuanTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insertPengajuan(Request $request)
    {

        $fileName = time().'.'.$request->formFile->extension();  
        $request->formFile->move(public_path('uploads'), $fileName);

        $APAR = DB::table('pengajuan_t')->insert([

            'id' => auth()->user()->id,
            
            'tanggalPengajuan' => $request->formTanggal,
            
            'namaPengajuan' => $request->formNama,
            
            'deskripsiPengajuan' => $request->formDeskripsi,
            
            'filePengajuan' => $fileName,

        ]);
        session()->flash('success', 'Pengajuan Reimbursement selesai dilakukan');

        return redirect('/pengajuan');

    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanT $pengajuanT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanT $pengajuanT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePengajuan(Request $request, $id)
    {

        DB::table('pengajuan_t')->where('id_pengajuan', $id)->update([

            'd_verified' => true
    
        ]);

        session()->flash('success', 'Update selesai dilakukan');
        return redirect('/home');

    }
    public function updatePengajuan2(Request $request, $id)
    {

        DB::table('pengajuan_t')->where('id_pengajuan', $id)->update([

            'f_verified' => true
    
        ]);

        session()->flash('success', 'Update selesai dilakukan');
        return redirect('/home');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanT $pengajuanT)
    {
        //
    }
}
