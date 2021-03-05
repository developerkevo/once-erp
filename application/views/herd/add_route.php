<!-- Add new supplier start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Add Route" ?></h1>
            <small><?php echo "Add New Route" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo "route" ?></a></li>
                <li class="active"><?php echo "add route" ?></li>
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
                
                    <a href="<?php echo base_url('Cherd/manage_route') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage Route" ?> </a>
               
            </div>
        </div>

        <!-- New supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Add Route"; ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cherd/save_route', array('id' => 'insert_route', "method"=>'post')) ?>
                    <div class="panel-body">
                        <div class="col-sm-6">

                        <div class="form-group row">
                            <label for="route_name" class="col-sm-4 col-form-label"><?php echo "Route Name" ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input class="form-control" name ="name" id="route_name" type="text" placeholder="<?php echo 'name' ?>"  required="" tabindex="1">
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">
                                <input type="submit" id="add-supplier" class="btn btn-primary btn-large" name="add-supplier" value="<?php echo display('save') ?>" tabindex="6"/>
                            </div>
                
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
        <div id="supplier_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo display('csv_supplier'); ?></h4>
      </div>
      <div class="modal-body">

                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('csv_supplier'); ?></h4>
                        </div>
                    </div>
                    
                    <div class="panel-body">
                     <div class="col-sm-12"><a href="<?php echo base_url('assets/data/csv/supplier_csv_sample.csv') ?>" class="btn btn-primary pull-right"><i class="fa fa-download"></i> <?php echo display('download_sample_file')?></a></div>
                      <?php echo form_open_multipart('Csupplier/uploadCsv_Supplier',array('class' => 'form-vertical', 'id' => 'validate','name' => 'insert_supplier'))?>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="upload_csv_file" class="col-sm-4 col-form-label"><?php echo display('upload_csv_file') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="upload_csv_file" type="file" id="upload_csv_file" placeholder="<?php echo display('upload_csv_file') ?>" required>
                                    </div>
                                </div>
                            </div>
                        
                       <div class="col-sm-12">
                        <div class="form-group row">
                            <div class="col-sm-12 text-right">
                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('submit') ?>" />
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                               
                            </div>
                        </div>
                        </div>
                          <?php echo form_close()?>
                    </div>
                    </div>
                  
               
     
      </div>
     
    </div>

  </div>
</div>
    </section>
</div>
<!-- Add new supplier end -->



