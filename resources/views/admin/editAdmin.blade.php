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
                                 ADMIN
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
 <div class="col-md-6">
                                 <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                          Update Admin
                                      </div>
                                    </div>
                                    <div class="portlet-body form">
                                             {!! Form::open(['url' =>'updateAdminInfo','method' => 'post','role' => 'form','class'=>'form-horizontal','files' => true]) !!}
                                            <div class="form-body">
                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Admin Name <span style="color:red; font-weight: bold">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control spinner" name="name" value="<?php echo $row->name; ?>" required="">
                                             
                                                </div>
                                              </div>
                                               <div class="form-group">
                                                    <label class="col-md-4 control-label">Father's Name </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control spinner" name="father_name" value="<?php echo $row->father_name; ?>">
                                             
                                                </div>
                                              </div>
                                                    <div class="form-group">
                                                    <label class="col-md-4 control-label">Admin Mobile (Log In Id)<span style="color:red; font-weight: bold">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control spinner" name="mobile" value="<?php echo $row->mobile; ?>" disabled>
                                             
                                                </div>
                                              </div>
                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">Email<span style="color:red; font-weight: bold">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="email" class="form-control spinner" name="email" value="<?php echo $row->email; ?>" required="">
                                             
                                                </div>
                                              </div>
                                                  <div class="form-group">
                                                    <label class="col-md-4 control-label">NID</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control spinner" name="nid" value="<?php echo $row->nid; ?>">
                                             
                                                </div>
                                              </div>
                                                     <div class="form-group">
                                                    <label class="col-md-4 control-label">Addres <span style="color:red; font-weight: bold">*</span></label>
                                                    <div class="col-md-8">
                                                        <textarea type="text" class="form-control spinner" name="address" required=""><?php echo $row->address; ?></textarea>
                                                        </div>
                                                </div>
                                                    <div class="form-group">
                                                    <label class="col-md-4 control-label">Current Image</label>
                                                    <div class="col-md-8">
                                                      <?php if($row->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img width="50" height="50" src="<?php echo $row->image ;?>">
                                                      <?php endif;?>
                                                        </div>
                                                </div>
                                                    <div class="form-group">
                                                    <label class="col-md-4 control-label">Image</label>
                                                    <div class="col-md-8">
                                                      <input type="file" class="form-control spinner" name="image">
                                                        </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $row->id; ?>"> 
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label"></label>
                                                    <div class="col-md-8">
                                                        <button type="submit" class="btn green">Update</button>
                                                    </div>
                                                </div>
                                        {!! Form::close() !!}
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection
