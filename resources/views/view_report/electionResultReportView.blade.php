  <div class="row">
 
                            <div class="col-md-12">
                                 
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase">
                                           RESULT 
                                            </span>
                                        </div>
                                         {!! Form::open(['url' =>'printFinalElectionResultReport','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                                         <input type="hidden" name="election" value="<?php echo $election;?>">
    
                                       <button type="submit" style="float:right;margin-right:6px;" class="btn btn-success">Print</button> 
                                      {!! Form::close() !!}  
                                    </div>
                                    <div class="portlet-body">
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
                                                <div class="col-md-2">TOTAL VOTERS</div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $total_voters_count ; ?>   
                                             </div>
                                         </div>
                                         </strong>
                                         <br/>
                                        

                                          <strong>
                                                <div class="row">
                                                <div class="col-md-2">TOTAL VOTE CAST</div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $total_vote_cast_count ; ?>   
                                             </div>
                                         </div>
                                         </strong>
                                      </div>  
                                         <br/>
                                          <strong>
                                            <div class="row">
                                            <div class="col-md-2">CAST % </div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php 
                                             $vote_percenatage = ($total_vote_cast_count * 100) / $total_voters_count ;
                                             echo number_format($vote_percenatage ,2).' %';
                                            ?>   
                                             </div>
                                         </div>
                                         </strong>
                                      </div>
                                      <br/>
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                             <thead>
                                            <tr style="background: aliceblue;">
                                                <td><strong>SL</strong></td>
                                                <td><strong>POST</strong></td>
                                                <td><strong>BALLOT NO</strong></td>
                                                <td><strong>NO VOTE COUNT</strong></td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1 ; 
                                            foreach ($post as $post_value) { ?> 
                                            
                                            <tr>
                                                <td><strong><?php echo  $i++ ; ?> </strong></td>
                                                 <td><strong><?php
                                                 $post_query = DB::table('tbl_post')->where('id',$post_value->post_id)->first();
                                                 echo  $post_query->post_name ;
                                                  ?></strong></td>
                                                   <td><strong><?php
                                                 echo  $post_query->post_rank ;
                                                  ?></strong></td>
                                                  <td><strong><?php
                                                  $no_vote_count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post_value->post_id)->where('candidate_id','0')->count();
                                                  echo $no_vote_count ;
                                               
                                                  ?></strong></td>
                                              </tr>

                                              <tr>

                                                <td colspan="4">
                                                    <table class="table table-bordered" style="background: lightgray">
                                                        <tr style="color: blue;
    font-weight: bold;">
                                                        <td>NAME</td>
                                                        <td>TOTAL VOTE</td>
                                                        </tr>

                                                       
                                                                <?php 
     // vote case count
      $result_get_vote_candidate = DB::table('tbl_final_vote')
      ->join('tbl_candidate','tbl_final_vote.candidate_id','=','tbl_candidate.id')
      ->select('tbl_final_vote.*','tbl_candidate.name','tbl_candidate.image', DB::raw("COUNT(tbl_final_vote.candidate_id) AS count"))
      ->where('tbl_final_vote.election_id',$election)
      ->where('tbl_final_vote.post_id',$post_value->post_id)
      ->groupBy('tbl_final_vote.candidate_id')
      ->orderBy('count','desc')
      ->get();
      ?>
      <?php foreach ($result_get_vote_candidate as  $total_vote_value) { ?>
  
                                                        <tr>
                                                        <td><?php echo $total_vote_value->name ; ?></td>
                                                        <td><?php echo $total_vote_value->count ; ?></td>
                                                        </tr>
                                                        <?php } ?>


                                                        <?php $count_result =  count($result_get_vote_candidate);
      foreach ($result_get_vote_candidate as $candidate_value) {
        $candidate_id[] = $candidate_value->candidate_id;
      }
    if($count_result == '0'){
        $absent_candidate = DB::table('tbl_candidate')
  ->join('tbl_election_candidate_post', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
  ->select('tbl_election_candidate_post.*','tbl_candidate.name','tbl_candidate.image')
   ->where('tbl_election_candidate_post.election_id',$election)
   ->where('tbl_election_candidate_post.post_id',$post_value->post_id)
   ->orderBy('tbl_candidate.id','asc')
  ->get();

    }else{
    $absent_candidate = DB::table('tbl_candidate')
  ->join('tbl_election_candidate_post', 'tbl_election_candidate_post.candidate_id', '=', 'tbl_candidate.id')
  ->select('tbl_election_candidate_post.*','tbl_candidate.name','tbl_candidate.image')
   ->where('tbl_election_candidate_post.election_id',$election)
   ->where('tbl_election_candidate_post.post_id',$post_value->post_id)
   ->whereNotIn('tbl_election_candidate_post.candidate_id',$candidate_id)
   ->orderBy('tbl_candidate.id','asc')
  ->get();
}

?>
<?php foreach ($absent_candidate as  $absent_candidate_value) { ?>

 <tr>
                                                        <td><?php echo $absent_candidate_value->name ; ?></td>
                                                        <td>0</td>
                                                        </tr>
                                                        <?php } ?>


                                                    </table>
                                                </td>
                                              </tr>
                                              <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                       
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
             