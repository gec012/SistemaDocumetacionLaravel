<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Incidente;
use App\Tipo;
use App\User;
use DateTime;
use DB;
use App\DetalleDeIncidente;
use Carbon\Carbon;
use App\Sector;
use App\Alerta;
use Illuminate\Support\Facades\Storage;



class IncidentesController extends Controller
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
    public function index(Request $request )
    {
  /*      
        $pastel = DB::select("SELECT count('credencial') as total, estado as ubicacion
        FROM customers INNER JOIN states 
        ON customers.estadof_id=states.id GROUP BY ubicacion");

        $a = 'Admin';
        $p = 'Pendiente';
         $incidentes =
        DB::select("select * from incidentes where estado = '$p' and 
        reporter_id in(select id from users where name like '$a' )
        ");
        dd($incidentes);    
*/       
        $tam=0;
        $alerta=Alerta::all();
        if($alerta->isEmpty()){
            $alert = new Alerta;
            $alert->cantidad = 0;
            $alert->save();
        }else{
            $alert = $alerta->first();
        }
        $usuarios= User::all();
        $sectores = Sector::where('estado',true)->get();

              
        if(Auth::user()->rol <> '3'){

            if($request)
            { 
                $details=DetalleDeIncidente::all();
              
                $query=trim($request->get('searchText'));                
                $collecion = collect([]);
                $filtros=collect(['nombre','estado','tipo']);
               
                
                if($request->get('EnProceso')){
                   $collecion->push( $filtros->combine(['En Proceso',true,'estado']));
                  
                }else {
                    $collecion->push( $filtros->combine(['En Proceso',false,'estado']));
                   
                }
                
                if($request->get('Pendiente')){
                    $collecion->push( $filtros->combine(['Pendiente',true,'estado']));                    
                }else {
                   
                    $collecion->push( $filtros->combine(['Pendiente',false,'estado']));
                }
                 if($request->get('Finalizado')){
                    $collecion->push( $filtros->combine(['Finalizado',true,'estado']));
                }else {
                    $collecion->push( $filtros->combine(['Finalizado',false,'estado']));
                }
                 if($request->get('Requisito(Deseo)')){
                    $collecion->push( $filtros->combine(['Requisito(Deseo)',true,'caracter']));
                }else {
                    $collecion->push( $filtros->combine(['Requisito(Deseo)',false,'caracter']));
                }
                 if($request->get('Sinapuro')){
                    $collecion->push( $filtros->combine(['Sin apuro',true,'caracter']));
                }else {
                    $collecion->push( $filtros->combine(['Sin apuro',false,'caracter']));
                }
                 if($request->get('Urgente')){
                    $collecion->push( $filtros->combine(['Urgente',true,'caracter']));
                }else {
                    $collecion->push( $filtros->combine(['Urgente',false,'caracter']));
                }


                foreach ($sectores as $sector) {
                    if($request->get($sector->id)){
                        $collecion->push( $filtros->combine([$sector->id,true,'sector']));
                    }else {
                        $collecion->push( $filtros->combine([$sector->id,false,'sector']));
                    }
                }
               
                $finalizado =  $filtros;
                $searchText=$query;           
                 
                
                $incidentes=DB::table('incidentes as i')
                ->join('users as u','i.reporter_id','=','u.id')
               

                ->select ( 'i.id','i.nombre','i.estado','i.caracter','u.name as usuario','u.id as idusuario','i.created_at')
                        
                ->where('i.estado','LIKE','%'.$query.'%') 
                ->orwhere('i.caracter','LIKE','%'.$query.'%') 
                ->orwhere('u.name','LIKE','%'.$query.'%')
                ->orderBy('i.created_at','i.estado','desc')
                ->get();

                 
                foreach ($collecion as $col) {                   
                   
                    
                    if($col['estado'] == true){
                        $incidentes = $incidentes->where($col['tipo'],'LIKE',$col['nombre']);

                    }
                    
                }
                /*
            
                $incidentes=DB::table('incidentes as i')
                ->join('users as u','i.reporter_id','=','u.id')
                 ->select ( 'i.id','i.nombre','i.estado','i.caracter','u.name as usuario','u.id as idusuario','i.created_at')
                ->where('i.estado','LIKE','%'.$query.'%') 
                ->orwhere('i.caracter','LIKE','%'.$query.'%') 
                ->orwhere('u.name','LIKE','%'.$query.'%')
                ->orderBy('i.created_at','i.estado','desc')
                ->paginate(7);
*/
                
                $in = Incidente::all();
                if($alert->cantidad <> $in->count()){
                   
                    $tam =$in->count()-$alert->cantidad;
                    $alert->cantidad = $in->count();
                    $alert->update();
                    
                }
                
            
                    return view('incidente.index')->with(compact('incidentes','searchText','usuarios','details','tam','sectores'));
                
            } 
        }else{


            if($request)
            { 
                
                $details=DetalleDeIncidente::all();
                //SOlO PARA USUARIOS 
                $query=trim($request->get('searchText'));
                $searchText=$query;           
                $sectores = Auth::user()->sectores;
                $incidentes = collect([]);
                foreach ($sectores as $sector) {
                    $inci=DB::table('incidentes as i')
                    ->join('users as u','i.reporter_id','=','u.id')
                    ->join('detalles_de_incidentes as di','i.id','=','di.incidente_id')
                    
                    ->select ( 'i.id','i.nombre','i.estado','i.caracter','u.name as usuario','u.id as idusuario','i.created_at')
                    
                    ->where('di.sector_id','=',$sector->id)
                    ->where('di.estado','<>','Reenviado')
                    ->where('i.estado','LIKE','%'.$query.'%') 
                    ->where('i.estado','<>','Finalizado')                   
                    ->orderBy('i.created_at','i.estado','desc')
                    ->get();

                    if($incidentes->isEmpty()){
                        $incidentes = $inci;
                    }else{
                        $incidentes = $incidentes->merge($inci);
                
                    }
                   
                } 

             
                
            $tam=0;
            return view('incidente.index')->with(compact('incidentes','searchText','usuarios','details','tam','sectores'));
            }
        }

    }
        
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::where('estado', true )->get();
        $sectores = Sector::where('estado', true )->get();

        return view('incidente.create',compact('users','sectores','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->tipo==null){
            return back()->with('error','Debe ingresar un tipo de incidente');;     
         }
        $incidente = new Incidente;
        $incidente->nombre=$request->get('nombre');
        $incidente->detalle=$request->get('detalle');
        $incidente->estado= 'Pendiente'; //pendiente enproceso finalizado
        $incidente->caracter=$request->get('caracter');
        $incidente->reporter_id=Auth::user()->id;
        $incidente->tipo_id=$request->get('tipo');

       

        if($request->file('file')){
            $imagenOriginal = $request->file('file');
            $nombre =  $imagenOriginal->getClientOriginalName();
            $path = Storage::putFileAs('Imagenes',  $imagenOriginal, $nombre);
                

            $incidente->imagen= 'app/'.$path ;
        }

    $incidente->save();

    $detalleInci = new DetalleDeIncidente;
    $detalleInci->incidente_id = $incidente->id;
    $detalleInci->send_id = Auth::user()->id;
    $detalleInci->sector_id = $request->get('sector');
    $detalleInci->estado = 'Enviado';
    $detalleInci->observaciones = 'Incidente reportado';
    $detalleInci->save();
    return redirect()->route('incidente.index')->with('success','incidente  creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incidente=Incidente::find($id);
       
        $tipos = Tipo::find($incidente->tipo_id);
        $reporter = User::find($incidente->reporter_id);

        $sectores = Sector::all();
        $users = User::all();
        $detallesInci = DetalleDeIncidente::where('incidente_id',$id)->get();

        if($incidente->estado == "Finalizado"){
            $resolver = User::find($incidente->resolver_id);
         }
        else{
            $resolver = null;

        }
            return view('incidente.show',compact('sectores','users','detallesInci','incidente','tipos','reporter','resolver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipos = Tipo::where('estado', true )->get();
        $incidente=Incidente::find($id);
        $reporter=User::find($incidente->reporter_id);
        $resolver=User::find($incidente->resolver_id);
        $sectores = Sector::all();
        
       
        return view('incidente.edit',compact('incidente','tipos','reporter','resolver','sectores'));
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

        
       if($request->get('check') == null){
            
        if($request->tipo==null){
            return back()->with('error','Debe ingresar un tipo de incidente');;     
         }
         $incidente = Incidente::find($id);
         $incidente->nombre=$request->get('nombre');
         $incidente->tipo_id=$request->get('tipo');
         $incidente->caracter=$request->get('caracter');
         if(Auth::user()->rol <> '3'){
             $incidente->estado= $request->get('estado');
         }
         if($incidente->estado <> 'Finalizado'){
             $incidente->finalizado = null;
         }
         $incidente->detalle=$request->get('detalle');
         
         $detalleInci = new DetalleDeIncidente;
         $detalleInci->incidente_id = $id;
         $detalleInci->send_id = Auth::user()->id;

         

         $detalleInci->observaciones = $request->get('observaciones');
       
         if($request->get('finalizar') == '0'){

            $detalleInci->estado  = 'Finalizado';
            $incidente->estado =  'Finalizado';
            $incidente->finalizado = Carbon::now();
            $incidente->resolver_id = Auth::user()->id;

         }else{

            if($request->get('sector') <> null){
                $detauxs = DetalleDeIncidente::where('incidente_id',$id)->get();
                $detaux = $detauxs->last();
                 $detaux->estado  ='Reenviado';
                $detaux->update();
                $detalleInci->sector_id = $request->get('sector');
                $detalleInci->estado  ='Enviado';
             }else{
                return back()->with('error','Debe ingresar un sector o finalizar el incidente');;  
             }
           
         }


         $detalleInci->save();         
         $incidente->update();

         return  redirect()->route('incidente.index');

       }else{

        $detalle = DetalleDeIncidente::where('incidente_id', $id)->where('estado','Enviado')->first();
        $detalle->estado = 'Recibido';
        $detalle->recived_id = Auth::user()->id;
        $detalle->hora_de_recibido = Carbon::now();        
        $detalle->update();

        $inci = Incidente::find($id);
        $inci->estado = 'En Proceso';
        $inci->update();

         return  redirect()->route('incidente.index');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $incidente=Incidente::find($id);
        $incidente->estado="Finalizado";
        $incidente->resolver_id = Auth::user()->id;

        $now = new DateTime();
        $incidente->finalizado =  $now;
        $incidente->update();
       
      
    return redirect()->route('incidente.index');
    }


    
}
