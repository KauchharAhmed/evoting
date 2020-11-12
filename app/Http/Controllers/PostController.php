<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class PostController extends Controller
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
    // add post form
    public function addPost()
    {
    	return view('post.addPost');
    }
    // add post info
    public function addPostInfo(Request $request)
    {
    $this->validate($request, [
    'name'                    => 'required',
    'post_rank'               => 'required',
    ]);

     $name          	= trim($request->name);
     $post_rank    		= trim($request->post_rank);
     $remarks          	= trim($request->remarks);

     $count             = DB::table('tbl_post')->where('post_name',$name)->count();
     if($count > 0){
     	Session::put('failed','Sorry ! '.$name. ' Post Name Already Exits. Try To Add New Post');
        return Redirect::to('addPost');
     	exit();
     } 
     $count1             = DB::table('tbl_post')->where('post_rank',$post_rank)->count();
     if($count1 > 0){
     	Session::put('failed','Sorry ! '.$post_rank. ' Ballot Already Exits. Try To Add New Ballot');
        return Redirect::to('addPost');
     	exit();
     } 
     // insert post info
     $data 			      = array();
     $data['post_name']   = $name ;
     $data['post_rank']   = $post_rank ;
     $data['remarks']     = $remarks ;
     $data['created_at']  = $this->rcdate ;
     DB::table('tbl_post')->insert($data);
     Session::put('succes','Thanks , Post Added Sucessfully');
     return Redirect::to('addPost');
    }
    // manage post
    public function managePost()
    {
    	$result = DB::table('tbl_post')->get();
    	return view('post.managePost')->with('result',$result);
    }
    // add assign candidate post
    public function addAssiognCandidatePost()
    {
        // get election
        $election = DB::table('tbl_election')->where('status',0)->orderBy('id','desc')->get();
        // get all post
        $post     = DB::table('tbl_post')->where('status',0)->orderBy('post_rank','asc')->get();
        // get all candidate
        $candidate = DB::table('tbl_candidate')->where('status',0)->get();
        return view('post.addAssiognCandidatePost')->with('election',$election)->with('post',$post)->with('candidate',$candidate);
    }	
    // add candidate post
    public function addCandidetPostInfo(Request $request)
    {
    $this->validate($request, [
    'election'           => 'required',
    'post'               => 'required',
    'candidate'          => 'required',
    ]);

     $election          = trim($request->election);
     $post              = trim($request->post);
     $candidate         = trim($request->candidate);
     $remarks           = trim($request->remarks);
     #--------------------- check duplicate candidate----------------------#
     $count = DB::table('tbl_election_candidate_post')->where('election_id',$election)->where('candidate_id',$candidate)->count();
     if($count > 0){
        // alrady exits
        Session::put('failed','Sorry ! Candidate Post Already Added In This Election ');
        return Redirect::to('addAssiognCandidatePost');
        exit();

     }
    #-------------------- end duplicate candidate -------------------------#

     // inssert data
     $data                  = array();
     $data['election_id']   = $election ;
     $data['post_id']       = $post ;
     $data['candidate_id']  = $candidate ;
     $data['remarks']       = $remarks;
     $data['created_at']    = $this->rcdate ;
     DB::table('tbl_election_candidate_post')->insert($data);
     Session::put('succes','Thanks , Candidate Post Assiogn Sucessfully');
     return Redirect::to('addAssiognCandidatePost');
    }
    // manage assign candidate post
    public function manageAssiognCandidatePost()
    {
     // with join query
    $result = DB::table('tbl_election_candidate_post')
    ->join('tbl_election', 'tbl_election_candidate_post.election_id', '=', 'tbl_election.id')
    ->join('tbl_post', 'tbl_election_candidate_post.post_id', '=', 'tbl_post.id')
    ->join('tbl_candidate', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
    ->select('tbl_election_candidate_post.*','tbl_election.election_name','tbl_post.post_name','tbl_candidate.name','tbl_candidate.father_name','tbl_candidate.mobile')
    ->orderBy('tbl_election_candidate_post.id','desc')
    ->get();
    return view('post.manageAssiognCandidatePost')->with('result',$result);
    }

    // edit post
    public function editPost($id)
    {
        $row = DB::table('tbl_post')->where('id',$id)->first();
        return view('post.editPost')->with('row',$row);
    }

    // update post info
    public function updatePostInfo(Request $request)
    {
    $this->validate($request, [
    'name'          => 'required',
    'post_rank'     => 'required',
    ]);

     $name              = trim($request->name);
     $post_rank         = trim($request->post_rank);
     $remarks           = trim($request->remarks);
     $id                = trim($request->id);

     $count = DB::table('tbl_post')->where('post_name',$name)->whereNotIn('id',[$id])->count();
     if($count > 0){
        Session::put('failed','Sorry ! '.$name. ' Post Name Already Exits. Try To Add New Post');
        return Redirect::to('editPost'.'/'.$id);
        exit();
     }

     $count1 = DB::table('tbl_post')->where('post_rank',$post_rank)->whereNotIn('id',[$id])->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! '.$post_rank. ' Ballot Already Exits. Try To Add New Ballot');
        return Redirect::to('editPost'.$id);
        exit();
     } 
     // update post info
     $data                = array();
     $data['post_name']   = $name ;
     $data['post_rank']   = $post_rank ;
     $data['remarks']     = $remarks ;
     $data['modified_at'] = $this->rcdate ;
     DB::table('tbl_post')->where('id',$id)->update($data);
     Session::put('succes','Thanks , Post Updated Sucessfully');
     return Redirect::to('managePost');
    }
}
