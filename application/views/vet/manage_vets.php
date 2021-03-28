<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Vet" ?></h1>
            <small><?php echo "Manage Vet" ?></small>
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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addVetModal"><i class="ti-plus"> </i> <?php echo "Add Vet" ?> </button>
            </div>
        </div>


        <!-- Manage Vet report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Vet" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Name'; ?></th>
                                        <th><?php echo 'Location'; ?></th>
                                        <th><?php echo 'phone'; ?></th>
                                        <th><?php echo 'ID No.'; ?></th>
                                        <th><?php echo 'Route'; ?></th>
                                        <th><?php echo 'Semen'; ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vets as $key => $v) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $v->name; ?></td>
                                            <td><?php echo $v->location; ?></td>
                                            <td><?php echo $v->phone; ?></td>
                                            <td><?php echo $v->id_no; ?></td>
                                            <td><?php echo $v->route_name; ?></td>
                                            <td><?php echo $v->semen_count; ?></td>
                                            <td>
                                                <button type="button" onclick="loadBookings(this.id)" class="btn btn-primary btn-xs bookingBtns" id="bookingButton_<?php echo $v->id; ?>" data-placement="left" data-toggle="modal" data-target="#bookingseModal<?php echo $v->id; ?>">
                                                    <span><?php echo "View Bookings" ?></span>

                                                </button>
                                            </td>
                                        </tr>


                                        <!-- booking Modal -->
                                        <div class="modal fade" id="bookingseModal<?php echo $v->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $v->id; ?>"" aria-hidden=" true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel<?php echo $v->id; ?>"><?php echo "Booking Summery For $v->name"; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">

                                                            <div class="col-sm-12 bookingContent" id= "printTable<?php echo $v->id; ?>">

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" onclick='printDiv("printTable<?php echo $v->id; ?>")'>Print</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end booking  modal -->
                                    <?php  } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <strong>Total Vets</strong>
                                        </td>
                                        <td colspan="4">
                                            <?php echo "<strong>" . count($vets) . "</strong>"; ?>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!-- add Modal -->
                    <div class="modal fade" id="addVetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cvet/add_vet/', array('id' => 'add_vet', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Vet</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label"><?php echo "Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="name" id="name" type="text" required="" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="location" class="form-label"><?php echo "Location" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="location" id="location" type="text" required="" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="id" class="form-label"><?php echo "ID No." ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="id" id="id" type="number" required="" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone" class="form-label"><?php echo "Phone" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="phone" id="phone" type="text" required="" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="route" class="form-label col-sm-12"><?php echo "Route" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="route_id" id="route" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($routes as $r) { ?>
                                                            <option value="<?php echo $r->id ?>"> <?php echo $r->name ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="semen_count" class="form-label"><?php echo "Semen count (units)" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="semen_count" id="semen_count" type="text" required="" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bp" class="form-label"><?php echo "Semen Unit Buying Price" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="bp" id="bp" type="text" required="" tabindex="1">
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="sp" class="form-label"><?php echo "Semen Unit Selling Price" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" name="sp" id="sp" type="text" required="" tabindex="1">
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
                    <!-- end add  modal form -->
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

                                <input type="hidden" id="vets_by_semen_count_data" value="<?php echo html_escape($vets_by_semen_count_data); ?>">
                                <input type="hidden" id="vets_by_semen_count_label" value="<?php echo html_escape($vets_by_semen_count_label); ?>">
                                <canvas id="vetSemenSummery" width="600" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <input type="hidden" id="vets_by_route_data" value="<?php echo html_escape($vets_by_route_data); ?>">
                                <input type="hidden" id="vets_by_route_label" value="<?php echo html_escape($vets_by_route_label); ?>">
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
<script src="<?php echo base_url() ?>assets/js/vetManagement.js" type="text/javascript"></script>

<script>
    function loadBookings(id) {

        let vetId = id.split("_")[1]
        $("#vetIdInput").val(vetId)
        let html = `<div class="table-responsive">`;

        html += `<table class="table table-striped table-bordered t-dt" id="vetBookings` + vetId + `"> 
        <thead>
            <th></th>
            <th>Farmer</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Semen Used</th>
            <th>Total Charges</th>
        </thead>`


        var base_url = $("#base_url").val();

        $.ajax({
            url: base_url + "Cvet/bookings/" + vetId,
            type: "GET",
            success: function(data) {
                html += `<tbody>`

                data.forEach((d, index) => {

                    let total_charges = new Intl.NumberFormat().format(parseFloat(d.charges) + parseFloat((d.semen_sp * d.semen_used)));

                    html += `<tr>
                <td>${++index}</td>
                <td>${d.customer_name}</td>
                <td>${d.date}</td>
                <td>${d.status}</td>
                <td>${d.semen_used}</td>           
                <td> Ksh. ${total_charges}</td>           
            </tr>`
                });


                html += `</tbody>`

                html += ` </table>`;
                html += `</div>`

                $('.bookingContent').empty()
                $('.bookingContent').append(html)


            },

            error: function(errorThrown) {
                console.log(errorThrown)
            }




        });


    }
</script>