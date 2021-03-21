<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Raw Materials" ?></h1>
            <small><?php echo "Manage Raw Materials" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><a href="#"><?php echo "Vet" ?></a></li>

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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addRawMaterials"><i class="ti-plus"> </i> <?php echo "Add Raw Materials" ?> </button>

            </div>
        </div>


        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('Cmanfucturing/manage_raw_materials', array('class' => 'form-inline', "method" => "post")) ?>

                        <div class="form-group">
                            <select class="form-control" name="dstatus" style="width: 150px;">
                                <option value="All">All Diseases</option>
                                <?php
                                foreach ($diseases as $d) {
                                ?>
                                    <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                <?php  } ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success btn-md"><?php echo "Filter By Diseases" ?></button>

                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- Manage Raw Materials report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Raw Materials" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Raw Material'; ?></th>
                                        <th><?php echo 'Unit Price'; ?></th>
                                        <th><?php echo 'Stock Balance'; ?></th>
                                        <th><?php echo 'Total Price'; ?></th>
                                        <th><?php echo 'Update'; ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($raw_materials as $key => $m) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $m->name; ?></td>
                                            <td><?php echo "Ksh. ".$m->unit_price. " per ".$m->unit_measure; ?></td>
                                            <td><?php echo $m->quantity; ?></td>
                                            <td><?php echo "Ksh. " . number_format(($m->unit_price * $m->quantity), 2, '.', ','); ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" onclick='updateRawMaterials(<?php echo json_encode($m); ?>)'>
                                                    Update Raw Materials
                                                </button>
                                            </td>

                                        </tr>
                                    <?php  } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <strong>Total Raw Materials</strong>
                                        </td>
                                        <td colspan="2">
                                            <?php echo "<strong>" . count($raw_materials) . "</strong>"; ?>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!-- add sick cow Modal -->
                    <div class="modal fade" id="addRawMaterials" tabindex="-1" role="dialog" aria-labelledby="addRawMaterialsLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cmanufucturing/add_raw_material/', array('id' => 'add_sick_cow', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addRawMaterialsLabel">Add Raw Material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                    <input class="form-control" id="rmId" type="hidden" name="id" readonly tabindex="1">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="materialNameId" class="form-label"><?php echo "Raw Material Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="materialNameId" type="text" name="rawMaterialName" tabindex="1">
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="unitPriceId" class="form-label"><?php echo "Unit Price" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="unitPriceId" type="number" name="unitPrice" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="quantityId" class="form-label"><?php echo "Quantity" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="quantityId" type="number" name="quantity" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="unitMeasureId" class="form-label"><?php echo "Measurement unit" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="unitMeasureId" type="text" name="unitMeasure" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                    <!-- end add sick cow modal -->
                </div>
            </div>
    </section>
</div>

<script>
    function updateRawMaterials(d) {
        
        console.log(d)

        $("#addRawMaterialsLabel").text("Update "+d.name)
        $("#rmId").val(d.id);
        $("#materialNameId").val(d.name);
        $("#unitPriceId").val(d.unit_price);
        $("#quantityId").val(d.quantity);
        $("#unitMeasureId").val(d.unit_measure);

        $("#addRawMaterials").modal("show");
    }
</script>