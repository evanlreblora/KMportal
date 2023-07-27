<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\GOFBudget;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
 
use App\Http\Resources\UserResource;
use App\Http\Resources\GofbudgetCollection;

class GOFBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return AnnualReport::latest()->paginate(8);
        // Gate::allows(['isAdmin','isAuthor']);
        $GOFBudgets =  GOFBudget::latest()->paginate(8);
        return new GofbudgetCollection($GOFBudgets);
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
            'filename' => 'required|unique:annualreport',
            'desc' => 'required',
            'unit' => 'required',
            'type' => 'required',
            'uploader' => 'required',
            'filepath' => 'required|mimes:jpg,png,jpeg,pdf,ppt,docx'
        ]);

        if($request->file('filepath')){
            $file = $request->file('filepath');
            $file_name =  $file->getClientOriginalName();
            $destinationPath = public_path(). '/storage/GOFBudget';
            $file->move($destinationPath, $file_name);
        }
 
            $annualReport = GOFBudget::create([
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
    public function show(GOFBudget $id)
    {
               //Get annualreport
            //    $annualreport = AnnualReport::FindOrFail($id);
               //return single
            //    return new AnnualReportResource($annualreport);
            //    return View::make('annualreport.show')
            //    ->with('annualreport', $annualreport);

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
        $upload = GOFBudget::findorFail($id);

        $this->validate($request,[
            'filename' => 'required|unique:GOFBudget',
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
        $upload = GOFBudget::findOrFail($id);

        $upload->delete();

        // $currentFile = $upload->filepath;

        // $userPhoto = public_path('img/profile/').$currentPhoto;

        // if(file_exists($userPhoto)) {

        //     @unlink($userPhoto);
                
        // }

        return [
         'message' => 'File deleted successfully'
        ];
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $GOFBudget = GOFBudget::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new GOFBudgetCollection($GOFBudget);
    }

  

    
    // public function upload(Request $request)
    // {   

    //         $upload_path = public_path('/storage/files/');
    //         $file_name = $request->file->getClientOriginalName();
    //         $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
    //         $request->file->move($upload_path, $generated_new_name);
            
 
    //         $insert['photo'] = $file_name;
    //         $check = Photo::insertGetId($insert);
    //         return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);


    // }
}
