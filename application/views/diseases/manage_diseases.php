<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Diseases" ?></h1>
            <small><?php echo "Manage Diseases" ?></small>
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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addDisease"><i class="ti-plus"> </i> <?php echo "Add Disease" ?> </button>
                <button class="btn btn-primary m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addSickCow"><i class="ti-plus"> </i> <?php echo "Add Sick Cow" ?> </button>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('Cdisease/manage_diseases', array('class' => 'form-inline', "method" => "post")) ?>

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
        </div>


        <!-- Manage Diseases report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Diseases" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Farmer'; ?></th>
                                        <th><?php echo 'Cow\'s Breed'; ?></th>
                                        <th><?php echo 'Cow\'s Age'; ?></th>
                                        <th><?php echo 'Disease'; ?></th>
                                        <th><?php echo 'Status'; ?></th>
                                        <th><?php echo 'Update Status'; ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sick_cows as $key => $sc) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $sc->farmer; ?></td>
                                            <td><?php echo $sc->breed_name; ?></td>
                                            <td><?php echo $sc->age."yrs"; ?></td>
                                            <td><?php echo $sc->name; ?></td>
                                            <td><?php echo $sc->status; ?></td>                                        
                                            <td>
                                                <button class="btn btn-xs btn-primary" onclick='updateCowStatus(<?php echo json_encode($sc); ?>)'>
                                                    Update Status
                                                </button>
                                            </td>

                                        </tr>
                                    <?php  } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <strong>Total Affected Cows</strong>
                                        </td>
                                        <td colspan="3">
                                            <?php echo "<strong>" . count($sick_cows) . "</strong>"; ?>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!-- add sick cow Modal -->
                    <div class="modal fade" id="addSickCow" tabindex="-1" role="dialog" aria-labelledby="addSickCowLable" aria-hidden="true">
                        <?php echo form_open_multipart('Cdisease/add_sick_cow/', array('id' => 'add_sick_cow', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addSickCowLable">Add Sick Cow</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="diseaseName" class="form-label col-sm-12"><?php echo "Disease Name" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="disease_id" id="diseaseName" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($diseases as $d) {
                                                        ?>
                                                            <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="cowDetails" class="form-label col-sm-12"><?php echo "Cow Details" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="cow_id" id="cowDetails" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($cows as $c) {
                                                        ?>
                                                            <option value="<?php echo $c->id ?>"><?php echo $c->farmer." - ".$c->breed_name; ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                    </div>
                    <!-- end add sick cow modal -->



                    <!-- edit Modal -->
                    <div class="modal fade" id="updateSickCowStatus" tabindex="-1" role="dialog" aria-labelledby="updateSickCowStatusLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cvet/update_booking_status/', array('id' => 'edit_booking', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateSickCowStatusLabel">Update Sick Cow Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <input class="form-control" id="bid" name="bid" type="hidden" readonly tabindex="1">
                                        <input class="form-control" id="vetid" name="vet_id" type="hidden" readonly tabindex="1">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bfarmer" class="form-label"><?php echo "Farmer" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="bfarmer" type="text" readonly tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="vet" class="form-label"><?php echo "Vet Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="bvet" type="text" readonly tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bsc" class="form-label"><?php echo "Current Semen Count" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="bsc" type="text" readonly tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="customer" class="form-label col-sm-12"><?php echo "Status" ?> <i class="text-danger">*</i> <span id="cStatus"></span></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="status" id="bupdateStatus" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <option value="Pending" selected>Pending</option>
                                                        <option value="Cancelled">Cancelled</option>
                                                        <option value="Done">Done</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="date" class="form-label"><?php echo "Semen Used" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="semenUsed" name="semen_used" type="number" tabindex="1" required>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                    <!-- end edit  Booking modal -->



                    <!-- add Modal -->
                    <div class="modal fade" id="addDisease" tabindex="-1" role="dialog" aria-labelledby="addDieseaseModal" aria-hidden="true">
                        <?php echo form_open_multipart('Cdisease/add_disease/', array('id' => 'add_disease', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addDieseaseModal">Add Disease</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="disease" class="form-label"><?php echo "Diesease Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="disease" id="disease" type="text" required="" tabindex="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                    <!-- end add  Booking modal -->




                    <!-- update status Modal -->
                    <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cdisease/update_cow_disease_status/', array('id' => 'update_cow_disease_status', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStatusModalLabel">Cow Sickeness Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                    <div class="col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control" name="id" id="uid" type="hidden" required="" tabindex="1" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="disease" class="form-label"><?php echo "Farmer's Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="ufarmer" id="ufarmer" type="text" required="" tabindex="1" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="disease" class="form-label"><?php echo "Breed of Cow" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="ubreed" id="ubreed" type="text" required="" tabindex="1" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="disease" class="form-label"><?php echo "Diesease Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="udisease" id="udisease" type="text" required="" tabindex="1" readonly>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="cowStatus" class="form-label col-sm-12"><?php echo "Status" ?> <i class="text-danger">*</i> <span id="cowStatusLabel"></span></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="cowStatus" id="cowStatus" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <option value="Died">Died</option>
                                                        <option value="Sick">Sick</option>
                                                        <option value="Improving">Improving</option>
                                                        <option value="Healed">Healed</option>
                                                    </select>
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
                            <?php echo form_close() ?>
                        </div>
                    </div>
                    <!-- end add  Booking modal -->


                </div>
            </div>
    </section>
</div>

<script>
    function updateCowStatus(d) {

        $("#ufarmer").val(d.farmer);
        $("#ubreed").val(d.breed_name);
        $("#udisease").val(d.name);
        $("#uid").val(d.id);

        $("#updateStatusModal").modal("show");
    }
</script>