<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ABO;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
 
use App\Http\Resources\UserResource;
use App\Http\Resources\AboCollection;

class ABOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Abo::latest()->paginate(8);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $request->validate([
            'filename' => 'required',
            'desc' => 'required',
            'unit' => 'required',
            'type' => 'required',
            'uploader' => 'required',
            'filepath' => 'required|mimes:jpg,png,jpeg,pdf'
        ]);

        if($request->file('filepath')){
            $file = $request->file('filepath');
            $file_name = date('mdyHis'). '.' . $file->getClientOriginalName();
            $destinationPath = public_path(). '/storage/ABO';
            $file->move($destinationPath, $file_name);
        }
 
            $annualReport = Abo::create([
                'filename' => $request->filename,
                'desc' => $request->desc,
                'unit' => $request->unit,
                'type' => $request->type,
                'uploader' => $request->uploader,
                'filepath' => env('APP_URL'). '/abo/'. $file_name
 
            ]);
 
        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
