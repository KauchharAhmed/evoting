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
                                     ELECTION
                                    <i class="fa fa-circle"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"></h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1--> 
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
<div class="row">
 
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase">TEMPORAY VOTE RESULT</span>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                       <strong>ELECTION : <?php $election_query = DB::table('tbl_election')->where('id',$election_id)->first();
                                       echo $election_query->election_name ;?></strong>
                                        <table class="table table-striped table-hover table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Post</th>
                                                     <th>Ballot</th>
                                                     <th>All Candidates</th>
                                                    <th>Choice Candidate</th>
                                                    <th>Change Vote</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ;
                                                foreach ($result as $value) { ?>
                                                <tr>
                                                    <td><?php echo $i++ ;?></td>
                                                    <td><?php 
                                                    $post_query = DB::table('tbl_post')->where('id',$value->post_id)->first();
                                                        echo $post_query->post_name ;

                                                     ?></td>
                                                       <td><?php 
                                                        echo $post_query->post_rank ;
                                                     ?></td>
                                                      <td><?php 
                                                      // all candidate query
                                                      $candidate_query = DB::table('tbl_election_candidate_post')->where('election_id',$election_id)->where('post_id',$value->post_id)->get();
                                                      ?>
                                                      <table>
                                                       <?php foreach ($candidate_query as $candidate_value) { ?>
                                                        <tr>
                                                          <td><?php
                                                          $candidate_info = DB::table('tbl_candidate')->where('id',$candidate_value->candidate_id)->first();
                                                          echo "* ".$candidate_info->name;
                                                            ?></td>
                                                        </tr>
                                                        <?php } ?>

                                                      </table>

                                                       </td>
                                                    <td><?php
                                                    if($value->candidate_id == '0'){
                                                        echo "NO VOTE";
                                                    }else{
                                                        $candidate_query = DB::table('tbl_candidate')->where('id',$value->candidate_id)->first();
                                                        echo $candidate_query->name ;
                                                    } 

                                                      ?></td>
                                                    <td><a target="_blank" href="{{ URL::to('changeMyVote') }}/{{ $election_id }}/{{ $pin }}/{{ $session_id }}/{{ $random_number }}/{{ $value->id }}" class="btn blue">Change Vote</a></td>
                                                </tr>
                                                <?php } ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                 {!! Form::open(['url' =>'voteDesicionAftetVote','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                                    <div class="form-group">
                                        <input type="hidden" name="election_id" value="<?php echo $election_id ;?>" required="">
                                          <input type="hidden" name="pin" value="<?php echo $pin ;?>" required="">
                                          <input type="hidden" name="session_id" value="<?php echo $session_id ;?>" required="">
                                            <input type="hidden" name="session_id" value="<?php echo $session_id ;?>" required="">
                                             <input type="hidden" name="random_number" value="<?php echo $random_number ;?>" required="">
                                                    <label class="col-md-2 control-label"></label>
                                                    <div class="col-md-5">
                                                        <button value="ok" name="confirm_button" type="submit" class="btn green">Confim This Vote</button>

                                                    </div>
                                                       <div class="col-md-5">
                                                        <button name="confirm_button" value="not_ok" type="submit" class="btn red">Cancel This Vote</button>
                                                        
                                                    </div>
                                                </div>

                                    {!! Form::close() !!}
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection