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
                                REPORT
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
                                 <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                          GENERATE RESULT REPORT
                                      </div>
                                    </div>
                                    <div class="portlet-body form">
                                             
                                             <form class="form-horizontal">
                                            <div class="form-body" style="background-color: whitesmoke">
                                              <div class="form-group">
                                               
                                                      <label class="col-md-1 control-label">Election<span style="color:red; font-weight: bold">*</span></label>
                                                        <div class="col-md-2">
                                                         <select class="form-control spinner selectpicker" data-live-search="true" id="election">
                                                           <option value="">Select Election</option>
                                                           <?php foreach ($election as $election_value) { ?>
                                                           <option value="<?php echo $election_value->id;?>">
                                                             <?php echo $election_value->election_name ;?>
                                                          </option>
                                                           <?php } ?>
                                                         </select>
                                                      </div>
                                                        <label class="col-md-1 control-label">Post<span style="color:red; font-weight: bold">*</span></label>
                                                        <div class="col-md-2">
                                                         <select class="form-control spinner selectpicker" data-live-search="true" id="post">
                                                           <option value="">Select Post</option>
                                                           <?php foreach ($post as $post_value) { ?>
                                                           <option value="<?php echo $post_value->id;?>">
                                                             <?php echo $post_value->post_name ;?>
                                                          </option>
                                                           <?php } ?>
                                                         </select>
                                                      </div>
                                                       <label class="col-md-1 control-label"></label>
                                                       <div class="col-md-1">
                                                        <button  type="button" class="btn btn-info btn-sm" id="report" >SEARCH</button>
                                                      </div>
                                                </div>
                                              </div>

                                       </form>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- END DASHBOARD STATS 1-->
                    <div class="col-md-12" style="display:none;" id="loader">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                      <div class="loader">
                      </div>
                      </div>
                      <div class="col-md-5"></div>
                   </div>
                     <span id="failed" style="color:red"></span>
                     <div id="get_content" style="display: none;"></div>


                    </div><!-- END PAGE CONTENT BODY -->

                </div><!-- END PAGE CONTENT -->             
            </div><!-- END CONTAINER -->
@endsection
@section('js')
   <script>
     $('#report').click(function(e){
       e.preventDefault();
       var election    = $('#election').val();
       var post       = $('#post').val();
       if(election == ''){
        alert('Select Election');
        return false ;
       }
       if(post == ''){
        alert('Select Post');
        return false ;
       }
        $('#loader').removeAttr( 'style' );
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
       $.ajax({
        'url':"{{ url('/postWiseElectionResultReportView') }}",
        'type':'post',
        'dataType':'text',
        data:{  
        election:election ,
        post:post
        },
         success:function(data)
         {
          if(data =='f1'){
          $('#failed').text('No Data Found');
          $('#loader').attr("style", "display: none;");
          $('#get_content').attr("style", "display: none;");
          }else{
          $('#failed').text('');
          $('#loader').attr("style", "display: none;");
          $('#get_content').removeAttr( 'style' );
          $('#get_content').html(data);
        }
        }
        });
       });
    </script>
    @endsection