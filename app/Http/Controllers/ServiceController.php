<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\User;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //dd('App\User'::where('est_chef' , false)->get());
        // $services = Service::all();
        // dd(Service::All());
        return view('service.index')->with('services',Service::All());
                                    
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
       // dd($request);
        $service = Service::create([
            'nom_service' => $request->nom_service,
            'abr_service' => $request->abr_service,
            'service_id'  => $request->service_id,
            'user_id'     =>$request->user_id
        ]);
        $user = User::find($request->user_id);
        $user->est_chef= true;
        $user->save();
        return redirect()->back();
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
        $service = Service::find($id);
        dd($request);
        $data=$request->only(['nom_service', 'abr_service' , 'service_id' , 'user_id']);
        $user = User::find($data['user_id']);
        if($user->id != $service->user_id){
            User::find($service->user_id)->est_chef = false;
            $user->est_chef = true;
        }
        $service->update($data);
       return redirect(route('service'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function get_elements(){
        
        $html_text="";
        foreach(Service::find(_GET['id'])->users as $user){
            $html_text = $html_text.'<option value="'.$user->id.'">'.$user->grade->abr_grade.'\.'.$user->nom.' '.$user->prenom.'</option>';
        }
        return ($html_text);
    }
}
