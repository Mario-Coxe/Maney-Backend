<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;

class streetController extends Controller
{
    function getStreet()
    {
        return Street::all();
    }
    function getStreetById($id)
    {
        return Street::find($id);
    }
    function getStreetByMunicipe($id)
    {
        return Street::where('id_municipe', '=', $id)->get();
    }
}
