<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Municipe;
class municipeController extends Controller
{
  
    function getMunicipe(){
        return Municipe::all();
    }
    function getMunicipeById($id){
        return Municipe::where('id','=',$id)->get();
    }
    function getMunicipeByProvince($id_province){
        return Municipe::where('id_province','=',$id_province)->with(['province'])->get();
    }
  
}
        