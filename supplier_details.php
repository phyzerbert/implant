<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Managements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        table td, table th {
            white-space: nowrap;
            overflow:hidden;
        }
        .box {
            width: 800px;
            margin: 0 auto;
        }

        .active_tab1 {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        .inactive_tab1 {
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }

        .has-error {
            border-color: #cc0000;
        }
        #editForm label {
            font-weight : 600;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</head>
<body>
    <?php
        require 'db.php';
        session_start();
        $message = '';

        if(isset($_GET['delete_id']) && $_GET['delete_id']) {
            $delete_id = $_GET['delete_id'];
            $query = "DELETE FROM suppliers WHERE id = $delete_id";
            if ($mysqli->query($query) === TRUE) {
                $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Deleted Successfully</div>';
            } else {
                $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Failed!</strong> Failed Delete;</div>';
            }
        }

        if(isset($_POST['edit_id']) && $_POST['edit_id']) {
            $edit_id = $_POST['edit_id'];
            $company_name = $_POST['company_name'];
            $company_number = $_POST['company_number'];
            $company_tax = $_POST['company_tax'];
            $company_vat = $_POST['company_vat'];
            $company_address = $_POST['company_address'];
            $postal_address = $_POST['postal_address'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $contact_address = $_POST['contact_address'];
            $contact_mobile_no = $_POST['contact_mobile_no'];
            $query = "UPDATE suppliers SET company_name = '$company_name' , company_number = '$company_number' , company_tax = '$company_tax' , company_vat = '$company_vat' , company_address = '$company_address' , postal_address = '$postal_address' , first_name = '$first_name' , last_name = '$last_name' , gender = '$gender' , contact_address = '$contact_address' , contact_mobile_no = '$contact_mobile_no' WHERE id = $edit_id";
            if ($mysqli->query($query) === TRUE) {
                $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Updated Successfully</div>';
            } else {
                $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Failed!</strong>Failed Update.</div>';
            }
        }

        $query = "SELECT * FROM suppliers";
        $result = $mysqli->query($query);

        $mysqli->close();
    ?>
    <div class="page container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mt-5 mb-3">Supplier Management</h2>
                <br />
                <?php echo $message; ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company Registered Name</th>
                                <th>Company Registered Number</th>
                                <th>Tax Registeration Number</th>
                                <th>Vat Registeration Number</th>
                                <th>Company Physical Address</th>
                                <th>Postal Address</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Mobile No</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) {
                                $i = 0;
                                while($row = $result->fetch_assoc()) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td class="company_name"><?php echo $row['company_name']; ?></td>
                                    <td class="company_number"><?php echo $row['company_number']; ?></td>
                                    <td class="company_tax"><?php echo $row['company_tax']; ?></td>
                                    <td class="company_vat"><?php echo $row['company_vat']; ?></td>
                                    <td class="company_address"><?php echo $row['company_address']; ?></td>
                                    <td class="postal_address"><?php echo $row['postal_address']; ?></td>
                                    <td class="first_name"><?php echo $row['first_name']; ?></td>
                                    <td class="last_name"><?php echo $row['last_name']; ?></td>
                                    <td class="gender"><?php echo $row['gender']; ?></td>
                                    <td class="contact_address"><?php echo $row['contact_address']; ?></td>
                                    <td class="contact_mobile_no"><?php echo $row['contact_mobile_no']; ?></td>
                                    <td class="py-2">
                                        <button class="btn btn-sm btn-info btn-edit" data-id="<?php echo $row['id']; ?>">Edit</button>
                                        <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-delete" onclick="return window.confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } } else { ?>
                                <tr>
                                    <td class="text-center" colspan="20">No Data</td>
                                </tr>
                            <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="post" id="editForm">
                    <input type="hidden" name="edit_id" class="id" />
                    <div class="modal-body">
                        <div class="px-3">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="list_company_details" data-toggle="tab" href="#company_details">Suppliers Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" id="list_supplier_details" href="#supplier_details">Company Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" id="list_contact_details" href="#contact_details">Contact Details</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="company_details" class="container tab-pane active"><br>
                                <div class="card">
                                    <div class="card-header">Company Details</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Company Registration Name</label>
                                            <input type="text" name="company_name" id="edit_company_name" class="form-control company_name" placeholder="Company Registration Name" />
                                            <span class="text-danger" id="edit_error_company_name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Company Registration Number</label>
                                            <input type="text" name="company_number" id="edit_company_number" class="form-control company_number" placeholder="Company Registration Number" />
                                            <span class="text-danger" id="edit_error_company_number"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tax Registeration Number</label>
                                            <input type="text" name="company_tax" id="edit_company_tax" class="form-control company_tax" placeholder="Tax Registeration Number" />
                                            <span class="text-danger" id="edit_error_company_tax"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Vat Registeration Number</label>
                                            <input type="text" name="company_vat" id="edit_company_vat" class="form-control company_vat" placeholder="Vat Registeration Number" />
                                            <span class="text-danger" id="edit_error_company_vat"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Company Physical Address</label>
                                            <input type="text" name="company_address" id="edit_company_address" class="form-control company_address" placeholder="Company Physical Address" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Postal Address</label>
                                            <input type="text" name="postal_address" id="edit_postal_address" class="form-control postal_address" placeholder="Postal Address" />
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" id="btn_company_details">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="supplier_details" class="container tab-pane fade"><br>
                                <div class="card">
                                    <div class="card-header">Supplier Details</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input type="text" name="first_name" id="edit_first_name" class="form-control first_name" placeholder="First Name" />
                                            <span class="text-danger" id="edit_error_first_name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input type="text" name="last_name" id="edit_last_name" class="form-control last_name" placeholder="Last Name" />
                                            <span class="text-danger" id="edit_error_last_name"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select name="gender" class="form-control gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" id="btn_prev_supplier_details">Prev</button>
                                            <button type="button" class="btn btn-primary ml-3" id="btn_supplier_details">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contact_details" class="container tab-pane fade"><br>
                                <div class="card">
                                    <div class="card-header">Contact Details</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="contact_address" id="edit_contact_address" class="form-control contact_address" placeholder="Address" />
                                            <span class="text-danger" id="edit_error_contact_address"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mobile No</label>
                                            <input type="text" name="contact_mobile_no" id="edit_contact_mobile_no" class="form-control contact_mobile_no" placeholder="Mobile No" />
                                            <span class="text-danger" id="edit_error_contact_mobile_no"></span>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" id="btn_prev_contact_details">Prev</button>
                                            <button type="button" class="btn btn-primary ml-3" id="btn_contact_details">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".btn-edit").click(function(){
                let id = $(this).data('id');
                let company_name = $(this).parents('tr').find('.company_name').text().trim();
                let company_number = $(this).parents('tr').find('.company_number').text().trim();
                let company_tax = $(this).parents('tr').find('.company_tax').text().trim();
                let company_vat = $(this).parents('tr').find('.company_vat').text().trim();
                let company_address = $(this).parents('tr').find('.company_address').text().trim();
                let postal_address = $(this).parents('tr').find('.postal_address').text().trim();
                let first_name = $(this).parents('tr').find('.first_name').text().trim();
                let last_name = $(this).parents('tr').find('.last_name').text().trim();
                let gender = $(this).parents('tr').find('.gender').text().trim();
                let contact_address = $(this).parents('tr').find('.contact_address').text().trim();
                let contact_mobile_no = $(this).parents('tr').find('.contact_mobile_no').text().trim();

                $("#editForm .id").val(id);
                $("#editForm .company_name").val(company_name);
                $("#editForm .company_number").val(company_number);
                $("#editForm .company_tax").val(company_tax);
                $("#editForm .company_vat").val(company_vat);
                $("#editForm .company_address").val(company_address);
                $("#editForm .postal_address").val(postal_address);
                $("#editForm .first_name").val(first_name);
                $("#editForm .last_name").val(last_name);
                $("#editForm .gender").val(gender);
                $("#editForm .contact_address").val(contact_address);
                $("#editForm .contact_mobile_no").val(contact_mobile_no);


                $("#editModal").modal();
            });

            $('#btn_company_details').click(function() {

                var error_company_name = '';
                var error_company_number = '';
                var filter = /^[A-Za-z0-9 _]+$/;
                if ($.trim($('#edit_company_name').val()).length == 0) {
                    error_company_name = 'Company is required';
                    $('#edit_error_company_name').text(error_company_name);
                    $('#edit_company_name').addClass('has-error');
                } else {
                    if (!filter.test($('#edit_company_name').val())) {
                        error_company_name = 'Invalid company name';
                        $('#edit_error_company_name').text(error_company_name);
                        $('#edit_company_name').parent().addClass('has-error');
                    } else {
                        error_company_name = '';
                        $('#edit_error_company_name').text(error_company_name);
                        $('#edit_company_name').removeClass('has-error');
                    }
                }

                if ($.trim($('#edit_company_number').val()).length == 0) {
                    error_company_number = 'Company number is required';
                    $('#edit_error_company_number').text(error_company_number);
                    $('#edit_company_number').addClass('has-error');
                } else {
                    error_company_number = '';
                    $('#edit_error_company_number').text(error_company_number);
                    $('#edit_company_number').removeClass('has-error');
                }

                if (error_company_name != '' || error_company_number != '') {
                    return false;
                } else {
                    $('#list_company_details').removeClass('active active_tab1');
                    $('#list_company_details').removeAttr('href data-toggle');
                    $('#company_details').removeClass('active');
                    $('#list_company_details').addClass('inactive_tab1');
                    $('#list_supplier_details').removeClass('inactive_tab1');
                    $('#list_supplier_details').addClass('active_tab1 active');
                    $('#list_supplier_details').attr('href', '#supplier_details');
                    $('#list_supplier_details').attr('data-toggle', 'tab');
                    $('#supplier_details').addClass('active show');
                }
            });

            $('#btn_prev_supplier_details').click(function() {
                $('#list_supplier_details').removeClass('active active_tab1');
                $('#list_supplier_details').removeAttr('href data-toggle');
                $('#supplier_details').removeClass('active in');
                $('#list_supplier_details').addClass('inactive_tab1');
                $('#list_company_details').removeClass('inactive_tab1');
                $('#list_company_details').addClass('active_tab1 active');
                $('#list_company_details').attr('href', '#company_details');
                $('#list_company_details').attr('data-toggle', 'tab');
                $('#company_details').addClass('active show');
            });

            $('#btn_supplier_details').click(function() {
                var error_first_name = '';
                var error_last_name = '';

                if ($.trim($('#edit_first_name').val()).length == 0) {
                    error_first_name = 'First Name is required';
                    $('#edit_error_first_name').text(error_first_name);
                    $('#edit_first_name').addClass('has-error');
                } else {
                    error_first_name = '';
                    $('#edit_error_first_name').text(error_first_name);
                    $('#edit_first_name').removeClass('has-error');
                }

                if ($.trim($('#edit_last_name').val()).length == 0) {
                    error_last_name = 'Last Name is required';
                    $('#edit_error_last_name').text(error_last_name);
                    $('#edit_last_name').addClass('has-error');
                } else {
                    error_last_name = '';
                    $('#edit_error_last_name').text(error_last_name);
                    $('#edit_last_name').removeClass('has-error');
                }

                if (error_first_name != '' || error_last_name != '') {
                    return false;
                } else {
                    $('#list_supplier_details').removeClass('active active_tab1');
                    $('#list_supplier_details').removeAttr('href data-toggle');
                    $('#supplier_details').removeClass('active');
                    $('#list_supplier_details').addClass('inactive_tab1');
                    $('#list_contact_details').removeClass('inactive_tab1');
                    $('#list_contact_details').addClass('active_tab1 active');
                    $('#list_contact_details').attr('href', '#contact_details');
                    $('#list_contact_details').attr('data-toggle', 'tab');
                    $('#contact_details').addClass('active show');
                }
            });

            $('#btn_prev_contact_details').click(function() {
                $('#list_contact_details').removeClass('active active_tab1');
                $('#list_contact_details').removeAttr('href data-toggle');
                $('#contact_details').removeClass('active in');
                $('#list_contact_details').addClass('inactive_tab1');
                $('#list_supplier_details').removeClass('inactive_tab1');
                $('#list_supplier_details').addClass('active_tab1 active');
                $('#list_supplier_details').attr('href', '#supplier_details');
                $('#list_supplier_details').attr('data-toggle', 'tab');
                $('#supplier_details').addClass('active show');
            });

            $('#btn_contact_details').click(function() {
                var error_address = '';
                var error_mobile_no = '';
                var mobile_validation = /^\d{10}$/;
                if ($.trim($('#edit_contact_address').val()).length == 0) {
                    error_address = 'Address is required';
                    $('#edit_error_contact_address').text(error_address);
                    $('#edit_contact_address').addClass('has-error');
                } else {
                    error_address = '';
                    $('#edit_error_contact_address').text(error_address);
                    $('#edit_contact_address').removeClass('has-error');
                }

                if ($.trim($('#edit_contact_mobile_no').val()).length == 0) {
                    error_mobile_no = 'Mobile Number is required';
                    $('#edit_error_contact_mobile_no').text(error_mobile_no);
                    $('#edit_error_contact_mobile_no').addClass('has-error');
                } else {
                    if (!mobile_validation.test($('#edit_contact_mobile_no').val())) {
                        error_mobile_no = 'Invalid Mobile Number';
                        $('#edit_error_contact_mobile_no').text(error_mobile_no);
                        $('#edit_contact_mobile_no').addClass('has-error');
                    } else {
                        error_mobile_no = '';
                        $('#edit_error_contact_mobile_no').text(error_mobile_no);
                        $('#edit_contact_mobile_no').removeClass('has-error');
                    }
                }
                console.log(error_address, error_mobile_no);
                if (error_address != '' || error_mobile_no != '') {
                    return false;
                } else {
                    $('#btn_contact_details').attr("disabled", "disabled");
                    $(document).css('cursor', 'prgress');
                    $("#editForm").submit();
                }
            });
        });
    </script>
</body>
</html>