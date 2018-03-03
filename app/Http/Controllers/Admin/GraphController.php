<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Repositories\AppPerformance;

class GraphController extends Controller
{
    public function onBoarding()
    {

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        return response()->json($aData['graph_data']);

    }
}
