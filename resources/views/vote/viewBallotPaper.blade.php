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
                                    BALLOT PAPER 
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
                                            <span class="caption-subject bold uppercase">BALLOT PAPER </span>
                                        </div>
                                        <div class="tools">
                                        </div>

                                    </div>
                                        <div class="header">
                                         
                                          <strong>
                                            <div class="row"><div class="col-md-2">ELECTION</div>

                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $election_info->election_name ; ?>
                                                 
                                             </div>
                                         </div>
                                         </strong>
                                            <br/>
                                             <strong>
                                                <div class="row">
                                                <div class="col-md-2">POST</div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $post_info->post_name ; ?>   
                                             </div>
                                         </div>
                                         </strong>
                                      </div>
                                      {!! Form::open(['url' =>'finalGivenVote','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
                                    <div class="portlet-body table-responsive">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                     <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Vote</th>
                                                    <!--<th>Edit</th>
                                                     <th>Delete</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ;
                                                foreach ($result as $value) { ?>
                                                <tr>
                                                    <td><?php echo $i++ ;?></td>
                                                     <td>
                                                        <?php if($value->candidate_image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img style="border-radius: 50%" width="100" height="100" src=" {{URL::to($value->candidate_image)}}">
                                                    <?php endif;?>
                                                    </td>
                                                    <td><?php echo $value->name ; ?></td>>
                                                    <td><input class="form-control spinner" type="radio" name="vote" value="<?php echo $value->candidate_id ;?>"></td>
                                                  
                                                </tr>
                                                <?php } ?>
                                                  <input type="hidden" name="election_id" value="<?php echo $election_id ; ?>">
                                                    <input type="hidden" name="post_id" value="<?php echo $post_id ; ?>">
                                                      <input type="hidden" name="pin" value="<?php echo $pin ; ?>">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                       <div class="form-group">
                                                    <label class="col-md-4 control-label"></label>
                                                    <div class="col-md-8">
                                                        <button onclick="return confirm('Are You Sure You Want To Vote ?')" type="submit" class="btn green">Click To Vote</button>
                                                    </div>
                                                </div>
                                     {!! Form::close() !!}
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection