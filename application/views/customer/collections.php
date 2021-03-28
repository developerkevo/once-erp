<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Collections" ?></h1>
            <small><?php echo "Manage Collections" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li class="active"><a href="#"><?php echo "Cows" ?></a></li>

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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addCollectionModal"><i class="ti-plus"> </i> <?php echo "Add Collection" ?> </button>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('Ccustomer/customer_contribution_filter', array('class' => '', 'id' => 'validate')) ?>
                        <?php $today = date('Y-m-d'); ?>
                

                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label for="froute" class="col-sm-4 col-form-label"><?php echo display('route') ?></label>
                                <div class="col-sm-8">
                                    <select name="route" class="form-control" id="froute">
                                        <option value=""></option>
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

                        <div class="col-sm-3">
                            <div class="form-group row">
                                <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer') ?></label>
                                <div class="col-sm-8">
                                    <select name="customer_id" class="form-control" id="customer_name">
                                        <option value=""></option>
                                        <?php
                                        foreach ($farmers as $f) { ?>
                                            <option value="<?php echo $f->customer_id ?>"> <?php echo $f->customer_name ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="from_date " class="col-sm-2 col-form-label"> <?php echo display('from') ?></label>
                                <div class="col-sm-4    ">
                                    <input type="text" name="from_date" class="datepicker form-control" id="from_date" />
                                </div>
                                <label for="to_date" class="col-sm-2 col-form-label"> <?php echo display('to') ?></label>
                                <div class="col-sm-4">
                                    <input type="text" name="to_date" class="datepicker form-control" id="to_date" />
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success "><i class="fa fa-search-plus" aria-hidden="true"></i> <?php echo display('search') ?></button>
                            <!-- <button type="button" class="btn btn-warning" onclick="printDiv('printableArea')"><?php echo display('print') ?></button> -->


                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Manage Collections report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Collections" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0" id="routeList">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Farmer'; ?></th>
                                        <th><?php echo 'ID No'; ?></th>
                                        <th><?php echo 'Member No'; ?></th>
                                        <th><?php echo 'Route'; ?></th>
                                        <th><?php echo 'Period'; ?></th>
                                        <th><?php echo 'Volume'; ?></th>
                                        <th><?php echo 'BP'; ?></th>
                                        <th><?php echo 'Total'; ?></th>
                                        <th><?php echo 'SP'; ?></th>
                                        <th><?php echo 'Total'; ?></th>
                                        <th><?php echo 'Profit'; ?></th>
                                        <th><?php echo 'Date'; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($collections as $key => $c) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $c->customer_name; ?></td>
                                            <td><?php echo $c->customer_mobile; ?></td>
                                            <td><?php echo $c->contact; ?></td>
                                            <td><?php echo $c->route; ?></td>
                                            <td><?php echo $c->period; ?></td>
                                            <td><?php echo $c->volume . "ltrs"; ?></td>
                                            <td><?php echo "KSH. " . $c->buying_price; ?></td>
                                            <td><?php echo "KSH. " . number_format($c->volume * $c->buying_price, 2, '.', ','); ?></td>
                                            <td><?php echo "KSH" . $c->selling_price; ?></td>
                                            <td><?php echo "KSH. " . number_format($c->volume * $c->selling_price, 2, '.', ','); ?></td>
                                            <td><?php echo "KSH. " . number_format(($c->volume * $c->selling_price) - ($c->volume * $c->buying_price), 2, '.', ','); ?></td>
                                            <td><?php echo $c->collection_time; ?></td>
                                        </tr>

                        </div>
                    <?php  } ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <strong>Total Collections</strong>
                            </td>
                            <td colspan="3">
                                <?php echo "<strong>" . count($collections) . "</strong>"; ?>
                            </td>
                        </tr>
                    </tfoot>

                    </table>

                    </div>
                </div>

                <!-- add Modal -->
                <div class="modal fade" id="addCollectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php echo form_open_multipart('Ccustomer/add_collection/', array('id' => 'add collection', "method" => 'post')) ?>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Collection</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="panel-body">
                                <div class="row">


                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="route" class="form-label col-sm-12"><?php echo "Route" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="route" id="route" tabindex="-1" aria-hidden="true" style="width:100%;">
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
                                        <div class="form-group row">
                                            <label for="farmer" class="form-label col-sm-12"><?php echo "Farmer" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="farmer" id="farmer" style="width:100%;">
                                                    <?php
                                                    foreach ($farmers as $f) { ?>
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
                                            <label for="volume" class="form-label"><?php echo "Volume" ?> <i class="text-danger">*</i></label>
                                            <input class="form-control" name="volume" id="volume" type="number" placeholder="<?php echo '10' ?>" required="" tabindex="1">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="bp" class="form-label"><?php echo "Buying Price" ?> <i class="text-danger">*</i></label>
                                            <input class="form-control" name="bp" id="bp" type="text" required="" tabindex="1">
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="sp" class="form-label"><?php echo "Selling Price" ?> <i class="text-danger">*</i></label>
                                            <input class="form-control" name="sp" id="sp" type="text" required="" tabindex="1">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="period" class="form-label col-sm-12"><?php echo "Period" ?> <i class="text-danger">*</i></label>
                                            <div class="col-sm-12">
                                                <select class="form-control" name="period" id="period" style="width:100%;">

                                                    <option value="Morning">Morning</option>
                                                    <option value="Evening">Evening</option>

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
                    <!-- end add modal -->
                </div>
            </div>
        </div>

        <!-- <div class="row">

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
        </div> -->
    </section>
</div>

<!-- <script src="<?php echo base_url() ?>assets/js/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/canvasjs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/herdManagement.js" type="text/javascript"></script> -->