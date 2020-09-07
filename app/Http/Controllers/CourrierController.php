<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Courrier;
use App\Piecejointe;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class CourrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd(Courrier::find(23)->piece_jointe);
        return view('courrier.index')->with('courriers',Courrier::All())
                                    ->with('types', 'App\Typecourrier'::all())
                                    ->with('classements', 'App\Classement'::all())
                                    ->with('mentions', 'App\Mention'::all())
                                    ->with('piecejointes', 'App\Piecejointe'::all());
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
            'num_depart' => 'min:0',
            'num_arrive' => 'min:0',
		]);
        
        //store file 
        //dd($request->piece_jointes);
        // dd($data['piece_jointes']);
       
        $data = request()->all();
       // dd($data['piece_jointes']);
    	$courrier = new Courrier();
        $courrier->objet_courrier = $data['objet'];
        $courrier->description_courrier = $data['description_courrier'];
        $courrier->date_depart = $data['date_depart'];
        $courrier->date_arrive = $data['date_arrive'];
        $courrier->num_depart = $data['num_depart'];
        $courrier->num_arrive = $data['num_arrive'];
        $courrier->classement_id = $data['classement'];
        $courrier->mention_id = $data['mention'];
        $courrier->typecourrier_id = $data['typecourrier'];
        $courrier->user_id = Auth::id();


        // service here
        
        $courrier->url_courrier = $data['source']->store('Courriers');
        $courrier->save();
        //create pieces jointe
        foreach($data['piece_jointes'] as $piece)
        {
            $jointe = $piece->store('Piece joint');

            'App\Piecejointe'::create([
                'url_piece_jointe' => $jointe,
                'courrier_id' => $courrier->id,
            ]);
        }
        //dd($courrier->piece_jointe[0]);
     	session()->flash('success','Courrier enregistré  avec succès');

    	return redirect('/courrier');
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
        $courrier = Courrier::find($id);
        $courrier->objet_courrier = $data['objet'];
        $courrier->description_courrier = $data['description_edit'];

        $courrier->date_depart = $data['date_depart'];
        $courrier->date_arrive = $data['date_arrive'];
        $courrier->num_depart = $data['num_depart'];
        $courrier->num_arrive = $data['num_arrive'];
        $courrier->classement_id = $data['classement'];
        $courrier->mention_id = $data['mention'];
        $courrier->typecourrier_id = $data['typecourrier'];
        if($request->hasFile('source')){
            Storage::delete($courrier->url_courrier);
            $courrier->url_courrier = $data['source']->store('Courriers');
        }

    	$courrier->save();

     	session()->flash('success','Courrier modifié avec succès');

     	return redirect('/courrier'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courrier $courrier)
    {   
        foreach($courrier->piece_jointe as $piece_jointe){
            Storage::delete($piece_jointe->url_piece_jointe);
            $piece_jointe->delete();
        }
        Storage::delete($courrier->url_courrier);
        $courrier->delete();
        session()->flash('success','Courrier supprimé avec succès');

    	return redirect('/courrier');
    }
    public function deleteattachment(Request $request) {
        $piecejointe = Piecejointe::find(request('url_piece_jointe'))->delete();
        //$path = public_path().'/attachments/'.$id.'/'.request('url_piece_jointe');
        //unlink($path);

        return response()->json($piecejointe);

    }
    public function get_pieces_jointe(Request $request){
        return response()->json(Courrier::find($request->id)->piece_jointe);
    }
    public function set_pieces_jointe(Request $request){
        

        return response()->json($request->id);
    }



}
