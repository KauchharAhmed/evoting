<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;

class ReportController extends Controller
{
    private $rcdate ;
    private $loged_id ;
    private $current_time ;
    private $voter_id ;
	public function __construct() {
		date_default_timezone_set('Asia/Dhaka');
		$this->rcdate 		= date('Y-m-d');
		$this->current_time = date('H:i:s');
    $this->loged_id     = Session::get('admin_id');
    $this->voter_id     = Session::get('voter_id');
    }
   // result report
   public function postWiseElectionResultReport()
   {
   	  $election = DB::table('tbl_election')->where('status',0)->orderBy('id','desc')->get();
   	  $post     = DB::table('tbl_post')->where('status',0)->orderBy('post_rank','asc')->get();
      return view('report.postWiseElectionResultReport')->with('election',$election)->with('post',$post);
   }
   // view election result
   public function postWiseElectionResultReportView(Request $request)
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

    $count_result =  count($result);
      foreach ($result as $candidate_value) {
        $candidate_id[] = $candidate_value->candidate_id;
      }
    if($count_result == '0'){
        $absent_candidate = DB::table('tbl_candidate')
  ->join('tbl_election_candidate_post', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
  ->select('tbl_election_candidate_post.*','tbl_candidate.name','tbl_candidate.image')
   ->where('tbl_election_candidate_post.election_id',$election)
   ->where('tbl_election_candidate_post.post_id',$post)
   ->orderBy('tbl_candidate.id','asc')
  ->get();

    }else{
    $absent_candidate = DB::table('tbl_candidate')
  ->join('tbl_election_candidate_post', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
  ->select('tbl_election_candidate_post.*','tbl_candidate.name','tbl_candidate.image')
   ->where('tbl_election_candidate_post.election_id',$election)
   ->where('tbl_election_candidate_post.post_id',$post)
   ->whereNotIn('tbl_election_candidate_post.candidate_id',$candidate_id)
   ->orderBy('tbl_candidate.id','asc')
  ->get();
}

  $no_vote_count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post)->where('candidate_id','0')->count();

      return view('view_report.postWiseElectionResultReportView')->with('result',$result)->with('election',$election)->with('post',$post)->with('election_info',$election_info)->with('post_info',$post_info)->with('total_voters_count',$total_voters_count)->with('total_vote_cast_count',$total_vote_cast_count)->with('absent_candidate',$absent_candidate)->with('no_vote_count',$no_vote_count); 
   }
   // election voter list
   public function electionVoterList()
   {
    $election = DB::table('tbl_election')->where('status',0)->orderBy('id','desc')->get();
    return view('report.electionVoterList')->with('election',$election);
   }

   public function getVoterList(Request $request)
   {
      $election = trim($request->election);

     $count = DB::table('tbl_election_active_voter')
      ->join('tbl_voter','tbl_election_active_voter.voter_id','=','tbl_voter.id')
      ->select('tbl_voter.*')
      ->where('tbl_election_active_voter.election_id',$election)
      ->orderBy('tbl_voter.voter_id','asc')
      ->count();
      if($count == '0'){
        echo "f1";
        exit();
      }

      // election info
      $election_info = DB::table('tbl_election')->where('id',$election)->first();
      $result = DB::table('tbl_election_active_voter')
      ->join('tbl_voter','tbl_election_active_voter.voter_id','=','tbl_voter.id')
      ->select('tbl_voter.*')
      ->where('tbl_election_active_voter.election_id',$election)
      ->orderBy('tbl_voter.voter_id','asc')
      ->get();
      return view('view_report.getVoterList')->with('result',$result)->with('election_info',$election_info)->with('election',$election);
   }
   // vote summary report
   public function voterVoteSummary()
   {
      $election = DB::table('tbl_election')->where('status',0)->orderBy('id','desc')->get();
      return view('report.voterVoteSummary')->with('election',$election);
   }
   // get voter vote summary
   public function getVoterVoteSummary(Request $request)
   {
      $election = trim($request->election);
       $result = DB::table('tbl_final_vote')
       ->join('tbl_post','tbl_final_vote.post_id','=','tbl_post.id')
      ->leftJoin('tbl_candidate','tbl_final_vote.candidate_id','=','tbl_candidate.id')
      ->select('tbl_final_vote.*','tbl_candidate.name','tbl_candidate.image','tbl_post.post_name')
      ->where('tbl_final_vote.election_id',$election)
      ->where('tbl_final_vote.voter_id',$this->voter_id)
      ->orderBy('tbl_final_vote.id','asc')
      ->get();
      $election_info = DB::table('tbl_election')->where('id',$election)->first();
      return view('view_report.getVoterVoteSummary')->with('result',$result)->with('election_info',$election_info)->with('election',$election);

   }
   // election report
   public function electionResultReport()
   {
      $election = DB::table('tbl_election')->where('status',0)->orderBy('id','desc')->get();
      return view('report.electionResultReport')->with('election',$election);
   }
   // eleectio result report view
   public function electionResultReportView(Request $request)
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
    return view('view_report.electionResultReportView')->with('post',$post)->with('election',$election)->with('total_voters_count',$total_voters_count)->with('election_info',$election_info)->with('total_vote_cast_count',$total_vote_cast_count);
 

   }
}
