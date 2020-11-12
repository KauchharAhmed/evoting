<?php
$admin_id       = Session::get('admin_id');
$type           = Session::get('type');
       
       if($admin_id == null && $type == null){
       return Redirect::to('/admin')->send();
       exit();
        }

       if($admin_id == null && $type != '1'){
       return Redirect::to('/admin')->send();
       exit();
        }
        
        if($type != '1'){
       return Redirect::to('/admin')->send();
       exit();
        }

        ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Result</title>
	<style type="text/css">
		table.nila {
			border-collapse: collapse;
		}

		table.nila, td.nila, th.nila {
			border: 1px solid black;
			padding:7px;
		}
	</style>
</head>
<body>
   
      <center><h3><span style="font-family:tahoma;border:1px solid #000;padding-top:4px;padding-bottom:4px;padding-left:27px;padding-right:27px;">ELECTION RESULT</span></h3></center>      
      <div class="row">
          <table style="font-size:12px;">
                                    <tr>
                                        <td>
                                          <strong>ELECTION</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong> <?php echo $election_info->election_name ; ?></strong>
                                      </td>
                                     
                                    </tr>

                                      
                                     
                                        <tr>
                                        <td>
                                          <strong>TOTAL VOTERS</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong> <?php echo $total_voters_count ; ?> </strong>
                                      </td>
                                     
                                    </tr>
                                      <tr>
                                   
                                         <tr>
                                        <td>
                                          <strong>TOTAL VOTE CAST</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong> <?php echo $total_vote_cast_count ; ?> </strong>
                                      </td>
                                     
                                    </tr>
                                         <tr>
                                        <td>
                                          <strong>CAST %</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong>  <?php 
                                             $vote_percenatage = ($total_vote_cast_count * 100) / $total_voters_count ;
                                             echo number_format($vote_percenatage ,2).' %';
                                            ?> </strong>
                                      </td>
                                     
                                    </tr>
                                    <tr>
                                        <td><?php echo "Print : ".date('d-m-Y , h:i:s a') ; ?></td>
                                    </tr>
                                </table>

<table width="100%" class="nila">
  <thead>
  <tr style="background: aliceblue;">


                                                <td class="nila"><strong>SL</strong></td>
                                                <td class="nila"><strong>POST</strong></td>
                                                <td class="nila"><strong>BALLOT NO</strong></td>
                                                <td class="nila"><strong>NO VOTE COUNT</strong></td>
                                               
                                            </tr>


  </thead>
  <tbody>
                                                 <?php
                                            $i = 1 ; 
                                            foreach ($post as $post_value) { ?> 
                                            
                                            <tr>
                                                <td class="nila"><strong><?php echo  $i++ ; ?> </strong></td>
                                                 <td class="nila"><strong><?php
                                                 $post_query = DB::table('tbl_post')->where('id',$post_value->post_id)->first();
                                                 echo  $post_query->post_name ;
                                                  ?></strong></td>
                                                   <td class="nila"><strong><?php
                                                 echo  $post_query->post_rank ;
                                                  ?></strong></td>
                                                  <td class="nila"><strong><?php
                                                  $no_vote_count = DB::table('tbl_final_vote')->where('election_id',$election)->where('post_id',$post_value->post_id)->where('candidate_id','0')->count();
                                                  echo $no_vote_count ;
                                               
                                                  ?></strong></td>
                                              </tr>

                                              <tr>

                                                <td colspan="4" class="nila">
                                                    <table width="100%" class="nila" style="background: lightgray">
                                                        <tr style="color: blue;
    font-weight: bold;">
                                                        <td class="nila">NAME</td>
                                                        <td class="nila">TOTAL VOTE</td>
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
                                                        <td class="nila"><?php echo $total_vote_value->name ; ?></td>
                                                        <td class="nila"><?php echo $total_vote_value->count ; ?></td>
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
                                                        <td class="nila"><?php echo $absent_candidate_value->name ; ?></td>
                                                        <td class="nila">0</td>
                                                        </tr>
                                                        <?php } ?>


                                                    </table>
                                                </td>
                                              </tr>
                                              <?php } ?>

</tbody>
</table>
	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   