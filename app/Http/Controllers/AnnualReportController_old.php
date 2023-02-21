<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MOdels\AnnualReport;
use App\Http\Resources\AnnualReport as AnnualReportResource;
use App\Http\Resources\AnnualRepCollection;


class AnnualReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get report
        $annualreports = AnnualReport::orderBy('created_at', 'desc')->paginate(3);
        // Return collection of AnnualReport as a resource
        return AnnualReportResource::collection($annualreports);

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
        $annualreport = $request->isMethod('put') ? AnnualReport::findOrFail($request->id) : new AnnualReport;

        $annualreport->id = $request->input('id');
        $annualreport->filename = $request->input('filename');
        $annualreport->desc = $request->input('desc');
        $annualreport->unit = $request->input('unit');
        $annualreport->type = $request->input('type');
        $annualreport->uploader = $request->input('uploader');

        if($annualreport->save()) {
            return new AnnualReportResource($annualreport);
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
        $annualreport = AnnualReport::FindOrFail($id);
        //return single
        return new AnnualReportResource($annualreport);

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
            //Get annualreport
            $annualreport = AnnualReport::FindOrFail($id);
            
            if($annualreport->delete()){
                return new AnnualReportResource($annualreport);
            }
            
        
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $annualreport1 = AnnualReport::where('filename','LIKE', '%'.$query.'%')->orWhere('desc','LIKE','%'.$query.'%')->orWhere('type','LIKE','%'.$query.'%')->latest()->paginate(10);

        return new AnnualRepCollection($annualreport1);
    }

    public function uploadFile(Request $request)
    {

        $files = $request->file('files');
        if(count($files)){
        foreach($files as $file){
        $filename = Str::lower( Str::ascii($file->getClientOriginalName()) );
        $path = $file->storeAs('./public/files/', $filename);
        }
        }
    }
}
