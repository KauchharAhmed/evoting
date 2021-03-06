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
                                   ACTIVE VOTER LIST
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
                                            <span class="caption-subject bold uppercase">Active Voter List</span>
                                        </div>
                                        <div class="tools"> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Membership No</th>
                                                    <th>Voter Number</th>
                                                    <th>System Voter Number</th>
                                                    <th>Name</th>
                                                    <th>F. Name</th>
                                                    <th>M.Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Image</th>
                                                    <th>Pin</th>
                                                    <th>Edit</th>
                                                    <!--<th>Delete</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ;
                                                foreach ($result as $value) { ?>
                                                <tr>
                                                    <td><?php echo $i++ ;?></td>
                                                     <td><?php echo $value->manual_membership_number ; ?></td>
                                                      <td><?php echo $value->manual_voter_number ; ?></td>
                                                    <td><?php echo $value->voter_id ; ?></td>
                                                    <td><?php echo $value->name ; ?></td>
                                                    <td><?php echo $value->father_name ; ?></td>
                                                    <td><?php echo $value->mother_name ; ?></td>
                                                    <td><?php echo $value->mobile ; ?></td>
                                                    <td><?php echo $value->email ; ?></td>
                                                    <td>
                                                        <?php if($value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img width="50" height="50" src=" {{URL::to($value->image)}}">
                                                    <?php endif;?>
                                                    </td>
                                                    <td>
                                                    <?php
                                                    // get voter pin
                                                    $pin_count = DB::table('tbl_parcitipate_election')->where('voter_id',$value->id)->count();
                                                    if($pin_count > 0){
                                                               $pin_query = DB::table('tbl_parcitipate_election')->where('voter_id',$value->id)->first();
                                                               echo $pin_query->pin_no;
                                                    }
                                                    ?>    
                                                    </td>
                                                    <td>
                                                        <a href="{{ URL::to('editVoter') }}/{{ $value->id }}" class="btn btn-info btn-sm">EDIT</a>
                                                    </td>
                                                    <!--<td>
                                                        <button type="button" class="btn btn-danger btn-sm">DELETE</button>
                                                    </td>-->
                                                </tr>
                                                <?php } ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection