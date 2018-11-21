<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GraphsController extends Controller
{
    //TEST OF GRAPH VIEW

    public function graph_demo() {
        $dataPoints = array(
            array("x" => 946665000000, "y" => 3289000),
            array("x" => 978287400000, "y" => 3830000),
            array("x" => 1009823400000, "y" => 2009000),
            array("x" => 1041359400000, "y" => 2840000),
            array("x" => 1072895400000, "y" => 2396000),
            array("x" => 1104517800000, "y" => 1613000),
            array("x" => 1136053800000, "y" => 1821000),
            array("x" => 1167589800000, "y" => 2000000),
            array("x" => 1199125800000, "y" => 1397000),
            array("x" => 1230748200000, "y" => 2506000),
            array("x" => 1262284200000, "y" => 6704000),
            array("x" => 1293820200000, "y" => 5704000),
            array("x" => 1325356200000, "y" => 4009000),
            array("x" => 1356978600000, "y" => 3026000),
            array("x" => 1388514600000, "y" => 2394000),
            array("x" => 1420050600000, "y" => 1872000),
            array("x" => 1451586600000, "y" => 2140000)
         );
         return view('graph/demo', compact('dataPoints'));
         //return view('rankings/a_abs', compact('accounts'));
    }
}
