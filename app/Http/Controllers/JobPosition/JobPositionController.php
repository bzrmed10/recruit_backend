<?php

namespace App\Http\Controllers\JobPosition;
use App\JobPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class JobPositionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobPostion = jobPosition::All();
        return  $this->showAll($jobPostion);

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
        $rules = [
            'title'=> 'required',
            'description'=> 'required',
            'salary'=> 'required',
            'location'=> 'required',            
            'departement_id'=> 'required',
           
        ];
        $this->validate($request,$rules);
        $data = $request->all();
        $data['status'] = JobPosition::OFF;

        $jobPostion = jobPosition::create($data);
        return  $this->showOne($jobPostion,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobPostion = JobPosition::findOrFail($id);
        return  $this->showOne($jobPostion);
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
        $jobPostion = JobPosition::findOrFail($id);
        $rules = [
            'title'=> 'required',
            'description'=> 'required',
            'salary'=> 'required',
            'location'=> 'required',            
            'departement_id'=> 'required',
            'status'=> 'in:'.JobPosition::ON.','.JobPosition::OFF,
           
        ];
        if($request->has('title')){
            $jobPostion->title =$request->title;
        }
        if($request->has('description')){
            $jobPostion->description =$request->description;
        }
        if($request->has('salary')){
            $jobPostion->salary =$request->salary;
        }
        if($request->has('location')){
            $jobPostion->location =$request->location;
        }
        if($request->has('departement_id')){
            $jobPostion->departement_id =$request->departement_id;
        }
        if($request->has('status')){
            $jobPostion->status =$request->status;
        }

        $jobPostion->save();
        return  $this->showOne($jobPostion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobPostion = JobPosition::findOrFail($id);
        $jobPostion->delete();
        return  $this->showOne($jobPostion);
    }
}
