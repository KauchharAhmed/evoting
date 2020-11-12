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
                                  Chose To Give Vote
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
    <?php if($voter_status_count == '0'):?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>You Are Not A Voter To Give Next Election.</strong>
</div> 
                                <?php else:?>
                            <div class="col-md-12">

                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase">Click And Given The Vote</span>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Election</th>
                                                    <th>Start Date And Time</th>
                                                    <th>End Date And Time</th>
                                                    <th>Remarks</th>
                                                     <th>Action</th>
                                                    <!--<th>Edit</th>
                                                     <th>Delete</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php date_default_timezone_set('Asia/Dhaka');
        $current_date       = date('Y-m-d');
        $current_time       = date('H:i:s');
        $e_start_date = $value->start_date ;
        $e_start_time = $value->start_time ;
        $e_end_date   = $value->end_date ;
        $e_end_time   = $value->end_time ;
        ?>

                                                <tr>
                                                    <td><?php  
                                                    $electtion_id = $value->election_id ;
                                                    $election_query = DB::table('tbl_election')->where('id',$value->id)->first();
                                                    echo $election_query->election_name ;
                                                    ?></td>
                                                    <td>
                                                    <?php echo date('d-M-Y',strtotime($value->start_date));
                                                     echo "<br/>";
                                                        echo date('h:i:s a',strtotime($value->start_time));
                                                        ?>   
                                                    </td>
                                                    <td>  <?php echo date('d-M-Y',strtotime($value->end_date));
                                                      echo "<br/>";
                                                        echo date('h:i:s a',strtotime($value->end_time));
                                                        ?> </td>
                                                   
                                                    <td><?php echo $value->remarks ; ?></td>
                                                    <td>
        <?php if($current_date == $e_start_date AND $current_time > $e_start_time):?>
           <a href="{{URL::to('VerifyPinToVote/'.$value->election_id)}}"><button type="button" class="btn btn-info btn-sm">Click To Vote</button></a>  
        <?php elseif($current_date > $e_start_date AND $current_date < $e_end_date):?>
        <a href="{{URL::to('VerifyPinToVote/'.$value->election_id)}}"><button type="button" class="btn btn-info btn-sm">Click To Vote</button></a>  
        <?php elseif($current_date == $e_end_date AND $current_time < $e_end_time):?>
        <a href="{{URL::to('VerifyPinToVote/'.$value->election_id)}}"><button type="button" class="btn btn-info btn-sm">Click To Vote</button></a> 
    <?php else:?>
   <span style="color: red">Election Not Running</span>
   <?php endif;?>
                                                    </td>
                                                
                                                </tr>
                                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        <div class="clearfix"></div>
                    <?php endif;?>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection