<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index')->with('services', 'App\Service'::all())
                                ->with('grades', 'App\Grade'::all())
                                ->with('users',User::All());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'matricule' => ['required', 'digits:12', 'unique:users'],
		]);
        $data = request()->all();
        //dd($data);
        $user = new User();
        $user->nom = $data['nom'];
        $user->prenom = $data['prenom'];
        $user->matricule = $data['matricule'];
        $user->grade_id = $data['grade'];
        $user->service_id = $data['service'];
        $user->email = $data['nom'].".".$data['matricule']."@emp.dz";
        $user->password = Hash::make($data['matricule']);
        $user->save();

        session()->flash('success','Utilisateur enregistré  avec succès');

    	return redirect('/users');
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
        $data = $request->all();
        //dd($data);

        $user = User::find($id);
        $user->nom = $data['nom_edit'];
        $user->prenom = $data['prenom_edit'];
        $user->matricule = $data['matricule_edit'];
        $user->email = $data['email_edit'];
        $user->telephone = $data['telephone_edit'];

    	$user->save();

     	session()->flash('success','Utilisateur modifié avec succès');
     	return redirect('/users'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->courriers_envoyer()->count() > 0){
            session()->flash('error','vous ne pouvez pas supprimer ce utilisateur, il a des courriers');
            return redirect('/users');
        }
        $user->delete();
        session()->flash('success','Classment supprimié avec succès');
   
       return redirect('/users');
    }
}
