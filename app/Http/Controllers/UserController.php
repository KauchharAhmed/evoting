<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
use Mail;

class UserController extends Controller
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
   // add candidate form
   public function addVoter()
   {
      return view('users.addVoter');
   }
   // add candidate info
   public function addVoterInfo(Request $request)
   {
   	$this->validate($request, [
    'name'              => 'required',
    'member_no'         => 'required',
    'voter_no'          => 'required',
    'mobile'            => 'required',
    'confirm_mobile'    => 'required',
    'email'             => 'required',
    'confirm_email'     => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:300'
    ]);
     $name                  = trim($request->name);
     $member_no             = trim($request->member_no);
     $voter_no             = trim($request->voter_no);
     $father_name           = trim($request->father_name);
     $mother_name           = trim($request->mother_name);
     $mobile                = trim($request->mobile);
     $confirm_mobile        = trim($request->confirm_mobile);
     $email                 = trim($request->email);
     $confirm_email         = trim($request->confirm_email);
     $nid                   = trim($request->nid);
     $address               = trim($request->address);

     $added_random_number = substr(md5(time()), 0, 30) ;

    // check duplicate mobile number
     if($mobile != $confirm_mobile){
        Session::put('failed','Sorry ! Mobile Number And Confirm Mobile Number Did Not Match');
        return Redirect::to('addVoter');
        exit();
     }
    if($email != $confirm_email){
        Session::put('failed','Sorry ! Email And Confirm Email Did Not Match');
        return Redirect::to('addVoter');
        exit();
     }
     //chk duplicate supplier name
     $count = DB::table('tbl_voter')
     ->where('mobile',$mobile)
     ->count();
     if($count > 0){
        Session::put('failed','Sorry ! Voter Mobile Number Already Exits');
        return Redirect::to('addVoter');
        exit();
     }

     $count1 = DB::table('tbl_voter')
     ->where('email', $email)
     ->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! Voter Email Number Already Exits');
        return Redirect::to('addVoter');
        exit();
     }
   

     $member_no_count =  DB::table('tbl_voter')
     ->where('manual_membership_number',$member_no)
     ->count();
     if($member_no_count > 0){
        Session::put('failed','Sorry ! Membership Number Already Exits');
        return Redirect::to('addVoter');
        exit();
     }
     $voter_no_count =  DB::table('tbl_voter')
     ->where('manual_voter_number',$voter_no)
     ->count();
     if($voter_no_count > 0){
        Session::put('failed','Sorry ! Voter Number Already Exits');
        return Redirect::to('addVoter');
        exit();
     }
     $data=array();
     $data['name']                      = $name ;
     $data['manual_membership_number']  = $member_no ;
     $data['manual_voter_number']       = $voter_no ;
     $data['nid']             = $nid ;
     $data['father_name']     = $father_name ;
     $data['mother_name']     = $mother_name ;
     $data['email']           = $email ;
     $data['mobile']          = $mobile ;
     $data['type']            = 0 ;
     $data['added_random_number'] = $added_random_number ;
     $data['address']         = $address;
     $data['status']          = 0;
     $data['creatd_at']      = $this->rcdate ;
     $image                   = $request->file('image');
         if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='voter-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('tbl_voter')->insert($data);
        }
     }else{
             // without image
             DB::table('tbl_voter')->insert($data);     
    }
    //get last id of voter
    $last_id_query = DB::table('tbl_voter')->orderBy('id','desc')->take(1)->first();
    $last_id       = $last_id_query->id ;  
    $root_url = $request->root();

        $data['subject']         = "Welcome to E-Voting";
        $data['contact_email']   = "support@adslaravel.com";
        $data['name']            =  "Hellow Mr , ".$name;
        $data['contact_message'] = " Invitation To You To Be Voter. Please Click The Below Link To Active Your Voter Profile. After Click Link You Will Get Your User Id And Password.";
        $data['link'] =  $root_url.'/regVoterVerify/'.$last_id.'/'.$added_random_number ;
        $data['to_email']        = $email;

        Mail::send( ['html' => 'emails.registrationmail'], $data, function($message) use ($data){
            $message->to($data['to_email']);
            $message->subject($data['subject']);
            $message->replyTo($data['contact_email']);
        });

           Session::put('succes','New Voeter Added Sucessfully');
           return Redirect::to('addVoter');
   }
   // voter verify
   public function regVoterVerify($id , $random_number)
   {
    $check_count = DB::table('tbl_voter')->where('id',$id)->where('added_random_number',$random_number)->count();
     if($check_count == '0'){
        Session::put('login_faild','Sorry!! URL Invalid');
        return Redirect::to('/');
     	exit();
     }
   $check_status = DB::table('tbl_voter')->where('id',$id)->where('added_random_number',$random_number)->where('status',0)->count();
     if($check_status == '0'){
        Session::put('login_faild','Sorry!! Already Your Registration Completed');
        return Redirect::to('/');
        exit();
     }
     $random_password =  substr(md5(time()), 0, 10);
     $salt      = 'a123A321';
     $password  = trim(sha1($random_password.$salt));
     
     #----------------------- get voter id----------------------#
     $voter_count = DB::table('tbl_voter')->orderBy('voter_id','desc')->limit(1)->count();
     if($voter_count == '0'){
     	$voter_number = 1 ;
     }else{
     	$voter_query  = DB::table('tbl_voter')->orderBy('voter_id','desc')->limit(1)->first();
     	$voter_number = $voter_query->voter_id + 1 ;
     }
     #----------------------- end voter id ---------------------#
     // get voter email
     $email_query = DB::table('tbl_voter')->where('id',$id)->first();
     $email       = $email_query->email ; 
     $mobile      = $email_query->mobile ;
     #----------------------- update query----------------------#
     $data     = array();
     $data['voter_id'] 		= $voter_number;
     $data['password'] 		= $password;
     $data['status'] 		= 1 ;
     $data['verified_date'] = $this->rcdate ;
     DB::table('tbl_voter')->where('id',$id)->update($data);

        $data['subject']         = "Welcome to E-Voting";
        $data['contact_email']   = "support@adslaravel.com";
       // $data['name']            =  "Hellow Mr , ".$name;
        $data['contact_message'] = "Your E-Voting Voter Number Is ".$voter_number." Login ID : ".$mobile." And Password : ".$random_password;
        $data['to_email']        = $email;

        Mail::send( ['html' => 'emails.sendVoterActivition'], $data, function($message) use ($data){
            $message->to($data['to_email']);
            $message->subject($data['subject']);
            $message->replyTo($data['contact_email']);
        });

    Session::put('succes','Your Registration Completed Sucessfully. You Will Get Your User ID And Password To Log In By Your Email');
    return Redirect::to('/');

     #---------------------- end update query-------------------#
   }
   // pending voter list
   public function pendingVoterList()
   {
   	$result = DB::table('tbl_voter')->where('status',0)->get();
   	return view('users.pendingVoterList')->with('result',$result);
   }
   // active voter list
   public function activeVoterList()
   {
   	$result = DB::table('tbl_voter')->where('status','>',0)->orderBy('voter_id','asc')->get();
   	return view('users.activeVoterList')->with('result',$result);
   }
   // add candidate 
   public function addCandidate()
   {
   	  return view('users.addCandidate');
   }
   // add candidate info
   public function addCandidateInfo(Request $request)
   {
    $this->validate($request, [
    'member_no'              => 'required',
    'voter_no'              => 'required',
    'name'              => 'required',
    'mobile'            => 'required',
    'confirm_mobile'    => 'required',
    'email'             => 'required',
    'address'           => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:300'
    ]);
     $member_no             = trim($request->member_no);
     $voter_no              = trim($request->voter_no);
     $name                  = trim($request->name);
     $father_name           = trim($request->father_name);
     $mother_name           = trim($request->mother_name);
     $mobile                = trim($request->mobile);
     $salt      			= 'a123A321';
     $password  			= trim(sha1($mobile.$salt));
     $email                 = trim($request->email);
     $nid                   = trim($request->nid);
     $address               = trim($request->address);

     //check duplicate supplier name
     $count = DB::table('tbl_candidate')
     ->where('mobile',$mobile)
     ->count();
     if($count > 0){
        Session::put('failed','Sorry ! Candidate Mobile Number Already Exits');
        return Redirect::to('addCandidate');
        exit();
     }

     $count1 = DB::table('tbl_candidate')
     ->where('email', $email)
     ->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! Candidate Email Number Already Exits');
        return Redirect::to('addCandidate');
        exit();
     }
      $count2 = DB::table('tbl_candidate')
     ->where('member_no', $member_no)
     ->count();
     if($count2 > 0){
        Session::put('failed','Sorry ! Candidate Member Number Already Exits');
        return Redirect::to('addCandidate');
        exit();
     }
          $count3 = DB::table('tbl_candidate')
     ->where('voter_no', $voter_no)
     ->count();
     if($count3 > 0){
        Session::put('failed','Sorry ! Candidate  Voter Number Already Exits');
        return Redirect::to('addCandidate');
        exit();
     }


     $data=array();
     $data['name']            = $name ;
     $data['member_no']       = $member_no ;
     $data['voter_no']        = $voter_no ;
     $data['nid']             = $nid ;
     $data['father_name']     = $father_name ;
     $data['mother_name']     = $mother_name ;
     $data['email']           = $email ;
     $data['mobile']          = $mobile ;
     $data['password']        = $password ;
     $data['type']            = 0 ;
     $data['address']         = $address;
     $data['status']          = 0;
     $data['added_id']        = $this->loged_id;
     $data['creatd_at']       = $this->rcdate ;

     $image                 = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='candidate-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('tbl_candidate')->insert($data);
        }
     }else{
             // without image
             DB::table('tbl_candidate')->insert($data);
          
    }
    Session::put('succes','New Candidate Added Sucessfully');
    return Redirect::to('addCandidate');
   }
   // manage candidate info
   public function manageCandidate()
   {
   	  $result = DB::table('tbl_candidate')->get();
   	  return view('users.manageCandidate')->with('result',$result);
   }
   // update voter list
   public function updateVoterList()
   {
    // get election
    $election = DB::table('tbl_election')->orderBy('id','desc')->get();
    $result   = DB::table('tbl_voter')->where('status','>',0)->orderBy('voter_id','asc')->get();
    return view('users.updateVoterList')->with('result',$result)->with('election',$election);           
   }
   // update voter list info
   public function updateVoterListInfo(Request $request)
   {
    $this->validate($request, [
    'election'            => 'required'
    ]);
    $election             = trim($request->election) ;
    $status               = $request->status ;
    // count duplicate check
    $count = DB::table('tbl_election_active_voter')->where('election_id',$election)->count();
    if($count > 0){
    Session::put('failed','Sorry ! Voter List Already Assign');
    return Redirect::to('updateVoterList');
    exit();
    }
    // insert data info table
    foreach ($status as $voter_id) {
    $data                   = array();
    $data['election_id']    = $election ;
    $data['voter_id']       = $voter_id ;
    $data['created_at']     = $this->rcdate ;
    DB::table('tbl_election_active_voter')->insert($data);
    }
    Session::put('succes','Voter List Assign Sucessfully');
    return Redirect::to('updateVoterList');
   }

   // edit voter
   public function editVoter($id)
   {
       $row = DB::table('tbl_voter')->where('id',$id)->first();
       return view('users.editVoter')->with('row',$row);
   }

   // update voter info
   public function updateVoterInfo(Request $request)
   {
       $this->validate($request, [
    'name'              => 'required',
    'member_no'         => 'required',
    'voter_no'          => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:300'
    ]);
     $name                  = trim($request->name);
     $member_no             = trim($request->member_no);
     $voter_no              = trim($request->voter_no);
     $father_name           = trim($request->father_name);
     $mother_name           = trim($request->mother_name);
     $id                    = trim($request->id);

     $added_random_number = substr(md5(time()), 0, 30) ;

     $member_no_count =  DB::table('tbl_voter')
     ->where('manual_membership_number',$member_no)
     ->whereNotIn('id',[$id])
     ->count();
     if($member_no_count > 0){
        Session::put('failed','Sorry ! Membership Number Already Exits');
        return Redirect::to('editVoter/'.$id);
        exit();
     }
     $voter_no_count =  DB::table('tbl_voter')
     ->where('manual_voter_number',$voter_no)
     ->whereNotIn('id',[$id])
     ->count();
     if($voter_no_count > 0){
        Session::put('failed','Sorry ! Voter Number Already Exits');
        return Redirect::to('editVoter/'.$id);
        exit();
     }
     $data = array();
     $data['name']                      = $name ;
     $data['manual_membership_number']  = $member_no ;
     $data['manual_voter_number']       = $voter_no ;
     $data['father_name']     = $father_name ;
     $data['mother_name']     = $mother_name ;
     $data['modified_at']     = $this->rcdate ;
     $image                   = $request->file('image');
         if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='voter-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('tbl_voter')->where('id',$id)->update($data);
        }
     }else{
             // without image
             DB::table('tbl_voter')->where('id',$id)->update($data);     
    }

           Session::put('succes','Voeter Info Update Sucessfully');
           return Redirect::to('activeVoterList');
   }

   // edit candidate
   public function editCandidate($id)
   {
       $row = DB::table('tbl_candidate')->where('id',$id)->first();
       return view('users.editCandidate')->with('row',$row);
   }

   // update candidate info
   public function updateCandidateInfo(Request $request)
   {
    $this->validate($request, [
    'member_no'         => 'required',
    'voter_no'          => 'required',
    'name'              => 'required',
    'email'             => 'required',
    'address'           => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:300'
    ]);
     $member_no             = trim($request->member_no);
     $voter_no              = trim($request->voter_no);
     $name                  = trim($request->name);
     $email                 = trim($request->email);
     $address               = trim($request->address);
     $id                    = trim($request->id);

     $count1 = DB::table('tbl_candidate')
     ->where('email', $email)
     ->whereNotIn('id',[$id])
     ->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! Candidate Email Number Already Exits');
        return Redirect::to('editCandidate/'.$id);
        exit();
     }
      $count2 = DB::table('tbl_candidate')
     ->where('member_no', $member_no)
     ->whereNotIn('id',[$id])
     ->count();
     if($count2 > 0){
        Session::put('failed','Sorry ! Candidate Member Number Already Exits');
        return Redirect::to('editCandidate/'.$id);
        exit();
     }
          $count3 = DB::table('tbl_candidate')
     ->where('voter_no', $voter_no)
     ->whereNotIn('id',[$id])
     ->count();
     if($count3 > 0){
        Session::put('failed','Sorry ! Candidate  Voter Number Already Exits');
        return Redirect::to('editCandidate/'.$id);
        exit();
     }


     $data=array();
     $data['name']            = $name ;
     $data['member_no']       = $member_no ;
     $data['voter_no']        = $voter_no ;
     $data['email']           = $email ;
     $data['address']         = $address;
     $data['added_id']        = $this->loged_id;
     $data['modified_at']     = $this->rcdate ;

     $image                 = $request->file('image');
     if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='candidate-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('tbl_candidate')->where('id',$id)->update($data);
        }
     }else{
             // without image
             DB::table('tbl_candidate')->where('id',$id)->update($data);
          
    }
    Session::put('succes','Candidate Updated Sucessfully');
    return Redirect::to('manageCandidate');
   }


}
