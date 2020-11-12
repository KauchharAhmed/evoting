<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class ElectionController extends Controller
{
    private $rcdate ;
    private $loged_id ;
    private $current_time ;
	public function __construct() {
		date_default_timezone_set('Asia/Dhaka');
		$this->rcdate 		= date('Y-m-d');
		$this->current_time = date('H:i:s');
    $this->loged_id     = Session::get('admin_id');
    }
   // add election form
   public function addElection()
   {
   	return view('election.addElection');
   }
   // insert election info
   public function addElectionInfo(Request $request)
   {
   	$this->validate($request, [
    'name'                    => 'required'
    ]);

     $name          	= trim($request->name);
     $remarks          	= trim($request->remarks);
     $count             = DB::table('tbl_election')->where('election_name',$name)->count();
     if($count > 0){
     	Session::put('failed','Sorry ! '.$name. ' Election Already Exits. Try To Add New Election');
        return Redirect::to('addElection');
     	exit();
     } 
     // insert eletion table
     $data 				     = array();
     $data['election_name']  = $name ;
     $data['remarks']  		 = $remarks ;
     $data['created_at']     = $this->rcdate ;
     DB::table('tbl_election')->insert($data);
     Session::put('succes','Thanks , Election Added Sucessfully');
     return Redirect::to('addElection');     
   }
   // manage election
   public function manageElection()
   {
   	$result = DB::table('tbl_election')->orderBy('id','desc')->get();
   	return view('election.manageElection')->with('result',$result);
   }
   // add symbole form
   public function addSymbol()
   {
    return view('election.addSymbol');
   }
   // add election symbol info
   public function addSymbolInfo(Request $request)
   {
    $this->validate($request, [
    'name'              => 'required',
    'image'             => 'required|mimes:jpeg,jpg,png|max:300'
    ]);
     $name                  = trim($request->name);
     $remarks               = trim($request->remarks);
     //check duplicate supplier name
     $count = DB::table('tbl_symbol')
     ->where('symbol_name',$name)
     ->count();
     if($count > 0){
        Session::put('failed','Sorry ! Symbol Name Already Exits');
        return Redirect::to('addSymbol');
        exit();
     }
     $data=array();
     $data['symbol_name']     = $name ;
     $data['remarks']         = $remarks;
     $data['status']          = 0;
     $data['added_id']        = $this->loged_id ;
     $data['created_at']      = $this->rcdate ;
     $image                   = $request->file('image');
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='symbol-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('tbl_symbol')->insert($data);
        }
        Session::put('succes','New Symbol Added Sucessfully');
        return Redirect::to('addSymbol');
   }
   // manage symbol
   public function manageSymbol()
   {
    $result = DB::table('tbl_symbol')->get();
    return view('election.manageSymbol')->with('result',$result);
   }

   // edit election
   public function editElection($id)
   {
      $row = DB::table('tbl_election')->where('id',$id)->first();
      return view('election.editElection')->with('row',$row);
   }

   // update election info
   public function updateElectionInfo(Request $request)
   {
    $this->validate($request, [
    'name'   => 'required'
    ]);

     $name            = trim($request->name);
     $remarks         = trim($request->remarks);
     $id              = trim($request->id);
     
     $count = DB::table('tbl_election')->where('election_name',$name)->whereNotIn('id',[$id])->count();
     if($count > 0){
      Session::put('failed','Sorry ! '.$name. ' Election Already Exits. Try To Add New Election');
        return Redirect::to('editElection/'.$id);
      exit();
     } 
     // update eletion table
     $data             = array();
     $data['election_name']   = $name ;
     $data['remarks']         = $remarks ;
     $data['modified_at']     = $this->rcdate ;
     DB::table('tbl_election')->where('id',$id)->update($data);
     Session::put('succes','Thanks , Election Updated Sucessfully');
     return Redirect::to('manageElection');     
   }

}
