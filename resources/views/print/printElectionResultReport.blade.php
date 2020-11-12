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
                                          <strong>POST</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong> <?php echo $post_info->post_name ; ?></strong>
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
                                        <td>
                                          <strong>NO VOTE COUNT</strong>
                                      </td>
                                       <td>
                                          <strong>:</strong>
                                      </td>
                                       <td>
                                          <strong> <?php echo $no_vote_count ; ?> </strong>
                                      </td>
                                     
                                    </tr>
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


  <tr>
                                                <td class="nila"><strong>Result</strong></td>
                                                <td class="nila"><strong>Photo</strong></td>
                                                <td class="nila"><strong>Name</strong></td>
                                                <td class="nila"><strong>Total Vote</strong></td>
                                               
                                            </tr>


  </thead>
  <tbody>
                                        <?php
                                            $i = 1 ; 
                                            foreach ($result as $value) { ?> 
                                            <tr>
                                                <td class="nila"><?php echo  $i++ ; ?></td>
                                                <td class="nila">
                                                <?php if($value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img style="border-radius: 50%" width="80" height="80" src=" {{URL::to($value->image)}}">
                                                    <?php endif;?>
                                                  </td>
                                                <td class="nila"><?php echo $value->name;?></td>
                                                <td class="nila"><?php echo $value->count;?></td>                                        
                                                </tr>
                                                <?php } ?>

                                                <?php
                                            foreach ($absent_candidate as $absent_value) { ?> 
                                            <tr>
                                                <td class="nila"><?php echo  $i++ ; ?></td>
                                                <td class="nila">
                                                <?php if($absent_value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img style="border-radius: 50%" width="80" height="80" src=" {{URL::to($absent_value->image)}}">
                                                    <?php endif;?>
                                                  </td>
                                                <td class="nila"><?php echo $absent_value->name;?></td>
                                             
                                                <td class="nila">0</td>                                        
                                                </tr>
                                                <?php } ?>

</tbody>
</table>
	<script type="text/javascript">
	window.print();
	</script>
    </body>
</html>

   