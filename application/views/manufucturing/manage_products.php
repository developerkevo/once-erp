<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo "Manage Products" ?></h1>
            <small><?php echo "Manage Products" ?></small>
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
                <button class="btn btn-info m-b-5 m-r-2" data-placement="left" data-toggle="modal" data-target="#addProducts"><i class="ti-plus"> </i> <?php echo "Add Products" ?> </button>

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


        <!-- Manage Products report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo "Manage Products" ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered t-dt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo 'Product'; ?></th>
                                        <th><?php echo 'Unit Price'; ?></th>
                                        <th><?php echo 'Units'; ?></th>
                                        <th><?php echo 'Action'; ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $key => $p) {
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $p->name; ?></td>
                                            <td><?php echo "Ksh. " . $p->unit_price . " per " . $p->measurement_unit; ?></td>
                                            <td><?php echo $p->target_quantity; ?></td>
                                            <td>
                                                <button class="btn btn-xs btn-primary" onclick='updatePrduct(<?php echo json_encode($p); ?>)'>
                                                    Update Product
                                                </button>

                                                <button class="btn btn-xs btn-info" onclick='productDetailsModal(<?php echo $p->id; ?>)'>
                                                    Details
                                                </button>

                                                <button class="btn btn-xs btn-success" onclick='getRawMaterials(<?php echo json_encode($p); ?>)'>
                                                    Add Raw Materials
                                                </button>
                                            </td>

                                        </tr>
                                    <?php  } ?>

                                </tbody>

                            </table>

                        </div>
                    </div>

                    <!-- add update Modal -->
                    <div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="addProductsLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cmanufucturing/add_products/', array('id' => 'add_products', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductsLabel">Add Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <input class="form-control" id="pId" type="hidden" name="id" readonly tabindex="1">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="productNameId" class="form-label"><?php echo "Product Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="productNameId" type="text" name="productName" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="measurementUnitId" class="form-label"><?php echo "Measurement Unit" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="measurementUnitId" type="text" name="measurementUnit" tabindex="1">
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
                                                <label for="quantityId" class="form-label"><?php echo "Units" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="quantityId" type="number" name="targetQuantity" tabindex="1">
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
                    <!-- end add update modal -->


                    <!-- assign raw materails to products -->
                    <div class="modal fade" id="addProductMaterials" tabindex="-1" role="dialog" aria-labelledby="addProductsMaterialLabel" aria-hidden="true">
                        <?php echo form_open_multipart('Cmanufucturing/add_product_details/', array('id' => 'add_product_details', "method" => 'post')) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductsMaterialLabel">Assign Raw Materials to Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <input class="form-control" id="pId2" type="hidden" name="id" readonly tabindex="1">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="productNameId2" class="form-label"><?php echo "Product Name" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="productNameId2" type="text" name="productName" tabindex="1">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="rm" class="form-label col-sm-12"><?php echo "Raw Material" ?> <i class="text-danger">*</i></label>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="rmid" id="rm" tabindex="-1" aria-hidden="true" style="width:100%;">
                                                        <?php
                                                        foreach ($raw_materials as $r) { ?>
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
                                                <label for="qid" class="form-label"><?php echo "Units Used" ?> <i class="text-danger">*</i></label>
                                                <input class="form-control" id="qid" type="number" name="pq" tabindex="1">
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
                    <!-- end materails to products -->



                    <!-- add update Modal -->
                    <div class="modal fade" id="productDetails" tabindex="-1" role="dialog" aria-labelledby="productDetailsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productDetailsLabel">Product Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="productDetailsSection">

                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end add update modal -->



                </div>
            </div>
    </section>
</div>

<script>
    function updatePrduct(d) {

        $("#addProductsLabel").text("Update " + d.name)
        $("#pId").val(d.id);
        $("#productNameId").val(d.name);
        $("#unitPriceId").val(d.unit_price);
        $("#quantityId").val(d.target_quantity);
        $("#measurementUnitId").val(d.measurement_unit);
        $("#addProducts").modal("show");
    }




    function productDetailsModal(id) {

        let html = `<div class="table-responsive">`;

        html += `<table class="table table-striped table-bordered t-dt" id="rawMaterials` + id + `"> 
                        <thead>
                            <th></th>
                            <th>Material Name</th>
                            <th>Available Quantity</th>
                            <th>Used Quantity</th>
                            <th>Unit Price</th>
                            <th>Units</th>
                            <th>Total Cost</th>
                        </thead>`


        var base_url = $("#base_url").val();

        $.ajax({
            url: base_url + "Cmanufucturing/get_product_raw_materials/" + id,
            type: "GET",
            success: function(data) {

                data = JSON.parse(data);
                html += `<tbody>`
                let totalExpenditure = 0;
                data.forEach((d, index) => {

                    html += `<tr>
                                    <td>${++index}</td>
                                    <td>${d.raw_material}</td>
                                    <td>${d.material_quantity}</td>
                                    <td>${d.used_quantity}</td>
                                    <td>${d.material_unit_price}</td>        
                                    <td>${d.raw_material_unit_measure}</td>        
                                    <td>Ksh. ${ new Intl.NumberFormat().format(d.used_quantity * d.material_unit_price)}</td>        
                                </tr>`

                    totalExpenditure += d.used_quantity * d.material_unit_price
                });

                console.log(totalExpenditure)


                html += `</tbody>`

                html += ` </table>`;
                html += `</div>`

                html += `<div class="mt-2">`
                html += `<h3> Total Cost Ksh. ${ new Intl.NumberFormat().format(totalExpenditure)}</h3>`
                html += `</div>`

                $('#productDetailsSection').empty()
                $('#productDetailsSection').append(html)
                $('#productDetails').modal("show")


            },

            error: function(errorThrown) {
                console.log(errorThrown)
            }

        });
    }

    function getRawMaterials(d) {

        $("#pId2").val(d.id);
        $("#productNameId2").val(d.name);
        $("#addProductMaterials").modal("show");
    }
</script>