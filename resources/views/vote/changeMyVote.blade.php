@extends('voter.masterVoter')
@section('content')
 <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Change Vote</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                        </div>
                        <?php if(Session::get('succes') != null) { ?>
   <div class="alert alert-info alert-dismissible" role="alert">
  <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
  <strong><?php echo Session::get('succes') ;  ?></strong>
  <?php Session::put('succes',null) ;  ?>
</div>
<?php } ?>
<?php
if(Session::get('failed') != null) { ?>
 <div class="alert alert-danger alert-dismissible" role="alert">
  <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
 <strong><?php echo Session::get('failed') ; ?></strong>
 <?php echo Session::put('failed',null) ; ?>
</div>
<?php } ?>

  @if (count($errors) > 0)
    @foreach ($errors->all() as $error)      
 <div class="alert alert-danger alert-dismissible" role="alert">
   <a href="#" class="fa fa-times" data-dismiss="alert" aria-label="close"></a>
  <strong>{{ $error }}</strong>
</div>
@endforeach
@endif
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                       
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                           {!! Form::open(['url' =>'changeVote','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                            <strong>ELECTION NAME : <?php echo $election_info->election_name ; ?></strong>
                            <br/>
                            
                            <br/><br/>
                            <div class="row widget-row">
                            <div class="col-md-3">
                            <input type="hidden" name="election_id" value="<?php echo $election_id ?>" required="">
                            <input type="hidden" name="voter_id" value="<?php echo $voter_id ?>" required="">
                            <input type="hidden" name="pin" value="<?php echo $pin ?>" required="">
                            <input type="hidden" name="session_id" value="<?php echo $session_id ?>" required="">
                            <input type="hidden" name="random_number" value="<?php echo $random_number ?>" required="">
                            <input type="hidden" name="id" value="<?php echo $id ?>" required="">
                          
<div class="content">
 <span style="font-weight: bold;">
 <?php 
 echo " POST :  ";

 $post_query = DB::table('tbl_post')->where('id',$row->post_id)->first();
 echo $post_query->post_name ;
 ?>
 </span>
 <br/>
  <span style="font-weight: bold;">
 <?php 
 echo " BALLOT NO :  ";
 echo $post_query->post_rank ;
 ?>
 </span>
<br/><br/>
<?php
// post candidate
$post_candidate = DB::table('tbl_election_candidate_post')->where('election_id',$election_id)->where('post_id',$row->post_id)->get();
?>
<table class="table table-bordered">
  <tr>
<td>
  <?php $find_no_vote = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->where('id',$id)->first();
   if($find_no_vote->candidate_id == '0'):?>
  <input checked="" id="ans" type="radio" name="ans" value="0">
<?php else:?>
  <input id="ans" type="radio" name="ans" value="0">
<?php endif;?>
</td> 
<td>
</td>
<td>
NO VOTE
</td>
</tr>
<?php
foreach ($post_candidate as $post_candidate_value) { ?>
<tr>
  <td>
<?php
$find_candidate = DB::table('tbl_temp_vote')->where('election_id',$election_id )->where('voter_id',$voter_id)->where('pin_no',$pin)->where('session_id',$session_id)->where('random_number',$random_number)->where('id',$id)->where('id',$id)->first();  
?>
<?php if($post_candidate_value->candidate_id == $find_candidate->candidate_id):?>

<input checked = "" type="radio" name="ans" value="<?php echo $post_candidate_value->candidate_id;?>">
<?php else:?>
  <input type="radio" name="ans" value="<?php echo $post_candidate_value->candidate_id;?>">
  <?php endif;?>
</td>
<?php
// candidate name
$candidate_query = DB::table('tbl_candidate')->where('id',$post_candidate_value->candidate_id)->first();
?>
  <td>
    <?php if($candidate_query->image == null):?>
  
      <?php else :?>    
      <img width="50" height="50" src=" {{URL::to($candidate_query->image)}}">
      <?php endif;?>
                                                    </td>
<td>
  <?php echo $candidate_query->name ;?>
</td>
</tr>
<?php } ?>
</table>
</div>
<br/>
<div class="row">
<div class="col-md-8"> 
<button class="btn btn-success" type="submit">CHANGE VOTE</button>
</div>
<div class="col-md-4">
</div>
</div>

</div>
</div>
</div>
</form>
<!--end: Search Form -->
<!--begin: Datatable --> 
    </div>
                        </div>
                           {!! Form::close() !!}
                  <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection
