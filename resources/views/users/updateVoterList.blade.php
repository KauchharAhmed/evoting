          @extends('admin.masterAdmin')
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
                                  UPDATE VOTER LIST BY ELECTION
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
                                            <span class="caption-subject bold uppercase">UPDATE VOTER LIST BY ELECTION</span>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                      {!! Form::open(['url' =>'updateVoterListInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
                                    <div class="portlet-body">
                                           <div class="form-group">
                                                    <label class="col-md-2 control-label">Select Election  <span style="color:red; font-weight: bold">*</span></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control spinner selectpicker" data-live-search="true" name="election" required="">
                                                          <option value="">Select Election</option>
                                                          <?php foreach ($election as $election_value) { ?>
                                                          <option value="<?php echo $election_value->id;?>"><?php echo $election_value->election_name;?></option>
                                                          <?php } ?>    
                                                        </select>
                                             
                                                </div>
                                              </div>
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Sl</th>
                                                    <th>Voter Number</th>
                                                    <th>Name</th>
                                                    <th>F. Name</th>
                                                    <th>M.Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>NID</th>
                                                    <th>Address</th>
                                                    <th>Image</th>
                                                    <!--<th>Edit</th>
                                                     <th>Delete</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ;
                                                foreach ($result as $value) { ?>
                                                <tr>
                                                    <td><input type="checkbox" name="status[]" checked=""  value="<?php echo $value->id;?>"></td>
                                                    <td><?php echo $i++ ;?></td>
                                                    <td><?php echo $value->voter_id ; ?></td>
                                                    <td><?php echo $value->name ; ?></td>
                                                    <td><?php echo $value->father_name ; ?></td>
                                                    <td><?php echo $value->mother_name ; ?></td>
                                                    <td><?php echo $value->mobile ; ?></td>
                                                    <td><?php echo $value->email ; ?></td>
                                                    <td><?php echo $value->nid ; ?></td>
                                                    <td><?php echo $value->address ; ?></td>
                                                    <td>
                                                        <?php if($value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img width="50" height="50" src=" {{URL::to($value->image)}}">
                                                    <?php endif;?>
                                                    </td>
                                                    <!--<td>
                                                        <button type="button" class="btn btn-info btn-sm">EDIT</button>
                                                    </td>
                                                       <td>
                                                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                                                    </td>-->
                                                </tr>
                                                <?php } ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-10">
                                        <button type="submit" class="btn green">Update Voter List</button>
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