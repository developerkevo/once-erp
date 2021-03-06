
<div class="content-wrapper">
       <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Cows" ?></h1>
            <small><?php echo "Manage Cows" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><a href="#"><?php echo"Cows" ?></a></li>
    
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

         <div class="row">
            <div class="col-sm-12">
                    <button  class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addCowModal"><i class="ti-plus"> </i> <?php echo "Add Cow" ?> </button>
            </div>
        </div>


        <!-- Manage Cows report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Cows" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0"  id="routeList"> 
                          <thead>
                              <tr>
                                  <th></th>
                                  <th><?php echo 'Farmer'; ?></th>
                                  <th><?php echo 'Route'; ?></th>
                                  <th><?php echo 'Breed'; ?></th>
                                  <th><?php echo 'Age'; ?></th>
                                  <th><?php echo 'Producton'; ?></th>
                                  <th><?php echo display('action'); ?> 
                                  </th>
                              </tr>
                          </thead>
                                <tbody>
                                <?php foreach($cows as $key=>$c ){
                                    ?>
                                    <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td><?php echo $c->farmer; ?></td>
                                    <td><?php echo $c->route_name; ?></td>
                                    <td><?php echo $c->breed_name; ?></td>
                                    <td><?php echo $c->age; ?></td>
                                    <td><?php echo $c->production; ?></td>
                                    <td><button  class="btn btn-info btn-xs" data-placement="left" data-toggle="modal" data-target="#exampleModal<?php echo $c->id;?>"><i class="fa fa-edit"></i></button>
                                    <!-- <a href=" <?php echo $base_url.'delete_route/'.$c->id?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td> -->
                                </tr>
                                    <!-- modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $c->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php echo form_open_multipart('Cherd/update_cow/'.$c->id, array('id' => 'insert_cow'.$c->id, "method"=>'post')) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Cow</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                        <label for="breed" class="form-label col-sm-12"><?php echo "Breed" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">                                            
                                             <select class="form-control" id="breed_<?php echo $c->id;?>" name="breed" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                <?php
                                                foreach($breeds as $br)
                                                    {?>
                                                    <option value="<?php echo $br->id ?>" <?php echo  $c->breed_name === $br->name ? 'selected' : ''; ?>> <?php echo $br->name ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>                                         
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">                                    
                                        <div class="form-group row">
                                            <label for="route" class="form-label col-sm-12"><?php echo "Route" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name ="route" id="route_<?php echo $c->id;?>" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                            foreach($routes as $r)
                                                            {?>
                                                        <option value="<?php echo $r->id ?>"  <?php echo  $c->route_name === $r->name ? 'selected' : ''; ?> > <?php echo $r->name ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                </select>                                         
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="farmer" class="form-label col-sm-12"><?php echo "Farmer" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                            <select class="form-control" name ="farmer" id="farmer_<?php echo $c->id;?>" style="width:100%;">
                                                    <?php
                                                        foreach($farmers as $f)
                                                        {?>
                                                    <option value="<?php echo $f->customer_id;?>" <?php echo  $c->farmer === $f->customer_name ? 'selected' : ''; ?> > <?php echo $f->customer_name ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                            </select>                                         
                                            </div>
                                        </div>                                   
                                    
                                    </div>
                                    
                                    <div class="col-sm-12">                                
                                    <div class="form-group">
                                        <label for="age" class="form-label"><?php echo "Age" ?> <i class="text-danger">*</i></label>                                        
                                        <input class="form-control" name ="age" id="age_<?php echo $c->id;?>" type="number" placeholder="<?php echo '10' ?>" value="<?php echo $c->age;?>" required="" tabindex="1">                                         
                                    </div>
                                </div>

                                    <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="production" class="form-label"><?php echo "Production" ?> <i class="text-danger">*</i></label>                                        
                                            <input class="form-control" name ="production" id="production_<?php echo $c->id;?>" type="text" value="<?php echo $c->production;?>" required="" tabindex="1">                                         
                                        </div>
                                    </div>
                                    
                                </div>
                                

                        
                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </div>
                                        </div>
                                        <?php echo form_close()?>
                                        </div>
                                    </div>
                              <?php  } ?>                               
                                  
                                </tbody>

                                <tfoot>
                                    <th class="col-span">
                                        Total Cows
                                    </th>
                                    <th>
                                        <?php echo count($cows);?>
                                    </th>
                                </tfoot>
        
                            </table>
                          
                        </div>
                    </div>

                    <!-- add Modal -->
                    <div class="modal fade" id="addCowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php echo form_open_multipart('Cherd/add_cow/', array('id' => 'insert_cow', "method"=>'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Cow</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                        <label for="breed" class="form-label col-sm-12"><?php echo "Breed" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">                                            
                                             <select class="form-control" id="breed" name="breed" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                <?php
                                                foreach($breeds as $br)
                                                    {?>
                                                    <option value="<?php echo $br->id ?>"> <?php echo $br->name ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>                                         
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">                                    
                                        <div class="form-group row">
                                            <label for="route" class="form-label col-sm-12"><?php echo "Route" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name ="route" id="route" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                            foreach($routes as $r)
                                                            {?>
                                                        <option value="<?php echo $r->id ?>"> <?php echo $r->name ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                </select>                                         
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="farmer" class="form-label col-sm-12"><?php echo "Farmer" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                            <select class="form-control" name ="farmer" id="farmer" style="width:100%;">
                                                    <?php
                                                        foreach($farmers as $f)
                                                        {?>
                                                    <option value="<?php echo $f->customer_id ?>"> <?php echo $f->customer_name ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                            </select>                                         
                                            </div>
                                        </div>                                   
                                    
                                    </div>
                                    
                                    <div class="col-sm-12">                                
                                    <div class="form-group">
                                        <label for="age" class="form-label"><?php echo "Age" ?> <i class="text-danger">*</i></label>                                        
                                        <input class="form-control" name ="age" id="age" type="number" placeholder="<?php echo '10' ?>"  required="" tabindex="1">                                         
                                    </div>
                                </div>

                                    <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="production" class="form-label"><?php echo "Production" ?> <i class="text-danger">*</i></label>                                        
                                            <input class="form-control" name ="production" id="production" type="text"  required="" tabindex="1">                                         
                                        </div>
                                    </div>
                                    
                                </div>
                                

                                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        <?php echo form_close()?>
                        </div>
                    <!-- end add modal -->
                </div>
            </div>
        </div>

        <div class="row">
        
            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="charttitle"></h4>
                        </div>
                        <div class="panel-body">

                        <input type="hidden" id="cows_by_breed_data" value="<?php echo html_escape($cows_by_breed_data); ?>">
                        <input type="hidden" id="cows_by_breed_label" value="<?php echo html_escape($cows_by_breed_lable); ?>">
                            <canvas id="cowsBreedSummery" width="600" height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                        <input type="hidden" id="cows_by_route_data" value="<?php echo html_escape($cows_by_route_data); ?>">
                        <input type="hidden" id="cows_by_route_label" value="<?php echo html_escape($cows_by_route_lable); ?>">
                            <h4 class="charttitle"></h4>
                        </div>
                        <div class="panel-body"> 
                        <div id="chartContainer" class="piechartcontainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url() ?>assets/js/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/canvasjs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/herdManagement.js" type="text/javascript"></script>
