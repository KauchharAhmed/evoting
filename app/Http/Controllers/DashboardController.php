<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;


class DashboardController extends Controller
{
	 private $rcdate ;
     private $current_time ;
     private $loged_id ;
     private $type ;
     public function __construct() {
    $this->rcdate 		  = date('Y-m-d');
	$this->current_time = date('H:i:s');
    $this->loged_id     = Session::get('admin_id');
    $this->type     	= Session::get('type');
	}

	#--------------------- Admin Dashboard -----------------------#
	public function adminDashboard()
	{
	    return view('admin.adminDashboard');
	}
	#-------------------- end admin dashborad---------------------#
}
