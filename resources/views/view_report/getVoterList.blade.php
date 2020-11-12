  <div class="row">
 
                            <div class="col-md-12">
                                 
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <span class="caption-subject bold uppercase">
                                           ELECTION VOTER LIST
                                            </span>
                                        </div>
                                         {!! Form::open(['url' =>'printElectionResultReport','method' => 'post','role' => 'form','class'=>'form-horizontal']) !!}
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
                                         </div>
                                         </strong>
                                      </div>
                                      <br/><br/>
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                             <thead>
                                            <tr>
                                                 
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
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                       
                        <!-- END DASHBOARD STATS 1-->
                    </div><!-- END PAGE CONTENT BODY -->
             