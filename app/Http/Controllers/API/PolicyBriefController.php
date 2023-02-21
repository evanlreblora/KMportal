<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PolicyBrief;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PolicyBriefCollection;

class PolicyBriefController extends Controller
{

    public function index()
    {
        return PolicyBrief::latest()->paginate(10);
    }

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
            $destinationPath = public_path(). '/storage/PolicyBrief';
            $file->move($destinationPath, $file_name);
        }
 
            $policyBriefs = PolicyBrief::create([
                'filename' => $request->filename,
                'desc' => $request->desc,
                'unit' => $request->unit,
                'type' => $request->type,
                'uploader' => $request->uploader,
                'filepath' => env('APP_URL'). '/policy/'. $file_name
 
            ]);
 
        return response()->json(['message' => 'Success'], 200);
    }
        

        // PolicyBrief::create($request->all());
 

    public function show($id)
    {
        //Get annualreport
        $policyBrief = PolicyBrief::FindOrFail($id);
        //return single
        return new PolicyBriefResource($policyBrief);
    }

    public function update(Request $request, $id)
    {
        $upload = PolicyBrief::find($id);

        $this->validate($request,[
            'filename' => 'required|string|max:191',
            'filepath' => 'required|file|mimes:pdf,jpg,png,docx'
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

    public function destroy($id)
    {
        $upload = PolicyBrief::findOrFail($id);

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
        $policybrief = PolicyBrief::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new PolicyBriefCollection($policybrief);
    }


}
