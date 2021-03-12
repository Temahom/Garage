<?php

namespace App\Http\Controllers;

use App\Models\SignaturePad;
use Illuminate\Http\Request;

class SignaturePadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('signaturePad');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SignaturePad  $signaturePad
     * @return \Illuminate\Http\Response
     */
    public function show(SignaturePad $signaturePad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SignaturePad  $signaturePad
     * @return \Illuminate\Http\Response
     */
    public function edit(SignaturePad $signaturePad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SignaturePad  $signaturePad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SignaturePad $signaturePad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SignaturePad  $signaturePad
     * @return \Illuminate\Http\Response
     */
    public function destroy(SignaturePad $signaturePad)
    {
        //
    }

    public function upload(Request $request)
    {
        $folderPath = public_path('upload/');
        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);
           
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
        return back()->with('success', 'Signature enregistrée avec succes');
    }
}
