<?php

namespace App\Http\Controllers\Declaration;

use App\Model\Declaration\Declaration;
use App\repositories\Declaration\DeclarationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeclarationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function store(Request $request,DeclarationRepository $declarationRepository)
    {
        $this->validation($request);
        
        $declaration = $declarationRepository->create($request->all());

        //todo handle file upload
        
        Session::flash("message",trans('declaration.created'));
        
        return redirect('/users/' . Auth::id());
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Declaration $declaration)
    {

        if($declaration->state !== Declaration::STATE_PENDING){
            Session::flash("error",trans('declaration.updateError'));
            return redirect('/users/' . Auth::id());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,DeclarationRepository $declarationRepository)
    {
        $this->validation($request);
        $declaration = Declaration::find($id);
        
        if($declaration->state !== Declaration::STATE_PENDING){
            Session::flash("error",trans('declaration.updateError'));
            return redirect('/users/' . Auth::id());
        }
        
        $declaration = $declarationRepository->update($id,$request->all());

        //todo handle file upload

        Session::flash("message",trans('declaration.updated'));

        return redirect('/users/' . Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,DeclarationRepository $declarationRepository)
    {
        $declaration = Declaration::find($id);
        if($declaration->state !== Declaration::STATE_PENDING){
            Session::flash("error",trans('declaration.updateError'));
            return redirect('/users/' . Auth::id());
        }

        $declarationRepository->delete($id);
        
        Session::flash("message",trans('declaration.deleted'));

        return redirect('/users/' . Auth::id());
    }
    
    private function validation(Request $request){
        $this->validate($request,[
            'activtiy' => "required",
            'price' => "required",
            'type' => "required",
            'date' => "required",
        ]);
    }
}
