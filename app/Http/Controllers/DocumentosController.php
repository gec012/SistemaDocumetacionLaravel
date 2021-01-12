<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DetalleDelDocumento;
use App\Tipo;
use App\User;
use DateTime;
use DB;
use App\Documento;
use Carbon\Carbon;
use App\Sector;
use App\Alerta;
use Illuminate\Support\Facades\Storage;


class DocumentosController extends Controller
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
                $details=DetalleDelDocumento::all();
              
                    
                 
                $documentos=DB::select("SELECT d.id , d.numero, d.titulo , d.estado ,d.sent_id,d.created_at from documentos as d 
                                            inner join users as u on d.sent_id = u.id 
                                            order by 6 desc");
               
                
                $in = documento::all();
                if($alert->cantidad <> $in->count()){
                   
                    $tam =$in->count()-$alert->cantidad;
                    $alert->cantidad = $in->count();
                    $alert->update();
                    
                }
                
            
                    return view('documento.index')->with(compact('documentos','usuarios','details','tam','sectores'));
                
            } 
        }else{


            if($request)
            { 
                
                $details=DetalleDelDocumento::all();
                //SOLO PARA USUARIOS          
                $id = Auth::user()->id;
                
                $sectores = Auth::user()->sectores;
                $documentos =DB::select("SELECT d.id , d.numero, d.titulo , d.estado ,d.sent_id,d.created_at FROM documentos AS d INNER JOIN detalle_de_documentos as dd on d.id =dd.documento_id 
                                                    WHERE (dd.estado like 'Recibido' OR dd.estado  like 'Enviado' )
                                                    and (d.estado <> 'Finalizado') 
                                                    and dd.sector_id in (
                                                        select sector_id from sectores as s 
                                                        inner join sector_user as su on s.id=su.sector_id
                                                        inner join users as u on u.id=su.user_id
                                                        where u.id='$id')                           
                  ");
               
            $tam=0;
            return view('documento.index')->with(compact('documentos','usuarios','details','tam','sectores'));
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

        return view('documento.create',compact('users','sectores','tipos'));
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
            return back()->with('error','Debe ingresar un tipo de documento');;     
         }
         $query=$request->get('numero');
         $existencia=DB::select("SELECT numero from documentos where numero like '%$query%'") ;
         if($existencia){
             return redirect()->route('documento.create')->with('success','Ya existe el  documento');
         }
        $documento = new documento;
        $documento->titulo=$request->get('titulo');
        $documento->numero=$request->get('numero');
        $documento->observacion=$request->get('observacion');
        $documento->estado='Iniciado';
        $documento->sent_id=Auth::user()->id;
        $documento->tipo_id=$request->get('tipo');

        $documento->save();

        $detalleInci = new DetalleDelDocumento;
        $detalleInci->documento_id = $documento->id;
        $detalleInci->send_id = Auth::user()->id;
        $detalleInci->sector_id = $request->get('sector');
        $detalleInci->estado = 'Enviado';
        $detalleInci->observaciones = 'documento reportado';
        $detalleInci->save();
    return redirect()->route('documento.index')->with('success','documento  creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documento=documento::find($id);
       
        $tipos = Tipo::find($documento->tipo_id);
        $reporter = User::find($documento->sent_id);

        $sectores = Sector::all();
        $users = User::all();
        $detallesDoc = DetalleDelDocumento::where('documento_id',$id)->get();

       
            return view('documento.show',compact('sectores','users','detallesDoc','documento','tipos','reporter'));
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
        $documento=documento::find($id);
        $reporter=User::find($documento->sent_id);
       
        $sectores = Sector::all();
        
       
        return view('documento.edit',compact('documento','tipos','reporter','sectores'));
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
            return back()->with('error','Debe ingresar un tipo de documento');;     
         }
         $documento = documento::find($id);
         
         $documento->tipo_id=$request->get('tipo');

         if(Auth::user()->rol <> '3'){
             
            $documento->numero=$request->get('numero');
            $documento->titulo=$request->get('titulo');
            $documento->observacion=$request->get('observacion');
             $documento->estado= $request->get('estado');
         }
        
         
         $detalleInci = new DetalleDelDocumento;
         $detalleInci->documento_id = $id;
         $detalleInci->send_id = Auth::user()->id;

         

         $detalleInci->observaciones = $request->get('observaciones');
       
         if($request->get('finalizar') == '0'){

            $detalleInci->estado  = 'Finalizado';
            $documento->estado =  'Finalizado';
            
         }else{

            if($request->get('sector') <> null){
                $detauxs = DetalleDelDocumento::where('documento_id',$id)->get();
                $detaux = $detauxs->last();
                $detaux->estado  ='Reenviado';
                $detaux->update();
                $detalleInci->sector_id = $request->get('sector');
                $detalleInci->estado  ='Enviado';
                
             }else{
                return back()->with('error','Debe ingresar un sector o finalizar el documento');;  
             }
           
         }


         $detalleInci->save();         
         $documento->update();

         return  redirect()->route('documento.index');

       }else{

        $detalle = DetalleDelDocumento::where('documento_id', $id)->where('estado','Enviado')->first();
        $detalle->estado = 'Recibido';
        $detalle->recived_id = Auth::user()->id;
        $detalle->hora_de_recibido = Carbon::now();        
        $detalle->update();

        $Doc = documento::find($id);
        $Doc->estado = 'En Proceso';
        $Doc->update();

         return  redirect()->route('documento.index');
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
        $documento=documento::find($id);
        $documento->estado="Finalizado";

        $now = new DateTime();
     
        $documento->update();
       
      
    return redirect()->route('documento.index');
    }


}
