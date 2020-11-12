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
                                         {!! Form::open(['url' =>'printElectionResultReport','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
                                         <input type="hidden" name="election" value="<?php echo $election;?>">
                                         <input type="hidden" name="post" value="<?php echo $post;?>">
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
                                                <div class="col-md-2">POST</div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $post_info->post_name ; ?>   
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
                                                <div class="col-md-2">NO VOTE COUNT</div>
                                             <div class="col-md-1">:</div>
                                             <div class="col-md-9">
                                             <?php echo $no_vote_count ; ?>   
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
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                             <thead>
                                            <tr>
                                                <td><strong>Result</strong></td>
                                                <td><strong>Photo</strong></td>
                                                <td><strong>Name</strong></td>
                                                <td><strong>Total Vote</strong></td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1 ; 
                                            foreach ($result as $value) { ?> 
                                            <tr>
                                                <td><?php echo  $i++ ; ?></td>
                                                <td>
                                                <?php if($value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img style="border-radius: 50%" width="80" height="80" src=" {{URL::to($value->image)}}">
                                                    <?php endif;?>
                                                  </td>
                                                <td><?php echo $value->name;?></td>
                                              
                                                <td><?php echo $value->count;?></td>                                      
                                                </tr>
                                                <?php } ?>
                                                <?php foreach ($absent_candidate as $absent_value) { ?> 
                                            <tr>
                                                <td><?php echo  $i++ ; ?></td>
                                                <td>
                                                <?php if($absent_value->image == null):?>
                                                            <span>No Image</span>
                                                        <?php else :?>    
                                                        <img style="border-radius: 50%" width="80" height="80" src=" {{URL::to($absent_value->image)}}">
                                                    <?php endif;?>
                                                  </td>
                                                <td><?php echo $absent_value->name;?></td>
                                             
                                                <td>0</td>                                        
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
             