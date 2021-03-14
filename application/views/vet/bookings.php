<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Bookings" ?></h1>
            <small><?php echo "Manage Bookings" ?></small>
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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addVetModal"><i class="ti-plus"> </i> <?php echo "Add Booking" ?> </button>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('Cvet/manage_bookings', array('class' => 'form-inline', "method"=>"post")) ?>
                    
                        <div class="form-group">
                            <select class="form-control" name="fstatus" style="width: 150px;">
                                <option value="All">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success btn-md"><?php echo "Filter By Status" ?></button>

                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Manage Bookings report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Bookings" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Customer'; ?></th>
                                        <th><?php echo 'Vet Name'; ?></th>
                                        <th><?php echo 'Date'; ?></th>
                                        <th><?php echo 'Status'; ?></th>
                                        <th><?php echo 'Semen Used'; ?></th>
                                        <th><?php echo 'Update Status'; ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $key => $b) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $b->customer_name; ?></td>
                                            <td><?php echo $b->vet_name; ?></td>
                                            <td><?php echo $b->date; ?></td>
                                            <td><?php echo $b->status; ?></td>
                                            <td><?php echo $b->semen_used; ?></td>
                                            <td><button class="btn btn-xs btn-primary" onclick='updateBooking(<?php echo json_encode($b); ?>)'>Update Status</button></td>
                                            <!-- <td>
                                              
                                            </td> -->
                                        </tr>
                                    <?php  } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <strong>Total Bookings</strong>
                                        </td>
                                        <td colspan="3">
                                            <?php echo "<strong>" . count($bookings) . "</strong>"; ?>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!-- edit Modal -->
                    <div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cvet/update_booking_status/', array('id' => 'edit_booking', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Booking Status</h5>
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
                    <div class="modal fade" id="addVetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cvet/add_booking/', array('id' => 'add_booking', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Booking</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="customer" class="form-label col-sm-12"><?php echo "Farmer Name" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="customer" id="customer" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($customers as $c) { ?>
                                                            <option value="<?php echo $c->customer_id ?>"> <?php echo $c->customer_name ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="vet" class="form-label col-sm-12"><?php echo "Vet Name" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="vet_id" id="vet" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($vets as $v) { ?>
                                                            <option value="<?php echo $v->id ?>"> <?php echo $v->name ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="date" class="form-label"><?php echo "Booking Date" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control datepicker" name="date" id="date" type="text" required="" tabindex="1">
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
    function updateBooking(b) {
        $("#bfarmer").val(b.customer_name);
        $("#bvet").val(b.vet_name);
        $("#bupdateStatus").val(b.status);
        $("#cStatus").text('(' + b.status + ')')
        $("#bid").val(b.id);
        $("#vetid").val(b.vet_id);
        $("#bsc").val(b.semen_count);
        $("#editBookingModal").modal();
    }
</script>