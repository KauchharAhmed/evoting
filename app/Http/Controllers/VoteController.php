<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
use Mail;

class VoteController extends Controller
{
    private $rcdate ;
    private $voter_id ;
    private $current_time ;
	public function __construct() {
		date_default_timezone_set('Asia/Dhaka');
		$this->rcdate 		= date('Y-m-d');
		$this->current_time = date('H:i:s');
        $this->voter_id     = Session::get('voter_id');
    }
    // add vote time and date 
    public function addVotingDateAndTime()
    {
    	// election 
    	$election = DB::table('tbl_election')->orderBy('id','desc')->get();
    	return view('vote.addVotingDateAndTime')->with('election',$election);
    }
   // add vote date and time
    public function addVoteDateAndTimeInfo(Request $request)
    {
         $this->validate($request, [
        'election'              => 'required',
        'start_date'            => 'required',
        'start_time'            => 'required',
        'end_date'              => 'required',
        'end_time'              => 'required'
        ]);
        $election                    = trim($request->election);
        $start_date                  = trim($request->start_date);
        $startDate                   = date('Y-m-d',strtotime($start_date));
        $twenty_four_hour_start_time = trim($request->start_time); 
        $startTime                   = date("H:i:s", strtotime($twenty_four_hour_start_time));
        $end_date                    = trim($request->end_date);
        $endDate                     = date('Y-m-d',strtotime($end_date));
        $twenty_four_hour_end_time   = trim($request->end_time); 
        $endTime                     = date("H:i:s", strtotime($twenty_four_hour_end_time));
        $remarks                     = trim($request->remarks);
        #----------------------- duplicate check---------------------------#
        $count = DB::table('tbl_vote_schedule')->where('election_id',$election)->count();
        if($count > 0){
        Session::put('failed','Sorry ! Voting Schedule Already Exits');
        return Redirect::to('addVotingDateAndTime');
        exit();
        }
       #----------------------- end duplicate check-----------------------#
        if($startDate > $endDate){
        Session::put('failed','Sorry ! End Date Is Small Than Start Date');
        return Redirect::to('addVotingDateAndTime');
        exit(); 
        }
        // incative all schedule
        $sch_count = DB::table('tbl_vote_schedule')->count();
        if($sch_count > 0){
            // update query
            $data_update              = array();
            $data_update['status']    = 1;
            DB::table('tbl_vote_schedule')->update($data_update);
        }
        // insert data
        $data = array();
        $data['election_id']    = $election ;
        $data['start_date']     = $startDate ;
        $data['start_time']     = $startTime ;
        $data['end_date']       = $endDate ;
        $data['end_time']       = $endTime ;
        $data['remarks']        = $remarks ;
        $data['created_at']     = $this->rcdate ;
        DB::table('tbl_vote_schedule')->insert($data);
        Session::put('succes','Election Schedule Added Sucessfully');
        return Redirect::to('addVotingDateAndTime');
    }
    // manage voting schedule
    public function manageVotingDateAndTime()
    {
        $result = DB::table('tbl_vote_schedule')->orderBy('id','desc')->get();
        return view('vote.manageVotingDateAndTime')->with('result',$result);
    }
    // voter login page
    public function index()
    {
        return view('voter.index');
    }
    // voter login
    public function voter_login(Request $request)
    {
        $this->validate($request, [
        'mobile'    => 'required',
        'password'  => 'required',
        ]);
        $mobile     = trim($request->mobile);
        $pwd        = trim($request->password);
        $salt       = 'a123A321';
        $password   = sha1($pwd.$salt);
        #------------------- Check Valid Information ---------------#
        $check_count = DB::table('tbl_voter')->where('status',1)->where('mobile',$mobile)->where('password',$password)->count();
        if ($check_count > 0) {
            $voter_login = DB::table('tbl_voter')
            ->where('mobile', $mobile)
            ->where('password', $password)
            ->where('status',1)
            ->first();
            Session::put('voter_name',$voter_login->name);
            Session::put('voter_id',$voter_login->id);
            Session::put('photo',$voter_login->image);
            DB::table('tbl_temp_vote')->where('voter_id',$voter_login->id)->delete();
            return Redirect::to('/voterDashboard');
        }else{
            Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
            return Redirect::to('/');
        }
    }
    // voter dashboard
    public function voterDashboard()
    {
        return view('voter.voterDashboard');
    }

    // given vote
    public function givenVote()
    {
        // get active vote list
        $value              = DB::table('tbl_vote_schedule')->where('status',0)->first();
        $voter_status_count =   DB::table('tbl_election_active_voter')->where('election_id',$value->election_id)->where('voter_id',$this->voter_id)->count();
        return view('vote.givenVote')->with('value',$value)->with('voter_status_count',$voter_status_count);
    }
    // verify pin to vote
    public function VerifyPinToVote($election_id)
    {
         DB::table('tbl_temp_vote')->where('voter_id',$this->voter_id)->delete();
         // alrady given vote
         $given_vote_count = DB::table('tbl_final_vote')->where('election_id',$election_id)->where('voter_id',$this->voter_id)->count();
         if($given_vote_count > '0'){
        Session::put('failed','Sorry ! Your Vote Already Casted');
        return Redirect::to('givenVote');
        exit();
         }

        // get voter info
        $voter_info  = DB::table('tbl_voter')->where('id',$this->voter_id)->first();
        $name        = $voter_info->name ;
        $email       = $voter_info->email ;
        $pin_is      = substr(md5(time()), 0, 6) ;

        $count = DB::table('tbl_parcitipate_election')->where('election_id',$election_id)->where('voter_id',$this->voter_id)->count();
        if($count == '0'){
         // insert  data
        $data_insert = array();
        $data_insert['election_id'] = $election_id ;
        $data_insert['voter_id']    = $this->voter_id ;
        $data_insert['pin_no']      = $pin_is ;
        $data_insert['creatd_time'] = $this->current_time ;
        $data_insert['created_at']  = $this->rcdate ;
        DB::table('tbl_parcitipate_election')->insert($data_insert);
    }else{
        $data_update = array();
        $data_update['pin_no'] = $pin_is ;
        $data_update['modified_time'] = $this->current_time ;
        $data_update['modified_at'] = $this->rcdate ;
        DB::table('tbl_parcitipate_election')->where('election_id',$election_id)->where('voter_id',$this->voter_id)->update($data_update);

    }
        $data1 = array();
        $data1['election_id'] = $election_id ;
        $data1['voter_id']    = $this->voter_id ;
        $data1['used_pin']     = $pin_is ;
        $data1['creatd_time'] = $this->current_time ;
        $data1['created_at']  = $this->rcdate ;
        DB::table('tbl_pin_history')->insert($data1);
        // send pin to voter email
       //  $data['subject']         = "Welcome to E-Voting";
       //  $data['contact_email']   = "support@adslaravel.com";
       //  $data['name']            =  "Hellow Mr , ".$name;
       //  $data['contact_message'] = " Your E-Voting PIN is ".$pin_is;
       //  $data['to_email']        =  $email;

       //  Mail::send( ['html' => 'emails.sendPinToEmail'], $data, function($message) use ($data){
       //      $message->to($data['to_email']);
       //      $message->subject($data['subject']);
       //      $message->replyTo($data['contact_email']);

       // });
    Session::put('succes','Your Email Address '.$email.' Send 6 Digit Pin Which Will Use To Give Vote');
    return Redirect::to('inputPinToVerify/'.$election_id);
    }
    // input pin to verify
    public function inputPinToVerify($election_id)
    {
        return view('vote.inputPinToVerify')->with('election_id',$election_id);
    }
    // check pin numbert
    public function checkPinNumber(Request $request)
    {
    $this->validate($request, [
    'pin'                    => 'required',
    'election_id'            => 'required',
    ]);

     $pin              = trim($request->pin);
     $election_id      = trim($request->election_id);
     // check this pin for table
     $count = DB::table('tbl_parcitipate_election')->where('election_id',$election_id)->where('pin_no',$pin)->where('voter_id',$this->voter_id)->count();
     if($count == '0'){
        Session::put('failed','Sorry ! PIN Number Not Match');
        return Redirect::to('inputPinToVerify/'.$election_id);
        exit();
     }
     return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);

    }
    // chose candidate type
    public function choseCandidateType($election_id , $pin)
    {
    $count = DB::table('tbl_parcitipate_election')->where('election_id',$election_id)->where('pin_no',$pin)->where('voter_id',$this->voter_id)->count();
     if($count == '0'){
        Session::put('failed','Sorry ! PIN Number Not Match');
        return Redirect::to('inputPinToVerify/'.$election_id);
        exit();
     }
     // election info by 
     $election_info = DB::table('tbl_election')->where('id',$election_id)->first();
     // get candidate post
     $post = DB::table('tbl_election_candidate_post')
     ->join('tbl_post','tbl_election_candidate_post.post_id','=','tbl_post.id')
    ->select('tbl_election_candidate_post.*','tbl_post.post_rank')
    ->where('tbl_election_candidate_post.election_id',$election_id)->groupBy('tbl_election_candidate_post.post_id')->orderBy('tbl_post.post_rank','asc')->get();

     return view('vote.choseCandidateType')->with('post',$post)->with('election_id',$election_id)->with('pin',$pin)->with('election_info',$election_info);
    }
    // view candidate by post
    public function choiceElectionCandidatePostToVote($election_id , $post_id , $pin)
    {
    $result = DB::table('tbl_election_candidate_post')
    ->join('tbl_election', 'tbl_election_candidate_post.election_id', '=', 'tbl_election.id')
    ->join('tbl_post', 'tbl_election_candidate_post.post_id', '=', 'tbl_post.id')
    ->join('tbl_candidate', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
    ->select('tbl_election_candidate_post.*','tbl_election.election_name','tbl_post.post_name','tbl_candidate.name','tbl_candidate.image as candidate_image','tbl_candidate.father_name','tbl_candidate.mobile')
    ->where('tbl_election_candidate_post.election_id',$election_id)
    ->where('tbl_election_candidate_post.post_id',$post_id)
    ->orderBy('tbl_candidate.name','asc')
    ->get();
    $election_info = DB::table('tbl_election')->where('id',$election_id)->first();
    $post_info     = DB::table('tbl_post')->where('id',$post_id)->first();
    return view('vote.viewBallotPaper')->with('result',$result)->with('election_id',$election_id)->with('post_id',$post_id)->with('pin',$pin)->with('election_info',$election_info)->with('post_info',$post_info);
    }
    // final given vote
    public function finalGivenVote(Request $request)
    {
    $this->validate($request, [
    'pin'                    => 'required',
    'election_id'            => 'required',
    'post_id'                => 'required',
    'vote'                   => 'required'
    ]);
    $session_id = session()->getId();

     $pin              = trim($request->pin);
     $election_id      = trim($request->election_id);
     $post_id          = trim($request->post_id);
     $vote             = trim($request->vote);
     $count = DB::table('tbl_parcitipate_election')->where('election_id',$election_id)->where('pin_no',$pin)->where('voter_id',$this->voter_id)->count();
     if($count == '0'){
        Session::put('failed','Sorry ! PIN Number Not Match');
        return Redirect::to('givenVote');
        exit();
     }
     // alerady check duplicate vote
     $dup_count = DB::table('tbl_final_vote')->where('election_id',$election_id)->where('post_id',$post_id)->where('voter_id',$this->voter_id)->count();
     if($dup_count > '0'){
        Session::put('failed','Sorry ! Vote Already Cast Of This Post');
        return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
        exit();
     }
     // global ballot paper
     $ballot_paper_count = DB::table('tbl_final_vote')->orderBy('ballot_no','desc')->count();
     if($ballot_paper_count == '0'){
        $ballot_paper_no_is = 1 ;
     }else{
    $ballot_paper_query = DB::table('tbl_final_vote')->orderBy('ballot_no','desc')->take(1)->first();
    $ballot_paper_no_is =  $ballot_paper_query->ballot_no + 1 ;
     }
     // post wise ballot paper
     $post_ballot_paper_count = DB::table('tbl_final_vote')->where('election_id',$election_id)->where('post_id',$post_id)->orderBy('post_wise_ballot_paper','desc')->count();
     if($post_ballot_paper_count == '0'){
        $post_ballot_paper_no_is = 1 ;
     }else{
    $post_ballot_paper_query = DB::table('tbl_final_vote')->where('election_id',$election_id)->where('post_id',$post_id)->orderBy('post_wise_ballot_paper','desc')->take(1)->first();
    $post_ballot_paper_no_is =  $post_ballot_paper_query->post_wise_ballot_paper + 1 ;
     }
     // take vote
     $data_insert = array();
     $data_insert['ballot_no']        = $ballot_paper_no_is  ;
     $data_insert['election_id']       = $election_id  ;
     $data_insert['post_id']           = $post_id  ;
     $data_insert['post_wise_ballot_paper']  = $post_ballot_paper_no_is  ;
     $data_insert['candidate_id']      =  $vote ;
     $data_insert['voter_id']          = $this->voter_id ;
     $data_insert['pin_no']            = $pin ;
     $data_insert['session_id']        = $session_id ;
     $data_insert['created_time']      = $this->current_time;
     $data_insert['created_at']        = $this->rcdate ;
     DB::table('tbl_final_vote')->insert($data_insert);
    Session::put('succes','Thanks , Your Vote Casting Sucessfully');
    return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
    }
   
    // final vote
    public function finalVote(Request $request)
    {
    $session_id = session()->getId();
    $election_id = trim($request->election_id);
    $pin = trim($request->pin);
    $random_number =  substr(md5(time()), 0, 30);
   $post_count = DB::table('tbl_election_candidate_post')->where('election_id',$election_id)->distinct('post_id')->count('post_id');

   $post_vote_count = count($request->ans);

     if($post_count != $post_vote_count){
        Session::put('failed','Sorry !Total Election Post '.$post_count.' But You Can Not Vote All Post. Please Try Again');
        return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
        exit();
     }
     $post_vote = $request->ans ;
     // check duplicate entry
     $duplicate_count = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$this->voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->count();
     if($duplicate_count > 0){
        Session::put('failed','Sorry ! You Are Alrady Given Vote');
        return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
        exit(); 
     }
     foreach ($post_vote as $key => $value) {
     $data_insert = array();
     $data_insert['election_id']       = $election_id  ;
     $data_insert['post_id']           = $key  ;
     $data_insert['candidate_id']      = $value ;
     $data_insert['voter_id']          = $this->voter_id ;
     $data_insert['pin_no']            = $pin ;
     $data_insert['session_id']        = $session_id ;
     $data_insert['random_number']     = $random_number ;
     $data_insert['created_time']      = $this->current_time;
     $data_insert['created_at']        = $this->rcdate ;
     DB::table('tbl_temp_vote')->insert($data_insert);
     }
     return Redirect::to('afterVoteSummary/'.$election_id.'/'.$pin.'/'.$session_id.'/'.$random_number);
    }
    // after vote summary
    public function afterVoteSummary($election_id , $pin , $session_id,$random_number)
    {
      $result = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$this->voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->get();
     return view('vote.afterVoteSummary')->with('result',$result)->with('election_id',$election_id)->with('pin',$pin)->with('session_id',$session_id)->with('random_number',$random_number);
    }
    // vote desicion aftet vote
    public function voteDesicionAftetVote(Request $request)
    {
    $this->validate($request, [
    'election_id'    => 'required',
    'pin'            => 'required',
    'session_id'     => 'required',
    'random_number'  => 'required',
    ]);
    $session_id       = trim($request->session_id); ;
    $pin              = trim($request->pin);
    $election_id      = trim($request->election_id);
    $random_number    = trim($request->random_number);
    $confirm_button = trim($request->confirm_button);
    if($confirm_button == 'not_ok')
    {
     // remove the field
     DB::table('tbl_temp_vote')->where('voter_id',$this->voter_id)->delete();
    Session::put('succes','Thanks , Your Vote Cancel. Again Given Vote');
    return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
    exit();
    }
    if($confirm_button == 'ok')
       {
         $vote_date_time_confim              = DB::table('tbl_vote_schedule')->where('election_id',$election_id)->where('status',0)->first();
        // voting time ended
        date_default_timezone_set('Asia/Dhaka');
        $current_date       = date('Y-m-d');
        $current_time       = date('H:i:s');
        $e_start_date = $vote_date_time_confim->start_date ;
        $e_start_time = $vote_date_time_confim->start_time ;
        $e_end_date   = $vote_date_time_confim->end_date ;
        $e_end_time   = $vote_date_time_confim->end_time ;

        if($current_date == $e_start_date AND $current_time > $e_start_time){
          $date_time_status = '1' ;
        }
        elseif($current_date > $e_start_date AND $current_date < $e_end_date){
             $date_time_status = '1' ;
        }elseif($current_date == $e_end_date AND $current_time < $e_end_time){
         $date_time_status = '1' ;   
        }else{
          $date_time_status = '2' ;  
        }
        if($date_time_status == '2'){
        Session::put('failed','Sorry ! Voting Time Is Expired');
        return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
        exit();   
        }

        // count already vote cast
        $count = DB::table('tbl_final_vote')->where('election_id',$election_id)->where('voter_id',$this->voter_id)->count();
        if($count > 0){
        Session::put('failed','Sorry ! Sorry You Are Already Given Vote');
        return Redirect::to('choseCandidateType/'.$election_id.'/'.$pin);
        exit(); 
        }
        // insert data into final vote
          $result = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$this->voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->get();
          foreach ($result as $value) {
     $data_insert     = array();
     $data_insert['election_id']       = $election_id  ;
     $data_insert['post_id']           = $value->post_id  ;
     $data_insert['candidate_id']      = $value->candidate_id ;
     $data_insert['voter_id']          = $this->voter_id ;
     $data_insert['pin_no']            = $value->pin_no ;
     $data_insert['session_id']        = $value->session_id ;
     $data_insert['created_time']      = $this->current_time;
     $data_insert['created_at']        = $this->rcdate ;
     DB::table('tbl_final_vote')->insert($data_insert);
        }
    DB::table('tbl_temp_vote')->where('voter_id',$this->voter_id)->delete();
    Session::put('succes','Thanks , Finaly Your Vote Count Sucessfully');
    return Redirect::to('/voterDashboard');
    }
   }
    // change vote
    public function changeMyVote($election_id,$pin,$session_id,$random_number,$id)
    {
        $row = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$this->voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->where('id',$id)->first();
        $election_info = DB::table('tbl_election')->where('id',$election_id)->first();
        return view('vote.changeMyVote')->with('row',$row)->with('election_id',$election_id)->with('pin',$pin)->with('session_id',$session_id)->with('random_number',$random_number)->with('id',$id)->with('election_info',$election_info)->with('voter_id',$this->voter_id); 
    }
    // change vote
    public function changeVote(Request $request)
    {
    $this->validate($request, [
    'election_id'    => 'required',
    'pin'            => 'required',
    'session_id'     => 'required',
    'voter_id'       => 'required',
    'random_number'  => 'required',
    'id'             => 'required',
    ]);
    $voter_id          = trim($request->voter_id);
    $random_number     = trim($request->random_number);
    $id                = trim($request->id);
    $session_id        = trim($request->session_id); 
    $pin               = trim($request->pin);
    $election_id       = trim($request->election_id); 
    $ans               = trim($request->ans);
    // update query
    $data_update                 = array();
    $data_update['candidate_id'] = $ans ;
    DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$this->voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->where('id',$id)->update($data_update);
     Session::put('succes','Thanks , Your Vote Change Sucessfully');
     return Redirect::to('afterVoteSummary/'.$election_id.'/'.$pin.'/'.$session_id.'/'.$random_number);
    }

    // voter logout
    public function voterLogout()
    {
       DB::table('tbl_temp_vote')->where('voter_id',$this->voter_id)->delete();
       Session::put('voter_id',null);
       return Redirect::to('/');
    }

    #------------------------------VOTER CHANGE PASSWORD----------------------------#


    // function for voter change password
    public function voterChangePassword()
    {
        return view('voter.voterChangePassword');
    }

    // admin password change 
    public function voterChangePasswordInfo(Request $request)
    {
     $this->validate($request, [
    'old_password'              => 'required',
    'new_password'              => 'required',
    'confirm_new_password'      => 'required'
    ]);
     $salt                 = 'a123A321';
     $old_password         = trim($request->old_password);
     $new_password         = trim($request->new_password);
     $confirm_new_password = trim($request->confirm_new_password);
     $id                   = trim($request->id);
     $salt_old_password    = sha1($old_password.$salt);
     $change_password      = sha1($new_password.$salt);
     // check old password
     $check_old_password_query = DB::table('tbl_voter')->where('id',$id)->where('password',$salt_old_password)->count();
     if($check_old_password_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your old Password Did Not Match. Try Again');
        return Redirect::to('voterChangePassword');  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry !New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('voterChangePassword');  
        exit();
     }
     // insert password change history
    $type = Session::get('type');
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['reconver_code']  = '' ;
    $data['type']           = '' ;
    $data['status']         = 1 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('voter_password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password'] = $change_password ;
    $query = DB::table('tbl_voter')->where('id',$id)->update($data1);
    if($query){
    Session::put('voter_id',null);
    Session::put('password_change','Password Change Sucessfully'); 
    return Redirect::to('/');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('voterChangePassword');
    }
    }
    #------------------------------VOTER CHANGE PASSWORD----------------------------#

    #--------------------------VOTER FORGOTTEN PASSWORD------------------------------#

    // mobile number verify
    public function voterMobileNumberVerify()
    {
        return view('voter.voterMobileNumberVerify');
    }
    // send verification code in mobile
    public function voterSendMobileVerificationCode(Request $request)
    {
    $this->validate($request, [
    'email'              => 'required'
    ]);
     $email         = trim($request->email);
     // verification the mobile number
     $count = DB::table('tbl_voter')->where('email',$email)->count();
     if($count == '0'){
        // mobile number not match
        Session::put('failed','Sorry ! Your Email Not Match. Try Again');
        return Redirect::to('voterMobileNumberVerify');
        exit();
     }else{
        // get this id
        $query = DB::table('tbl_voter')->where('email',$email)->first();
        $id     = $query->id ;
        $log_email = $query->email ;
        // verification code sent on mobile
        // update recovery code
        $code = rand(999999,10000);
         $data                 = array();
         $data['recover_code'] = $code ;
         $update = DB::table('tbl_voter')->where('id',$id)->update($data);
         if($update){

      // send pin to voter email
        $data['subject']         = "Welcome to E-Voting";
        $data['contact_email']   = "support@adslaravel.com";
        //$data['name']            =  "Hellow Mr , ".$name;
        $data['contact_message'] = " Your Forgot Recover  PIN is ".$code;
        $data['to_email']        =  $log_email;

        Mail::send( ['html' => 'emails.VoterForgotPasswordMail'], $data, function($message) use ($data){
            $message->to($data['to_email']);
            $message->subject($data['subject']);
            $message->replyTo($data['contact_email']);

    });
            Session::put('succes','Thanks , Recovery Code Sent To Your Email Address Which '.$log_email.' Verify Code Enter Into Below Input Box');
           return Redirect::to('voterRecoverPassword/'.$id);

         }else{
        Session::put('failed','Sorry ! Error Occured. Try Again');
        return Redirect::to('voterMobileNumberVerify');
         }
     } 
    }
    // verify recover code
    public function voterRecoverPassword($id)
    {
     return view('voter.voterRecoverPassword')->with('id',$id);
    }
    // recover account
    public function voterRecoverAccount(Request $request)
    {
    $this->validate($request, [
    'code'                      => 'required',
    'password'              => 'required',
    'confirm_password'      => 'required'
    ]);
     $salt                 = 'a123A321';
     $code                 = trim($request->code);
     $new_password         = trim($request->password);
     $confirm_new_password = trim($request->confirm_password);
     $id                   = trim($request->id);
     $change_password      = sha1($new_password.$salt);
     // check old password
     $check_code_query = DB::table('tbl_voter')->where('id',$id)->where('recover_code',$code)->count();

     if($check_code_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your Recovery Code Did Not Match. Try Again');
        return Redirect::to('voterRecoverPassword/'.$id);  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry !New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('voterRecoverPassword/'.$id);  
        exit();
     }
     // insert password change history
     // $type_query = DB::table('admin')->where('id',$id)->first();
     // $type = $type_query->type;
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['reconver_code']  = '' ;
    $data['type']           = '' ;
    $data['status']         = 2 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('voter_password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password']     = $change_password ;
    $data1['recover_code'] = '' ;
    $query = DB::table('tbl_voter')->where('id',$id)->update($data1);
    if($query){
    Session::put('password_change','Your Account Recovery Sucessfully'); 
    return Redirect::to('/');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('/');
    }
    }


    #--------------------------VOTER FORGOTTEN PASSWORD------------------------------#


}
