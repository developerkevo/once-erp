<!-- Add new supplier start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Add Breed" ?></h1>
            <small><?php echo "Add New Route" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo "breed" ?></a></li>
                <li class="active"><?php echo "add breed" ?></li>
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
                
                    <a href="<?php echo base_url('Cherd/manage_route') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo "Manage Breed" ?> </a>

                    <!-- <a href="<?php echo base_url('Csupplier/supplier_ledger_report') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('supplier_ledger') ?> </a>

                    <a href="<?php echo base_url('Csupplier/supplier_sales_details_all') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('supplier_sales_details') ?> </a>
                     <button type="button" class="btn btn-info m-b-5 m-r-2" data-toggle="modal" data-target="#supplier_modal"><?php echo display('csv_upload_supplier')?></button> -->

               
            </div>
        </div>

        <!-- New supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Add Breed"; ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cherd/save_route', array('id' => 'insert_route', "method"=>'post')) ?>
                    <div class="panel-body">
                        <div class="col-sm-6">

                        <div class="form-group row">
                            <label for="breed_name" class="col-sm-4 col-form-label"><?php echo "Route Name" ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input class="form-control" name ="name" id="breed_name" type="text" placeholder="<?php echo 'name' ?>"  required="" tabindex="1">
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6">
                                <input type="submit" id="add-supplier" class="btn btn-primary btn-large" name="add-supplier" value="<?php echo display('save') ?>" tabindex="6"/>
                                <!-- <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-supplier-another" class="btn btn-large btn-success" id="add-supplier-another" tabindex="5"> -->
                            </div>
                   

                        <!-- <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            
                        </div> -->
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
        <div id="supplier_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  </div>
</div>
    </section>
</div>
<!-- Add new supplier end -->



