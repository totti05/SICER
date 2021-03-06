<?php

namespace App\Http\Controllers;

use App\Celda;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        return view('cell.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(Cell $cell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cell $cell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        //
    }

    public function CellDataChart()
    {
        $result = DB::connection('reduccion')->table('diariocelda')
        ->whereBetween('celda', [1000,1001])
        ->whereYear('dia','2018')
        ->whereMonth('dia','05')
        ->get();
        return response()->json($result);
    
    }
    
    public function CellDataTable(Request $request){
        
        if ($request->isMethod('get')) {
           $celdas = DB::connection('reduccion')->table('diariocelda')
        ->whereBetween('celda', [1001 ,1002])
        ->whereYear('dia', '2018')
        ->whereMonth('dia', '05')
        ->get();
        return Datatables::of($celdas)->make();
        }else{
            list( $fecha1, $fecha2) = explode(' - ', $request->input('0.value'));
            $celda1 = $request->input('1.value');
            $celda2 = $request->input('2.value');
            
            $celdas = DB::connection('reduccion')->table('diariocelda')
                        ->whereBetween('celda', [$celda1,$celda2])
                        ->whereBetween('dia', [$fecha1,$fecha2])  
                        ->get();
                        return Datatables::of($celdas)->make();; 
                        

        }
        /*
 
        elseif ($request->isMethod('get')) {
         }
       */
    }

}
