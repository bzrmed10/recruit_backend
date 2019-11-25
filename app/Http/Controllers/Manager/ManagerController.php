<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Manager;
class ManagerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::All();
        return  $this->showAll($managers);

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
            'firstName'=> 'required',
            'lastName'=> 'required' ,
            'email'=> 'required|email|unique:managers',
            'phone'=>'required' ,
            'departement_id'=> 'required',
        ];
        $this->validate($request,$rules);
        $data = $request->all();
        $data['status'] = Manager::ACTIVE_MANAGER;
        $manager = Manager::create($data);
        return response()->json(['data' => $manager],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = Manager::findOrFail($id);
        return  $this->showOne($manager);

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
        $manager = Manager::findOrFail($id);
        $rules = [
            'firstName'=> 'required',
            'lastName'=> 'required' ,
            'email'=> 'required|email',
            'phone'=>'required' ,
            'departement_id'=> 'required',
            'status' =>'in:'.Manager::ACTIVE_MANAGER.','.Manager::DISABLED_MANAGER,
        ];

        if($request->has('firstName')){
            $manager->firstName =$request->firstName;
        }
        if($request->has('lastName')){
            $manager->lastName =$request->lastName;
        }
        if($request->has('email')){
            $manager->email =$request->email;
        }
        if($request->has('phone')){
            $manager->phone =$request->phone;
        }
        if($request->has('departement_id')){
            $manager->departement_id =$request->departement_id;
        }
        if($request->has('status')){
            $manager->status =$request->status;
        }
        
        $manager->save();
        return  $this->showOne($manager);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
        return  $this->showOne($manager);
    }
}
