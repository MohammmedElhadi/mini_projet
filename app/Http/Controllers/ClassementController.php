<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classement;
class ClassementController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('courrier.classement.index')->with('classements',Classement::All());
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
        $this->validate(request(),[
    		'nom_class' => 'required' 
		]);

    	$data = request()->all();
    	$classment = new Classement();
    	$classment->nom_class = $data['nom_class'];
    	$classment->save();
     	session()->flash('success','Classment enregistré  avec succès');

    	return redirect('/classement');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->validate(request(),[
    		'nom_class' => 'required'
        ]);   	
        

     	$data = $request->all();
         
        $classement = Classement::find($id);
        
     	$classement->nom_class = $data['nom_class'];
     	$classement->save();

     	session()->flash('success','Classment modifié avec succès');

     	return redirect('/classement'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classement $classement)
    {
        $classement->delete();
        session()->flash('success','Classment supprimié avec succès');
   
       return redirect('/classement');
    }
}
