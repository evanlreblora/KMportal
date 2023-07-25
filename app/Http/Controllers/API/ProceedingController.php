<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Proceeding;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProceedingCollection;

class ProceedingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proceedings =  Proceeding::latest()->paginate(3);
        return new ProceedingCollection($proceedings);
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
        // return response()->json([
        //     'message'=>"ok"
        // ]);
        // dd($request->all());

        
        $request->validate([
            'filename' => 'required|unique:Proceeding,filename',
            'desc' => 'required',
            'unit' => 'required',
            'type' => 'required',
            'uploader' => 'required',
            'filepath' => 'required|mimes:jpg,png,jpeg,pdf'
        ]);

        if($request->file('filepath')){
            $file = $request->file('filepath');
            $file_name = date('mdyHis'). '.' . $file->getClientOriginalName();
            $destinationPath = public_path(). '/storage/Proceedings';
            $file->move($destinationPath, $file_name);
        }
 
            $annualReport = Proceeding::create([
                'filename' => $request->filename,
                'desc' => $request->desc,
                'unit' => $request->unit,
                'type' => $request->type,
                'uploader' => $request->uploader,
                'filepath' => env('APP_URL'). '/proceeding/'. $file_name
 
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
        //Get annualreport
        $proceeding = Proceeding::FindOrFail($id);
        //return single
        return new ProceedingResource($proceeding);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $upload = Proceeding::find($id);

        $this->validate($request,[
            'filename' => 'required|string|max:191',
            'filepath' => 'required'
        ]);

        $currentPhoto = $upload->photo;

        if($request->photo != $currentPhoto){

            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            if(file_exists($userPhoto)){

                @unlink($userPhoto);
                
            }
           
        }

        $upload->update($request->all());

        return ['message' => 'Success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload = Proceeding::findOrFail($id);

        $upload->delete();

        $currentPhoto = $upload->photo;

        $userPhoto = public_path('img/profile/').$currentPhoto;

        if(file_exists($userPhoto)) {

            @unlink($userPhoto);
                
        }

        return [
         'message' => 'Photo deleted successfully'
        ];
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $proceeding = Proceeding::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new ProceedingCollection($proceeding);
    }
}
