<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class provinceController extends Controller
{
    //
    function getProvince()
    {
        return Province::all();
    }
    function getProvinceById($id)
    {
        return Province::find($id);
    }
}
