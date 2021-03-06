
<div class="content-wrapper">
       <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Breeds" ?></h1>
            <small><?php echo "Manage Breeds" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><a href="#"><?php echo"Breeds" ?></a></li>
    
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
               
                    <a href="<?php echo base_url('Cherd/add_breed') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo "Add Breed" ?> </a>
                
            </div>
        </div>


        <!-- Manage Product report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Breeds" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0"  id="breedList"> 
                          <thead>
                              <tr>
                                  <th><?php echo display('name') ?></th>
                                  <th><?php echo display('action'); ?> 
                                  </th>
                              </tr>
                          </thead>
                                <tbody>
                                <?php foreach($breeds as $br ){
                                    ?>
                                    <tr>
                                    <td><?php echo $br->name; ?></td>
                                    <td><button  class="btn btn-info btn-xs" data-placement="left" data-toggle="modal" data-target="#exampleModal<?php echo $br->id;?>"><i class="fa fa-edit"></i></button>
                                    <!-- <a href=" <?php echo $base_url.'delete_breed/'.$br->id?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td> -->
                                </tr>
                                    <!-- modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $br->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php echo form_open_multipart('Cherd/update_breed/'.$br->id, array('id' => 'insert_breed', "method"=>'post')) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Breed</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="panel-body">
                                                    <div class="form-group row">
                                                        <label for="breed_name" class="col-sm-4 col-form-label"><?php echo "Breed Name" ?> <i class="text-danger">*</i></label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" name ="name" id="breed_name" type="text" placeholder="<?php echo 'name' ?>"  required="" tabindex="1" value="<?php echo $br->name ?>"> 
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
                               
        
                            </table>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
