<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
 
use App\Http\Resources\UserResource;
use App\Http\Resources\AnnualReportCollection;

class AnnualReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnnualReport::latest()->paginate(8);
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
            $destinationPath = public_path(). '/storage/AnnualReport';
            $file->move($destinationPath, $file_name);
        }
 
            $annualReport = AnnualReport::create([
                'filename' => $request->filename,
                'desc' => $request->desc,
                'unit' => $request->unit,
                'type' => $request->type,
                'uploader' => $request->uploader,
                'filepath' => env('APP_URL'). '/annual/'. $file_name
 
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
               $annualreport = AnnualReport::FindOrFail($id);
               //return single
               return new AnnualReportResource($annualreport);
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
        $upload = AnnualReport::find($id);

        $this->validate($request,[
            'filename' => 'required|string|max:191',
            'filepath' => 'required'
        ]);

        $currentPhoto = $upload->filepath;

        if($request->photo != $currentPhoto){

            $filename = time().'.' . explode('/', explode(':', substr($request->filepath, 0, strpos($request->filepath, ';')))[1])[1];
            \Image::make($request->filepath)->save(public_path('storage/files/').$filename);
            $request->merge(['filepath' => $filename]);

            $userPhoto = public_path('/storage/files/').$currentPhoto;

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
        $upload = AnnualReport::findOrFail($id);

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
        $annualreport = AnnualReport::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new AnnualReportCollection($annualreport);
    }

  

    
    public function upload(Request $request)
    {   

            $upload_path = public_path('/storage/files/');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move($upload_path, $generated_new_name);
            
 
            $insert['photo'] = $file_name;
            $check = Photo::insertGetId($insert);
            return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);


    }
}
