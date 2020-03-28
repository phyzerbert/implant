<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Register Supplier</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

        <style>
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
                background-color: #ffff99;
            }
        </style>
    </head>

    <body>

        <?php
            require 'db.php';
            session_start();

            $message='';
            if(isset($_POST["supplier_register"])) {
                sleep(5);

                $query = "INSERT INTO suppliers (company_name, company_number, company_tax, company_vat, company_address, postal_address, first_name, last_name, gender, contact_address, contact_mobile_no)
                        VALUES ('".$_POST["company_name"]."','".$_POST["company_number"]."','".$_POST["company_tax"]."','".$_POST["company_vat"]."','".$_POST["company_address"]."','".$_POST["postal_address"]."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["gender"]."','".$_POST["contact_address"]."','".$_POST["contact_mobile_no"]."')";

                if ($mysqli->query($query) === TRUE) {
                    $message='<div class="alert alert-success"> Registration Completed Successfully </div> ';
                } else {
                    // echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
                    $message='<div class="alert alert-success"> There is an error in Registration </div> ';
                }

                $mysqli->close();
            }
        ?>
        <br />
        <div class="container box">
            <br />
            <h2 align="center">Supplier Registration</h2>
            <br />
            <?php echo $message; ?>
            <form method="post" id="register_form">
                <input type="hidden" name="supplier_register" value="1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Suppliers Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Company Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Contact Details</a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-top:16px;">
                    <div class="tab-pane active" id="login_details">
                        <div class="panel panel-default">
                            <div class="panel-heading">Company Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Company Registered Name</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" autofocus />
                                    <span id="error_company_name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Company Registered Number</label>
                                    <input type="text" name="company_number" id="company_number" class="form-control" />
                                    <span id="error_company_number" class="text-danger"></span>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label>Tax Registeration Number</label>
                                    <input type="text" name="company_tax" id="company_tax" class="form-control" />
                                    <span id="error_company_tax" class="text-danger"></span>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label>Vat Registeration Number</label>
                                    <input type="text" name="company_vat" id="company_vat" class="form-control" />
                                    <span id="error_company_vat" class="text-danger"></span>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label>Company Physical Address</label>
                                    <textarea name="company_address" class="form-control" id="company_address"></textarea>
                                    <span id="error_company_address" class="text-danger"></span>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label>Postal Address</label>
                                    <input type="text" name="postal_address" id="postal_address" class="form-control" />
                                    <span id="error_postal_address" class="text-danger"></span>
                                </div>
                                <br />

                                <div align="center">
                                    <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="personal_details">
                        <div class="panel panel-default">
                            <div class="panel-heading">Company Contact Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Enter First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" />
                                    <span id="error_first_name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Enter Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" />
                                    <span id="error_last_name" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="male" checked> Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="female"> Female
                                    </label>
                                </div>
                                <br />
                                <div align="center">
                                    <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact_details">
                        <div class="panel panel-default">
                            <div class="panel-heading">Fill Contact Details</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Enter Address</label>
                                    <textarea name="contact_address" id="contact_address" class="form-control"></textarea>
                                    <span id="error_contact_address" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Enter Mobile No.</label>
                                    <input type="text" name="contact_mobile_no" id="contact_mobile_no" class="form-control" />
                                    <span id="error_contact_mobile_no" class="text-danger"></span>
                                </div>
                                <br />
                                <div align="center">
                                    <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    <script>
        $(document).ready(function() {
            $('#btn_login_details').click(function() {

                var error_company_name = '';
                var error_company_number = '';
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if ($.trim($('#company_name').val()).length == 0) {
                    error_email = 'Company is required';
                    $('#error_company_name').text(error_email);
                    $('#company_name').addClass('has-error');
                } else {
                    if (!filter.test($('#company_name').val())) {
                        error_email = 'Invalid company_name';
                        $('#error_company_name').text(error_email);
                        $('#company_name').addClass('has-error');
                    } else {
                        error_company_name = '';
                        $('#error_company_name').text(error_company_name);
                        $('#company_name').removeClass('has-error');
                    }
                }

                if ($.trim($('#company_number').val()).length == 0) {
                    error_password = 'Company number is required';
                    $('#error_company_number').text(error_company_number);
                    $('#company_number').addClass('has-error');
                } else {
                    error_company_number = '';
                    $('#error_company_number').text(error_company_number);
                    $('#company_number').removeClass('has-error');
                }

                if (error_company_name != '' || error_company_number != '') {
                    return false;
                } else {
                    $('#list_login_details').removeClass('active active_tab1');
                    $('#list_login_details').removeAttr('href data-toggle');
                    $('#login_details').removeClass('active');
                    $('#list_login_details').addClass('inactive_tab1');
                    $('#list_personal_details').removeClass('inactive_tab1');
                    $('#list_personal_details').addClass('active_tab1 active');
                    $('#list_personal_details').attr('href', '#personal_details');
                    $('#list_personal_details').attr('data-toggle', 'tab');
                    $('#personal_details').addClass('active in');
                }
            });

            $('#previous_btn_personal_details').click(function() {
                $('#list_personal_details').removeClass('active active_tab1');
                $('#list_personal_details').removeAttr('href data-toggle');
                $('#personal_details').removeClass('active in');
                $('#list_personal_details').addClass('inactive_tab1');
                $('#list_login_details').removeClass('inactive_tab1');
                $('#list_login_details').addClass('active_tab1 active');
                $('#list_login_details').attr('href', '#login_details');
                $('#list_login_details').attr('data-toggle', 'tab');
                $('#login_details').addClass('active in');
            });

            $('#btn_personal_details').click(function() {
                var error_first_name = '';
                var error_last_name = '';

                if ($.trim($('#first_name').val()).length == 0) {
                    error_first_name = 'First Name is required';
                    $('#error_first_name').text(error_first_name);
                    $('#first_name').addClass('has-error');
                } else {
                    error_first_name = '';
                    $('#error_first_name').text(error_first_name);
                    $('#first_name').removeClass('has-error');
                }

                if ($.trim($('#last_name').val()).length == 0) {
                    error_last_name = 'Last Name is required';
                    $('#error_last_name').text(error_last_name);
                    $('#last_name').addClass('has-error');
                } else {
                    error_last_name = '';
                    $('#error_last_name').text(error_last_name);
                    $('#last_name').removeClass('has-error');
                }

                if (error_first_name != '' || error_last_name != '') {
                    return false;
                } else {
                    $('#list_personal_details').removeClass('active active_tab1');
                    $('#list_personal_details').removeAttr('href data-toggle');
                    $('#personal_details').removeClass('active');
                    $('#list_personal_details').addClass('inactive_tab1');
                    $('#list_contact_details').removeClass('inactive_tab1');
                    $('#list_contact_details').addClass('active_tab1 active');
                    $('#list_contact_details').attr('href', '#contact_details');
                    $('#list_contact_details').attr('data-toggle', 'tab');
                    $('#contact_details').addClass('active in');
                }
            });

            $('#previous_btn_contact_details').click(function() {
                $('#list_contact_details').removeClass('active active_tab1');
                $('#list_contact_details').removeAttr('href data-toggle');
                $('#contact_details').removeClass('active in');
                $('#list_contact_details').addClass('inactive_tab1');
                $('#list_personal_details').removeClass('inactive_tab1');
                $('#list_personal_details').addClass('active_tab1 active');
                $('#list_personal_details').attr('href', '#personal_details');
                $('#list_personal_details').attr('data-toggle', 'tab');
                $('#personal_details').addClass('active in');
            });

            $('#btn_contact_details').click(function() {
                var error_address = '';
                var error_mobile_no = '';
                var mobile_validation = /^\d{10}$/;
                if ($.trim($('#contact_address').val()).length == 0) {
                    error_address = 'Address is required';
                    $('#error_contact_address').text(error_address);
                    $('#contact_address').addClass('has-error');
                } else {
                    error_address = '';
                    $('#error_contact_address').text(error_address);
                    $('#contact_address').removeClass('has-error');
                }

                if ($.trim($('#contact_mobile_no').val()).length == 0) {
                    error_mobile_no = 'Mobile Number is required';
                    $('#error_contact_mobile_no').text(error_mobile_no);
                    $('#error_contact_mobile_no').addClass('has-error');
                } else {
                    if (!mobile_validation.test($('#contact_mobile_no').val())) {
                        error_mobile_no = 'Invalid Mobile Number';
                        $('#error_contact_mobile_no').text(error_mobile_no);
                        $('#contact_mobile_no').addClass('has-error');
                    } else {
                        error_mobile_no = '';
                        $('#error_contact_mobile_no').text(error_mobile_no);
                        $('#contact_mobile_no').removeClass('has-error');
                    }
                }
                console.log(error_address, error_mobile_no);
                if (error_address != '' || error_mobile_no != '') {
                    return false;
                } else {
                    $('#btn_contact_details').attr("disabled", "disabled");
                    $(document).css('cursor', 'prgress');
                    $("#register_form").submit();
                }
            });
        });
    </script>
    </body>
</html>