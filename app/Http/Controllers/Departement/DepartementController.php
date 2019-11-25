<?php

namespace App\Http\Controllers\Departement;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Departement;
class DepartementController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departement = Departement::All();
        return $this->showAll($departement);
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
            'name'=> 'required|unique:departements',
            'nbEmployee'=> 'required' ,
           
        ];
        $this->validate($request,$rules);
        
        $data = $request->all();
        $departement = Departement::create($data);
        return  $this->showOne($departement,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departement = Departement::findOrFail($id);
        return  $this->showOne($departement);
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
        $departement = Departement::findOrFail($id);
        $rules = [
            'name'=> 'required|unique:departements,name,' .$departement->id,
            'nbEmployee'=> 'required' ,
     
        ];

        // $this->validate($request,$rules);
        if($request->has('name')){
            $departement->name =$request->name;
        }
        if($request->has('nbEmployee')){
            $departement->nbEmployee =$request->nbEmployee;
        }
        
        if(!$departement->isDirty()){
            return $this->errorResponse('You need to specify different value to update.',422);
        }
        
        $departement->save();
        return  $this->showOne($departement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);
        $departement->delete();
        return  $this->showOne($departement);
    }
}
