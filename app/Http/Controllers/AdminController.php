<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use DB;
use Session;
use Mail;

class AdminController extends Controller {
     private $rcdate ;
     private $loged_id ;
     private $current_time ;
	public function __construct() {
		date_default_timezone_set('Asia/Dhaka');
		$this->rcdate = date('Y-m-d');
		$this->current_time = date('H:i:s');
        $this->loged_id     = Session::get('admin_id');
	}
	/**
	 * Display admin login page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.index');
	}

	#-------------- Login --------------------#
	public function login(Request $request) 
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
        $check_count = DB::table('admin')->where('status',1)->where('mobile',$mobile)->where('password',$password)->count();
        if ($check_count > 0) {
            $admin_login = DB::table('admin')
            ->where('mobile', $mobile)
            ->where('password', $password)
            ->where('status',1)
            ->first();
            // check user type
            $type = $admin_login->type ;
            if($type == '1'){
                // admin login
                Session::put('admin_name',$admin_login->name);
                Session::put('admin_id',$admin_login->id);
                Session::put('type',$admin_login->type);
                Session::put('photo',$admin_login->image);
                return Redirect::to('/adminDashboard');
            }
        }else{
            Session::put('login_faild','Sorry!! Your Information Did Not Match. Try Again');
            return Redirect::to('/admin');
        }
	}

    #--------------------------------- STAFF ---------------------------------#
    #--------------------------------- ADMIN ---------------------------------#
    public function addAdmin()
    {
        return view('admin.addAdmin');
    }
    // add admin info
    public function addAdminInfo(Request $request)
    {
     $this->validate($request, [
    'name'              => 'required',
    'mobile'            => 'required',
    'email'             => 'required',
    'address'           => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $name                  = trim($request->name);
     $father_name           = trim($request->father_name);
     $mobile                = trim($request->mobile);
     $email                 = trim($request->email);
     $nid                   = trim($request->nid);
     $address               = trim($request->address);
     $salt      = 'a123A321';
     $password  = trim(sha1($mobile.$salt));
     //check duplicate supplier name
     $count = DB::table('admin')
     ->where('mobile',$mobile)
     ->count();
     if($count > 0){
        Session::put('failed','Sorry ! Admin Mobile Number Already Exits. Try Again To Add New Admin');
        return Redirect::to('addAdmin');
        exit();
     }
     $count1 = DB::table('admin')
     ->where('email',$email)
     ->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! Admin Email Number Already Exits. Try Again To Add New Admin');
        return Redirect::to('addAdmin');
        exit();
     }

     $data=array();
     $data['name']            = $name ;
     $data['nid']             = $nid ;
     $data['father_name']     = $father_name ;
     $data['email']           = $email ;
     $data['mobile']          = $mobile ;
     $data['type']            = 2 ;
     $data['password']        = $password;
     $data['address']         = $address;
     $data['status']          = 1;
     $data['added_id']        = $this->loged_id;
     $data['creatd_at']      = $this->rcdate ;
     $image                   = $request->file('image');
         if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='admin-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('admin')->insert($data);
             Session::put('succes','New Admin Added Sucessfully');
            return Redirect::to('addAdmin');
        }
     }else{
             // without image
             DB::table('admin')->insert($data);
             Session::put('succes','New Admin Added Sucessfully');
            return Redirect::to('addAdmin');
    }
    }
    // manage admin
    public function manageAdmin()
    {
    $result = DB::table('admin')
    ->where('admin.type', 2)
    ->get();
    return view('admin.manageAdmin')->with('result',$result);
    }
    #--------------------------------- END ADMIN ------------------------------#
    #------------------------------- ADMIN PASSWORD CHANGE------------------------#
    // admin password change
    public function adminChangePassword()
    {
        return view('admin.adminChangePassword');
    }
    // admin password change 
    public function adminChangePasswordInfo(Request $request)
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
     $check_old_password_query = DB::table('admin')->where('id',$id)->where('password',$salt_old_password)->count();
     if($check_old_password_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your old Password Did Not Match. Try Again');
        return Redirect::to('adminChangePassword');  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry !New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('adminChangePassword');  
        exit();
     }
     // insert password change history
     $type = Session::get('type');
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['reconver_code']  = '' ;
    $data['type']           = $type ;
    $data['status']         = 1 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password'] = $change_password ;
    $query = DB::table('admin')->where('id',$id)->update($data1);
    if($query){
    Session::put('admin_id',null);
    Session::put('type',null);
    Session::put('password_change','Password Change Sucessfully'); 
    return Redirect::to('admin');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('adminChangePassword');
    }
    }
  #----------------------------- END ADMIN PASSWORD CHANGE-----------------------#
    #--------------------------- FORGOTTEN PASSWORD--------------------------------#
  // mobile number verify
    public function mobileNumberVerify()
    {
        return view('admin.mobileNumberVerify');
    }
    // send verification code in mobile
    public function sendMobileVerificationCode(Request $request)
    {
    $this->validate($request, [
    'email'              => 'required'
    ]);
     $email         = trim($request->email);
     // verification the mobile number
     $count = DB::table('admin')->where('email',$email)->count();
     if($count == '0'){
        // mobile number not match
        Session::put('failed','Sorry ! Your Email Not Match. Try Again');
        return Redirect::to('mobileNumberVerify');
        exit();
     }else{
        // get this id
        $query = DB::table('admin')->where('email',$email)->first();
        $id     = $query->id ;
        $log_email = $query->email ;
        // verification code sent on mobile
        // update recovery code
        $code = rand(999999,10000);
         $data                 = array();
         $data['recover_code'] = $code ;
         $update = DB::table('admin')->where('id',$id)->update($data);
         if($update){

      // send pin to voter email
        $data['subject']         = "Welcome to E-Voting";
        $data['contact_email']   = "support@adslaravel.com";
        //$data['name']            =  "Hellow Mr , ".$name;
        $data['contact_message'] = " Your Forgot Recover  PIN is ".$code;
        $data['to_email']        =  $log_email;

        Mail::send( ['html' => 'emails.forgotPasswordMail'], $data, function($message) use ($data){
            $message->to($data['to_email']);
            $message->subject($data['subject']);
            $message->replyTo($data['contact_email']);

    });
            Session::put('succes','Thanks , Recovery Code Sent To Your Email Address Which '.$log_email.' Verify Code Enter Into Below Input Box');
           return Redirect::to('recoverPassword/'.$id);

         }else{
        Session::put('failed','Sorry ! Error Occured. Try Again');
        return Redirect::to('mobileNumberVerify');
         }
     } 
    }
    // verify recover code
    public function recoverPassword($id)
    {
     return view('admin.recoverPassword')->with('id',$id);
    }
    // recover account
    public function recoverAccount(Request $request)
    {
    $this->validate($request, [
    'code'                      => 'required',
    'password'              => 'required',
    'confirm_password'      => 'required'
    ]);
     $salt                 = 'a123A321';
     $code         = trim($request->code);
     $new_password         = trim($request->password);
     $confirm_new_password = trim($request->confirm_password);
     $id                   = trim($request->id);
     $change_password      = sha1($new_password.$salt);
     // check old password
     $check_code_query = DB::table('admin')->where('id',$id)->where('recover_code',$code)->count();
     if($check_code_query == '0'){
        // Old password does not match
        Session::put('failed','Sorry ! Your Recovery Code Did Not Match. Try Again');
        return Redirect::to('recoverPassword/'.$id);  
        exit();
     } 
     // new password and confirm new password matcho
     if($new_password != $confirm_new_password){
        Session::put('failed','Sorry !New password And Confirm New Password Did Not Match. Try Again');
        return Redirect::to('recoverPassword/'.$id);  
        exit();
     }
     // insert password change history
     $type_query = DB::table('admin')->where('id',$id)->first();
     $type = $type_query->type;
    $data = array();
    $data['admin_id']       = $id ;
    $data['password']       = $change_password ;
    $data['reconver_code']  = '' ;
    $data['type']           = $type ;
    $data['status']         = 2 ;
    $data['created_time']   = $this->current_time ;
    $data['created_at']     = $this->rcdate ;
    DB::table('password_change_history')->insert($data);
    // change the password
    $data1 = array();
    $data1['password']     = $change_password ;
    $data1['recover_code'] = '' ;
    $query = DB::table('admin')->where('id',$id)->update($data1);
    if($query){
    Session::put('password_change','Your Account Recovery Sucessfully'); 
    return Redirect::to('admin/');
    }else{
        Session::put('failed','Sorry !Error Occured. Try Again');
        return Redirect::to('adminChangePassword');
    }
    }
    
    /**
     * super admin logout process 
     * @return \Illuminate\Http\Response
    */
    public function adminLogout()
    {
       Session::put('admin_id',null);
       Session::put('type',null);
       return Redirect::to('/admin');
    }

    // edit admin
    public function editAdmin($id)
    {
        $row = DB::table('admin')->where('id',$id)->first();
        return view('admin.editAdmin')->with('row',$row);
    }

    // update admin info
    public function updateAdminInfo(Request $request)
    {
    $this->validate($request, [
    'name'              => 'required',
    'email'             => 'required',
    'address'           => 'required',
    'image'             => 'mimes:jpeg,jpg,png|max:100'
    ]);
     $name                  = trim($request->name);
     $father_name           = trim($request->father_name);
     $email                 = trim($request->email);
     $nid                   = trim($request->nid);
     $address               = trim($request->address);
     $id                    = trim($request->id);

     $count1 = DB::table('admin')
     ->where('email',$email)
     ->whereNotIn('id',[$id])
     ->count();
     if($count1 > 0){
        Session::put('failed','Sorry ! Admin Email Number Already Exits. Try Again To Add New Admin');
        return Redirect::to('editAdmin/'.$id);
        exit();
     }

     $data=array();
     $data['name']            = $name ;
     $data['nid']             = $nid ;
     $data['father_name']     = $father_name ;
     $data['email']           = $email ;
     $data['type']            = 2 ;
     $data['address']         = $address;
     $data['status']          = 1;
     $data['added_id']        = $this->loged_id;
     $data['modified_at']     = $this->rcdate ;
     $image                   = $request->file('image');
         if($image){
         $image_name        = str_random(20);
         $ext               = strtolower($image->getClientOriginalExtension());
         $image_full_name   ='admin-'.$image_name.'.'.$ext;
         $upload_path       = "images/";
         $image_url         = $upload_path.$image_full_name;
         $success           = $image->move($upload_path,$image_full_name);
         if($success){
            // with image
             $data['image'] = $image_url;
             DB::table('admin')->where('id',$id)->update($data);
             Session::put('succes','Admin info Updated Sucessfully');
            return Redirect::to('manageAdmin');
        }
     }else{
             // without image
             DB::table('admin')->where('id',$id)->update($data);
             Session::put('succes','Admin info Updated Sucessfully');
            return Redirect::to('manageAdmin');
    }
    }
    
}
