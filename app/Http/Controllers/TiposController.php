<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use DB;
class TiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','soporte']);
        $tipos = Tipo::paginate(7);
        return view('tipo.index',compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $request->user()->authorizeRoles(['admin','soporte']);
        return view('tipo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->user()->authorizeRoles(['admin','soporte']);
       
      
         $query=$request->get('nombre');
        $existencia=DB::select("SELECT nombre from tipos where nombre like '%$query%'") ;
        if($existencia){
            return redirect()->route('tipo.create')->with('success','Ya existe el tipo de documento');
        }



       
        $tipo = new Tipo;
                        $tipo->nombre = $request->input('nombre');                      
                        $tipo->descripcion = $request->input('descripcion');
                        $tipo->save();
            
             return redirect()->route('tipo.index')->with('success','Tipo  creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin','soporte']);
        $tipo = Tipo::find($id);
        return view('tipo.show',compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin','soporte']);
        $tipo = Tipo::find($id);
        return view('tipo.edit',compact('tipo'));
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
        $request->user()->authorizeRoles(['admin','soporte']);
        $tipo = Tipo::find($id);
        $tipo->nombre = $request->input('nombre');
        $tipo->estado = true;
        $tipo->descripcion = $request->input('descripcion');
        $tipo->update();

        return redirect()->route('tipo.index')->with('success','Tipo creado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $request->user()->authorizeRoles(['admin','soporte']);
        $tipo = Tipo::find($id);
        if( $tipo->estado == true ){
            $tipo->estado = false;
            $hab = 'desabilitado';
        }else{
            $tipo->estado = true;
            $hab = 'habilitado';
        }
        $tipo->save();
        return redirect()->route('tipo.index')->with('success','Tipo fue  '.$hab. '  correctamente');
    }
}
