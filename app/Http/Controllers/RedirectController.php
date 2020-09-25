<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Courrier;
use App\Notifications\NewCourrierNotification;
use App\Service;
class RedirectController extends Controller
{
    public function index( $id){

        $ser = 'App\Service'::find(5);
        //dd(Auth::user()->service->sous_service);
        
        $courrier = Courrier::find($id);

        // if($courrier->getDests()->contains('id',$ser->id))
        //     dd($ser);
        // dd($courrier->getDests());
        // dd($ser->toArray());
          
        return view('courrier.redirect2')->with('courrier',$courrier);
    }

    public function redirect(Request $request){
        //dd($request);
        $courrier = Courrier::find($request->courrier);
        //dd($courrier);
        $data = $request->except(["_token","courrier"]);
        
        //loop through  all services and attach them 
        
        //$courrier->services()->sync([Auth::user()->service->id,array_values($data)]);
        $notification = New NewCourrierNotification($courrier);
        if(!$courrier->getExp()->contains('id',Auth::user()->service->id))
             $courrier->services()->attach(Auth::user()->service->id , array('exp_dest'=>1));
        foreach($data as $service){
            if(!$courrier->getDests()->contains('id',$service)){
                $courrier->services()->attach($service ,array('exp_dest'=> 0));
                Service::find($service)->get_chef()->notify($notification);
            }
        }
         
        //dd($courrier->getDests());
        session()->flash('success'  , 'Courrier redirigé avec succée');
        return redirect()->back();
        //notify les chefs services who have new courrier
    }
}
