<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use DB;
class SectorController extends Controller
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
        $sectores = Sector::paginate(7);
        return view('sector.index',compact('sectores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','soporte']);
        return view('sector.create');
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
        $existencia=DB::select("SELECT nombre from sectores where nombre like '%$query%'") ;
        if($existencia){
            return redirect()->route('tipo.create')->with('success','Ya existe el sector');
        }
        $sector = new Sector;
                        $sector->nombre = $request->input('nombre');                      
                        $sector->descripcion = $request->input('descripcion');
                        $sector->save();
            
             return redirect()->route('sector.index')->with('success','El Sector fue  creado correctamente');
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
        $sector = Sector::find($id);
        return view('sector.show',compact('sector'));
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
        $sector = Sector::find($id);
        return view('sector.edit',compact('sector'));
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
        $sector = Sector::find($id);
        $sector->nombre = $request->input('nombre');
        $sector->estado = true;
        $sector->descripcion = $request->input('descripcion');
        $sector->update();

        return redirect()->route('sector.index')->with('success','sector creado correctamente');
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
        $sector = Sector::find($id);
        if( $sector->estado == true ){
            $sector->estado = false;
            $hab = 'desabilitado';
        }else{
            $sector->estado = true;
            $hab = 'habilitado';
        }
        $sector->save();
        return redirect()->route('sector.index')->with('success','sector fue  '.$hab. '  correctamente');
    }
}
