<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\PolicyBrief;
use App\Models\Photo;
use App\Http\Resources\PolicyBriefResource as PolicyBriefResources;
use App\Http\Resources\PolicyBriefCollection;
use Intervention\Image\Facades\Image;
// use App\Http\Resources\UserCollection;

class PolicyBriefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get report
        $policybriefs = PolicyBrief::orderBy('created_at', 'desc')->paginate(3);
        // Return collection of AnnualReport as a resource
        return PolicyBriefResources::collection($policybriefs);

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
        $policybrief = $request->isMethod('put') ? PolicyBrief::findOrFail($request->id) : new PolicyBrief;

        $policybrief->id = $request->input('id');
        $policybrief->filename = $request->input('filename');
        $policybrief->desc = $request->input('desc');
        $policybrief->unit = $request->input('unit');
        $policybrief->type = $request->input('type');
        $policybrief->uploader = $request->input('uploader');
        


        if($request->filepath){

            $filepath = time().'.' . explode('/', explode(':', substr($request->filepath, 0, strpos($request->filepath, ';')))[1])[1];
            \Image::make($request->filepath)->save(public_path('/storage/files/').$filepath);
            // $request->merge(['photo' => $name]);
           
        }

        // $pic = $request->file('photo');
        // $newPic = time().$pic->getClientOriginalName();       

        
        // $policybrief->filepath = $file_name;
        // $check = Photo::insertGetId($insert);


        if($policybrief->save()) {
            return new PolicyBriefResources($policybrief);
        }
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
        $policybrief = PolicyBrief::FindOrFail($id);
        //return single
        return new PolicyBriefResources($policybrief);

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
            //Get policybrief
            $policybrief = PolicyBrief::FindOrFail($id);
            
            if($policybrief->delete()){
                return new PolicyBriefResources($policybrief);
            }     
    }

    
    public function search(Request $request)
    {
        $query =  $request->query('q');
        $policybrief = PolicyBrief::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new PolicyBriefCollection($policybrief);
    }

    public function upload(Request $request)
    {   

            $upload_path = public_path('/storage/files/');
            $file_name = $request->file->getClientOriginalName();
            $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move($upload_path, $generated_new_name);
             
            $insert['filepath'] = $file_name;
            $check = Photo::insertGetId($insert);
            return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);


            
        // return response()->json([
        //     'message' => "ok"
        // ]); 

        // move only, it doesnt save to db

        // try{
        //     if($request->hasFIle('files')){
        //         $file = $request->file('files');
        //         $file_name = time(). '.' . $file->getClientOriginalName(); 
        //         $file->move(public_path('/storage/files/'), $file_name);
        //         return response()->json([
        //             'message' => "File Uploaded Successfully!"
        //         ],200);
        //     }
        // }catch(\Exception $e){
        //     return response()->json([
        //     'message' => $e->getMessage()
        //     ]); 
        // }

    }

    
}
