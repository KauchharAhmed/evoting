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
                                    <a href="index.html">Chose Candidate Type</a>
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
                           {!! Form::open(['url' =>'finalVote','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                     
                            <div class="row">
                            <strong>ELECTION NAME : <?php echo $election_info->election_name ; ?></strong>
                            <br/>
                             <strong>TOTAL POST :    <?php $post_count = DB::table('tbl_election_candidate_post')->where('election_id',$election_id)->distinct('post_id')->count('post_id');
                               echo $post_count ;
                             ?></strong>
                            <input type="hidden" name="election_id" value="<?php echo $election_id ;?>" requierd="">
                             <input type="hidden" name="pin" value="<?php echo $pin ;?>" requierd="">

                            </div>
                            <br/><br/>
                               <div class="row widget-row">
                            <div class="col-md-6">
                          <?php
$i = 1 ; 
foreach ($post as $value){ ?>
<div class="content">
 <span style="font-weight: bold;">
 <?php 
 echo " POST :  ";

 $post_query = DB::table('tbl_post')->where('id',$value->post_id)->first();
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
$post_candidate = DB::table('tbl_election_candidate_post')->where('election_id',$election_id)->where('post_id',$value->post_id)->get();
?>
<table class="table table-bordered">
  <tr>
<td><input id="ans" type="radio" name="ans[<?php echo $value->post_id;?>]" value="0"></td> 
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
<input  type="radio" name="ans[<?php echo $post_candidate_value->post_id;?>]" value="<?php echo $post_candidate_value->candidate_id;?>">
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
<?php } ?>
<br/><br/>
</div>
<div class="row">
  <div class="col-md-12">
<div class="col-md-8"> 
<a style="background: gray;" id='previous' href="#" class="btn btn-info"> <strong>PREVIOUS POST VOTE</strong></a>         
<a id='next' href="#" class="btn btn-primary"><strong>NEXT POST VOTE</strong></a>
</div>
<div class="col-md-4"><button id="completeVote" class="btn btn-success" type="submit" style="display: none;"> <strong>COMPLETED VOTE</strong></button>
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
@section('js')
<script>  
 pageSize = 1;
var i = 1;
showPage = function(page) {
    $(".content").hide();
    $(".content").each(function(n) {
        if (n >= pageSize * (page - 1) && n < pageSize * page)
            $(this).show();
    });        
}

showPage(i);

$("#previous").click(function() {
    $("#next").removeClass("current");
    $(this).addClass("current");
    if (i != 1) {
      showPage(--i);
    }
});
$("#next").click(function() {
    $("#previous").removeClass("current");
    $(this).addClass("current");
    if (i < ($('.content').length)/1) {
      showPage(++i);
    }else{
      $("#previous").css("display","none");
      $("#next").css("display","none");
      $("#completeVote").removeAttr("style");
    }    
});

</script>
    @endsection