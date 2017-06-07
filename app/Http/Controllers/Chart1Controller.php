<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Chart1Controller extends Controller
{
	@return 
    public function chart1()
	{
	    $x1 = CompanyDetails::where ( 'x', '006' )->get ();
	    
	    return view('chartjs')
	            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK))
	            ->with('click',json_encode($click,JSON_NUMERIC_CHECK));
	}
}
