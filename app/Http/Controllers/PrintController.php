<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class PrintController extends Controller
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
    // print 
    public function printElectionResultReport(Request $request)
    {
     $election = trim($request->election);
     $post     = trim($request->post);
     $count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post)->count();
     if($count == '0'){
     	echo 'f1';
     	exit();
     }
     // election info
     $election_info = DB::table('tbl_election')->where('id',$election)->first();
     $post_info     = DB::table('tbl_post')->where('id',$post)->first();
     // total voters of this election
     $total_voters_count    = DB::table('tbl_election_active_voter')->where('election_id',$election)->count();
     $total_vote_cast_count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post)->count();
     // vote case count
      $result = DB::table('tbl_final_vote')
      ->join('tbl_candidate','tbl_final_vote.candidate_id','=','tbl_candidate.id')
      ->select('tbl_final_vote.*','tbl_candidate.name','tbl_candidate.image', DB::raw("COUNT(tbl_final_vote.candidate_id) AS count"))
      ->where('tbl_final_vote.election_id',$election)
      ->where('tbl_final_vote.post_id',$post)
      ->groupBy('tbl_final_vote.candidate_id')
      ->orderBy('count','desc')
      ->get();

      foreach ($result as $candidate_value) {
        $candidate_id[] = $candidate_value->candidate_id;
      }

    $absent_candidate = DB::table('tbl_candidate')
  ->join('tbl_election_candidate_post', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
  ->select('tbl_election_candidate_post.*','tbl_candidate.name','tbl_candidate.image')
   ->where('tbl_election_candidate_post.election_id',$election)
   ->where('tbl_election_candidate_post.post_id',$post)
   ->whereNotIn('tbl_election_candidate_post.candidate_id',$candidate_id)
   ->orderBy('tbl_candidate.id','asc')
  ->get();
    $no_vote_count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post)->where('candidate_id','0')->count();
  
      return view('print.printElectionResultReport')->with('result',$result)->with('election',$election)->with('post',$post)->with('election_info',$election_info)->with('post_info',$post_info)->with('total_voters_count',$total_voters_count)->with('total_vote_cast_count',$total_vote_cast_count)->with('absent_candidate',$absent_candidate)->with('no_vote_count',$no_vote_count); 
    }
    // print final result
    public function printFinalElectionResultReport(Request $request)
    {
      $election = trim($request->election);
     $count     = DB::table('tbl_election_candidate_post')->where('election_id',$election)->count();
     if($count == '0'){
      echo 'f1';
      exit();
     }
    $post     = DB::table('tbl_election_candidate_post')->where('election_id',$election)->groupBy('post_id')->get();
      $total_voters_count    = DB::table('tbl_election_active_voter')->where('election_id',$election)->count();
       $election_info = DB::table('tbl_election')->where('id',$election)->first();
        $total_vote_cast_count = DB::table('tbl_final_vote')->where('election_id',$election)->distinct('voter_id')->count('voter_id');
    return view('print.printFinalElectionResultReport')->with('post',$post)->with('election',$election)->with('total_voters_count',$total_voters_count)->with('election_info',$election_info)->with('total_vote_cast_count',$total_vote_cast_count);
    }
}
