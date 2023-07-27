<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kbacourse;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
 
use App\Http\Resources\UserResource;
use App\Http\Resources\KbacourseCollection;

class KbaCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Kbacourses =  Kbacourse::latest()->paginate(8);
        return new KbacourseCollection($Kbacourses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               // dd($request->all());

        
               $request->validate([
                'filename' => 'required|unique:Kbacourse',
                'desc' => 'required',
                'unit' => 'required',
                'type' => 'required',
                'uploader' => 'required',
                'filepath' => 'required|mimes:jpg,png,jpeg,pdf,ppt,docx'
            ]);
    
            if($request->file('filepath')){
                $file = $request->file('filepath');
                $file_name =  $file->getClientOriginalName();
                $destinationPath = public_path(). '/storage/KBAcourse';
                $file->move($destinationPath, $file_name);
            }
     
                $Kbacourse = Kbacourse::create([
                    'filename' => $request->filename,
                    'desc' => $request->desc,
                    'unit' => $request->unit,
                    'type' => $request->type,
                    'uploader' => $request->uploader,
                    'filepath' =>  $file_name
     
                ]);
     
            return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kbacourse $id)
    {
        return $id;
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
        
        // Gate::allows(['isAdmin','isAuthor']);
        $upload = KBAcourse::findorFail($id);

        $this->validate($request,[
            'filename' => 'required|unique:Kbacourse',
            'desc' => 'required',
            'unit' => 'required',
            'type' => 'required',
            'uploader' => 'required',
            'filepath' => 'sometimes'
           
        ]);
 
 

            $upload->update($request->all());

            return response()->json($upload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload = KBAcourse::findOrFail($id);

        $upload->delete();

        return [
         'message' => 'File deleted successfully'
        ];
    }
}
