<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyBackUpController extends Controller
{
    public function index()
    {
        return view('backups')->with('files', Storage::allFiles('\Laravel'));
    }
    public function telecharger($index)
    {
        $count = 0;
        foreach( Storage::allFiles('\Laravel') as $file){
            $count = $count +1;
            if( $count == $index )
                return Storage::download($file);
        }

        
        return redirect()->back();
    }
    public function supprimer($index)
    {
        $count = 0;
        foreach( Storage::allFiles('\Laravel') as $file){
            $count = $count +1;
            if( $count == $index )
                Storage::delete($file);

        }

        session()->flash('success', 'Reccord supprimé avec succée');

        return redirect()->back();
    }
   
    public function nouveau_backup(){
        shell_exec('php ../artisan backup:run');
        session()->flash('success','Reccord enregistré avec succès');
        return redirect()->back();
    }
    //foreach ( $files as $file)
      //  
    //Storage::download('file.jpg');
    //
    //session()->flash('success','backup enregistré  avec succès');

    //


}
