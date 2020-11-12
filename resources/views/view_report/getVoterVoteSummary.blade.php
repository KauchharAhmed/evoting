  <div class="row">
 
                            <div class="col-md-12">
                                 
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase">
                                           You Have Given Vote Report 
                                            </span>
                                        </div>
                                       
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
                                         <br/>

                                      </div>  
                                      </div>
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                             <thead>
                                            <tr>
                                                <td><strong>Sl</strong></td>
                                                <td><strong>Photo</strong></td>
                                                <td><strong>Post</strong></td>
                                                <td><strong>Name</strong></td>
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
                                                  <td><?php 
                                                  $post_info_query = DB::table('tbl_post')->where('id',$value->post_id)->first();
                                                  echo $post_info_query->post_name;

                                                  ?></td>

                                                <td><?php 
                                                if($value->name ==''){
                                                  echo "NO VOTE";
                                                }else{
                                                echo $value->name;
                                              }
                                                ?></td>
                                                                                     
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
             