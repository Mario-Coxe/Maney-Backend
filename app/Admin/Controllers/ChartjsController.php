<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Atm;
use App\Models\Street;
use App\Models\Municipe;
use App\Models\Advertising;
use App\Models\AtmAgent;
use App\Models\UserSubscription;
use Encore\Admin\Grid\Filter\Where;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;

class ChartjsController extends Controller
{
    public function index(Content $content)
    {
        $totalUsers = User::count(); // Total de usuários no sistema
        $totalAgentes = User::where('tipo_usuario', 'agente')->count(); // Total de usuários do tipo "agente"
        $totalClientes = User::where('tipo_usuario', 'cliente')
        ->orWhere('tipo_usuario', 'other')
        ->count();
    
     // Total de usuários do tipo "cliente"
        $totalATMsemAgente = Atm::where('status', '0')->count();


        $totalMunicipios = Municipe::count();
        $totalUserSubscription = UserSubscription::count();
        $totalATMagentes = AtmAgent::count();
        $totalAtms = Atm::count(); // Total de ATMs
        //$totalPublicidades = Advertising::count(); // Total de publicidades
        $totalRuas = Street::count(); // Total de ruas


        return $content
            ->header('Chartjs')
            ->body(new Box('Bar chart', view('admin.chartjs', compact('totalAgentes', 'totalClientes', 'totalAtms', 'totalRuas', 'totalMunicipios', 'totalATMagentes', 'totalUserSubscription', 'totalATMsemAgente'))));
    }
}
