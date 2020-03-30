<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Register Supplier</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

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
            .form-group label {
                font-weight: 600;
            }
        </style>
    </head>

    <body>

        <?php
            require 'db.php';
            session_start();

            if ($_SESSION['logged_in'] != 1) {
                $_SESSION['message'] = "<div class='info-alert'>You must log in before register supplier!</div>";
                header("location: error.php");
            }

            $message='';
            $key_array = [
                'reference_no',
                'company_name',
                'company_number',
                'company_tax',
                'company_vat',
                'company_address',
                'postal_address',
                'compay_contact_person',
                'company_telephone',
                'company_fax',
                'company_website',
                'business_primary_category',
                'business_direct',
                'business_indirect',
                'financial_capacity',
                'financial_declare',
                'bank_account',
                'bank_name',
                'bank_account_number',
                'bank_branch_code',
                'bank_swift_code',
                'document_company_registration',
                'document_tax',
                'document_bee',
                'document_id_document',
                'document_terms',
            ];

            if(isset($_POST["supplier_register"])) {
                sleep(5);
                $insert_data = array();
                foreach ($key_array as $key) {
                    $insert_data[$key] = isset($_POST[$key]) && is_string($_POST[$key]) ? $_POST[$key] : '';
                }

                if(isset($_POST['business_primary_category'])){
                    $insert_data['business_primary_category'] = implode(', ', $_POST['business_primary_category']);
                }

                if (isset($_POST['business_direct'])) {
                    $insert_data['business_direct'] = implode(', ', $_POST['business_direct']);
                }

                if (isset($_POST['business_indirect'])) {
                    $insert_data['business_indirect'] = implode(', ', $_POST['business_indirect']);
                }

                if (isset($_POST['financial_capacity'])) {
                    $insert_data['financial_capacity'] = implode(', ', $_POST['financial_capacity']);
                }

                // File upload

                $target_dir = "uploads/company_registration/";
                $target_file = $target_dir . basename($_FILES["document_company_registration"]["name"]);

                if (move_uploaded_file($_FILES["document_company_registration"]["tmp_name"], $target_file)) {
                    $insert_data['document_company_registration'] = $target_file;
                }

                $target_dir = "uploads/tax/";
                $target_file = $target_dir . basename($_FILES["document_tax"]["name"]);

                if (move_uploaded_file($_FILES["document_tax"]["tmp_name"], $target_file)) {
                    $insert_data['document_tax'] = $target_file;
                }

                $target_dir = "uploads/bee/";
                $target_file = $target_dir . basename($_FILES["document_bee"]["name"]);

                if (move_uploaded_file($_FILES["document_bee"]["tmp_name"], $target_file)) {
                    $insert_data['document_bee'] = $target_file;
                }

                $target_dir = "uploads/id_document/";
                $target_file = $target_dir . basename($_FILES["document_id_document"]["name"]);

                if (move_uploaded_file($_FILES["document_id_document"]["tmp_name"], $target_file)) {
                    $insert_data['document_id_document'] = $target_file;
                }

                $insert_data['reference_no'] = time();

                // var_dump($insert_data); die();

                $query = "INSERT INTO suppliers (";

                foreach($key_array as $key){
                    $query .= "$key, ";
                }
                $query = rtrim($query, ", ") . ") VALUES (";

                foreach($key_array as $key){
                    $query .= "'$insert_data[$key]',";
                }
                $query = rtrim($query, ",") . ")";

                // echo $query; die();

                // $query = "INSERT INTO suppliers (company_name, company_number, company_tax, company_vat, company_address, postal_address, first_name, last_name, gender, contact_address, contact_mobile_no)
                //         VALUES ('".$_POST["company_name"]."','".$_POST["company_number"]."','".$_POST["company_tax"]."','".$_POST["company_vat"]."','".$_POST["company_address"]."','".$_POST["postal_address"]."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["gender"]."','".$_POST["contact_address"]."','".$_POST["contact_mobile_no"]."')";

                if ($mysqli->query($query) === TRUE) {
                    $message='<div class="alert alert-success"> Registration Completed Successfully </div> ';
                } else {
                    $error = $mysqli->error;
                    // echo "<script type= 'text/javascript'>alert('Error: " . $query . "<br>" . $mysqli->error."');</script>";
                    $message="<div class='alert alert-success'> $error </div> ";
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
            <form method="post" id="register_form" enctype="multipart/form-data">
                <input type="hidden" name="supplier_register" value="1">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_supplier_details">Suppliers Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_company_details" style="border:1px solid #ccc">Company Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_business_details" style="border:1px solid #ccc">Business Unit / All Commodities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_financial_details" style="border:1px solid #ccc">Company Finanacial Capacity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_banking_details" style="border:1px solid #ccc">Company Banking Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" id="list_document_details" style="border:1px solid #ccc">Vendor / Suppliers Document Attachment</a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-top:16px;">
                    <div class="tab-pane active" id="supplier_details">
                        <div class="card card-default">
                            <div class="card-header">Supplier Details</div>
                            <div class="card-body">
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
                                    <button type="button" name="btn_supplier_details" id="btn_supplier_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <!-- ********* Company Panel ********* -->
                    <div class="tab-pane fade" id="company_details">
                        <div class="card card-default">
                            <div class="card-header">Company Contact Details</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Company Contact Person</label>
                                    <input type="text" name="company_contact_person" id="company_contact_person" class="form-control" />
                                    <span id="error_company_contact_person" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <input type="text" name="company_telephone" id="company_telephone" class="form-control" />
                                    <span id="error_company_telephone" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Company Email</label>
                                    <input type="email" name="company_email" id="company_email" class="form-control" />
                                    <span id="error_company_email" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Fax Number</label>
                                    <input type="text" name="company_fax" id="company_fax" class="form-control" />
                                    <span id="error_company_fax" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Company Website</label>
                                    <input type="text" name="company_website" id="company_website" class="form-control" />
                                    <span id="error_company_website" class="text-danger"></span>
                                </div>
                                <br />
                                <div align="center">
                                    <button type="button" name="btn_prev_company_details" id="btn_prev_company_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_company_details" id="btn_company_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>
                    <!-- ********* Business Panel ********* -->
                    <div class="tab-pane fade" id="business_details">
                        <div class="card card-default">
                            <div class="card-header">Business Unit / All Commodities</div>
                            <div class="card-body">
                                <p>Primary Category</p>
                                <div class="form-group">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="business_primary_category[]" value="10_shift" id="business_primary_category_0" /> 10 - shift</label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_primary_category[]" value="smelting_plant" id="business_primary_category_1" /> Smelting plant</label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_primary_category[]" value="metal_refineries" id="business_primary_category_2" /> Metal Refineries</label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_primary_category[]" value="mersesky" id="business_primary_category_3" /> Meresky
                                        </label>
                                    </p>
                                </div>
                                <hr />
                                <br />
                                <p>Direct</p>
                                <div class="form-group">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="business_direct[]" value="10_construction" id="business_direct_10_construction" /> 10 - Construction</label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_direct[]" value="electrical" id="business_direct_electrical" /> Electrical
                                        </label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_direct[]" value="fluid" id="business_direct_fluid" /> Fluid
                                        </label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_direct[]" value="material" id="business_direct_material" /> Material
                                        </label>
                                        <br />
                                        <input type="checkbox" name="business_direct[]" value="machenical" id="business_direct_machenical" /> Machenical
                                        </label>
                                        <br />
                                        <input type="checkbox" name="business_direct[]" value="minning_commodity" id="business_direct_minning_commodity" /> Minning commodity</label>
                                        <br />
                                        <input type="checkbox" name="business_direct[]" value="minning_equipment" id="business_direct_minning_equipment" /> Minning Equipment</label>
                                        <br />
                                        <input type="checkbox" name="business_direct[]" value="minning_services" id="business_direct_minning_services" /> Minning Services</label>
                                        <br />
                                        <input type="checkbox" name="business_direct[]" value="processing" id="business_direct_processing" /> Processing
                                        </label>
                                    </p>
                                </div>
                                <br />
                                <p>Indirect</p>
                                <div class="form-group">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="business_indirect[]" value="facilitiest" id="business_indirect_facilitiest" /> Facilitiest
                                        </label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_indirect[]" value="financial" id="business_indirect_financial" /> Financial
                                        </label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_indirect[]" value="hr_services" id="business_indirect_hr_services" /> Hr Services</label>
                                        <br />
                                        <label>
                                            <input type="checkbox" name="business_indirect[]" value="information_tech" id="business_indirect_information_tech" /> Information Tech</label>
                                        <br />
                                        <input type="checkbox" name="business_indirect[]" value="professional" id="business_indirect_professional" /> Professional
                                        </label>
                                        <br />
                                        <input type="checkbox" name="business_indirect[]" value="transport" id="business_indirect_transport" /> Transport
                                        </label>
                                        <br />
                                        <input type="checkbox" name="business_indirect[]" value="travel" id="business_indirect_travel" /> Travel
                                        </label>
                                    </p>
                                </div>
                                <br />
                                <div align="center">
                                    <button type="button" name="btn_prev_business_details" id="btn_prev_business_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_business_details" id="btn_business_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>

                    <!-- ********* Financial Panel ********* -->
                    <div class="tab-pane fade" id="financial_details">
                        <div class="card card-default">
                            <div class="card-header">Company Financial Capacity</div>
                            <div class="card-body">
                                <div class="form-group">
                                        <p>
                                            <label><input type="checkbox" name="financial_capacity[]" value="0" id="financial_capacity_0"> 0 - R50,000</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_capacity[]" value="50000" id="financial_capacity_50000"> R50,000 - R100,000</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_capacity[]" value="100000" id="financial_capacity_100000"> R100,000 -R350,000</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_capacity[]" value="350000" id="financial_capacity_350000"> R350,000 - R500,000</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_capacity[]" value="500000" id="financial_capacity_500000"> R500,000 - R1,000,000</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_capacity[]" value="1000000" id="financial_capacity_1000000"> R1,000,000 - Above</label>
                                            <br>
                                            <label><input type="checkbox" name="financial_declare" id="financial_declare" value="1"> I declare that the company has the finacial capacity to render the service cost to the figure sellected above.</label>
                                        </p>
                                        <br>
                                    </div>
                                <br />
                                <div class="text-center">
                                    <button type="button" name="btn_prev_financial_details" id="btn_prev_financial_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_financial_details" id="btn_financial_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br />
                            </div>
                        </div>
                    </div>

                    <!-- ********* Banking Panel ********* -->
                    <div class="tab-pane fade" id="banking_details">
                        <div class="card card-default">
                            <div class="card-header">Company Banking Details</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name of account holder</label>
                                    <input type="text" name="bank_account" id="bank_account" class="form-control">
                                    <span id="error_bank_account" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Name of bank</label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control">
                                    <span id="error_bank_name" class="text-danger"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="bank_account_number" id="bank_account_number" class="form-control">
                                    <span id="error_bank_account_number" class="text-danger"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Branch code</label>
                                    <input type="text" name="bank_branch_code" id="bank_branch_code" class="form-control">
                                    <span id="error_bank_branch_code" class="text-danger"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Swift code</label>
                                    <input type="text" name="bank_swift_code" id="bank_swift_code" class="form-control">
                                    <span id="error_bank_swift_code" class="text-danger"></span>
                                </div>
                                <br>
                                <div align="center">
                                    <button type="button" name="btn_prev_banking_details" id="btn_prev_banking_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_banking_details" id="btn_banking_details" class="btn btn-info btn-lg">Next</button>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>

                    <!-- ********* Document Panel ********* -->
                    <div class="tab-pane fade" id="document_details">
                        <div class="card card-default">
                            <div class="card-header">Vendor / Suppliers Document Upload</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Company Registration</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document_company_registration" id="document_company_registration">
                                        <label class="custom-file-label" for="document_company_registration">Choose file</label>
                                    </div>
                                    <span id="error_document_company_registration" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tax</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document_tax" id="document_tax">
                                        <label class="custom-file-label" for="document_tax">Choose file</label>
                                    </div>
                                    <span id="error_document_tax" class="text-danger"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Bee</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document_bee" id="document_bee">
                                        <label class="custom-file-label" for="document_bee">Choose file</label>
                                    </div>
                                    <span id="error_document_bee" class="text-danger"></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Id document</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="document_id_document" id="document_id_document">
                                        <label class="custom-file-label" for="document_id_document">Choose file</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="document_terms" id="document_terms" value="1">Accept terms and condition.
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="button" name="btn_prev_document_details" id="btn_prev_document_details" class="btn btn-default btn-lg">Previous</button>
                                    <button type="button" name="btn_document_details" id="btn_document_details" class="btn btn-info btn-lg">Submit</button>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>

                    <!-- **************************************************** -->
                </div>
            </form>
        </div>

    <script>
        $(document).ready(function() {

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('#btn_supplier_details').click(function() {

                var error_company_name = '';
                var error_company_number = '';
                var filter = /^[A-Za-z0-9 _]+$/;

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
                    $('#list_supplier_details').removeClass('active active_tab1');
                    $('#list_supplier_details').removeAttr('href data-toggle');
                    $('#supplier_details').removeClass('active');
                    $('#list_supplier_details').addClass('inactive_tab1');
                    $('#list_company_details').removeClass('inactive_tab1');
                    $('#list_company_details').addClass('active_tab1 active');
                    $('#list_company_details').attr('href', '#company_details');
                    $('#list_company_details').attr('data-toggle', 'tab');
                    $('#company_details').addClass('active show');
                }
            });

            $('#btn_prev_company_details').click(function() {
                $('#list_company_details').removeClass('active active_tab1');
                $('#list_company_details').removeAttr('href data-toggle');
                $('#company_details').removeClass('active in');
                $('#list_company_details').addClass('inactive_tab1');
                $('#list_supplier_details').removeClass('inactive_tab1');
                $('#list_supplier_details').addClass('active_tab1 active');
                $('#list_supplier_details').attr('href', '#supplier_details');
                $('#list_supplier_details').attr('data-toggle', 'tab');
                $('#supplier_details').addClass('active show');
            });

            $('#btn_company_details').click(function() {
                var error_contact_person = '';
                var error_telephone = '';

                if ($.trim($('#company_contact_person').val()).length == 0) {
                    error_contact_person = 'Company Contact Person is required';
                    $('#error_company_contact_person').text(error_contact_person);
                    $('#company_contact_person').addClass('has-error');
                } else {
                    error_contact_person = '';
                    $('#error_company_contact_person').text(error_contact_person);
                    $('#company_contact_person').removeClass('has-error');
                }

                if ($.trim($('#company_telephone').val()).length == 0) {
                    error_telephone = 'Telephone is required';
                    $('#error_company_telephone').text(error_telephone);
                    $('#company_telephone').addClass('has-error');
                } else {
                    error_telephone = '';
                    $('#error_company_telephone').text(error_telephone);
                    $('#company_telephone').removeClass('has-error');
                }

                if (error_contact_person != '' || error_telephone != '') {
                    return false;
                } else {
                    $('#list_company_details').removeClass('active active_tab1');
                    $('#list_company_details').removeAttr('href data-toggle');
                    $('#company_details').removeClass('active');
                    $('#list_company_details').addClass('inactive_tab1');
                    $('#list_business_details').removeClass('inactive_tab1');
                    $('#list_business_details').addClass('active_tab1 active');
                    $('#list_business_details').attr('href', '#business_details');
                    $('#list_business_details').attr('data-toggle', 'tab');
                    $('#business_details').addClass('active show');
                }
            });

            /////// Business //////
            $('#btn_prev_business_details').click(function() {
                $('#list_business_details').removeClass('active active_tab1');
                $('#list_business_details').removeAttr('href data-toggle');
                $('#business_details').removeClass('active in');
                $('#list_business_details').addClass('inactive_tab1');
                $('#list_company_details').removeClass('inactive_tab1');
                $('#list_company_details').addClass('active_tab1 active');
                $('#list_company_details').attr('href', '#company_details');
                $('#list_company_details').attr('data-toggle', 'tab');
                $('#company_details').addClass('active show');
            });

            $('#btn_business_details').click(function() {
                $('#list_business_details').removeClass('active active_tab1');
                $('#list_business_details').removeAttr('href data-toggle');
                $('#business_details').removeClass('active');
                $('#list_business_details').addClass('inactive_tab1');
                $('#list_financial_details').removeClass('inactive_tab1');
                $('#list_financial_details').addClass('active_tab1 active');
                $('#list_financial_details').attr('href', '#contact_details');
                $('#list_financial_details').attr('data-toggle', 'tab');
                $('#financial_details').addClass('active show');
            });

            ////// Financial ///////
            $('#btn_prev_financial_details').click(function() {
                $('#list_financial_details').removeClass('active active_tab1');
                $('#list_financial_details').removeAttr('href data-toggle');
                $('#financial_details').removeClass('active in');
                $('#list_financial_details').addClass('inactive_tab1');
                $('#list_business_details').removeClass('inactive_tab1');
                $('#list_business_details').addClass('active_tab1 active');
                $('#list_business_details').attr('href', '#business_details');
                $('#list_business_details').attr('data-toggle', 'tab');
                $('#business_details').addClass('active show');
            });

            $('#btn_financial_details').click(function() {
                $('#list_financial_details').removeClass('active active_tab1');
                $('#list_financial_details').removeAttr('href data-toggle');
                $('#financial_details').removeClass('active');
                $('#list_financial_details').addClass('inactive_tab1');
                $('#list_banking_details').removeClass('inactive_tab1');
                $('#list_banking_details').addClass('active_tab1 active');
                $('#list_banking_details').attr('href', '#banking_details');
                $('#list_banking_details').attr('data-toggle', 'tab');
                $('#banking_details').addClass('active show');
            });

            ////// Banking ///////
            $('#btn_prev_banking_details').click(function() {
                $('#list_banking_details').removeClass('active active_tab1');
                $('#list_banking_details').removeAttr('href data-toggle');
                $('#banking_details').removeClass('active in');
                $('#list_banking_details').addClass('inactive_tab1');
                $('#list_financial_details').removeClass('inactive_tab1');
                $('#list_financial_details').addClass('active_tab1 active');
                $('#list_financial_details').attr('href', '#financial_details');
                $('#list_financial_details').attr('data-toggle', 'tab');
                $('#financial_details').addClass('active show');
            });

            $('#btn_banking_details').click(function() {
                $('#list_banking_details').removeClass('active active_tab1');
                $('#list_banking_details').removeAttr('href data-toggle');
                $('#banking_details').removeClass('active');
                $('#list_banking_details').addClass('inactive_tab1');
                $('#list_document_details').removeClass('inactive_tab1');
                $('#list_document_details').addClass('active_tab1 active');
                $('#list_document_details').attr('href', '#document_details');
                $('#list_document_details').attr('data-toggle', 'tab');
                $('#document_details').addClass('active show');
            });

            ////// Document ///////
            $('#btn_prev_document_details').click(function() {
                $('#list_document_details').removeClass('active active_tab1');
                $('#list_document_details').removeAttr('href data-toggle');
                $('#document_details').removeClass('active in');
                $('#list_document_details').addClass('inactive_tab1');
                $('#list_banking_details').removeClass('inactive_tab1');
                $('#list_banking_details').addClass('active_tab1 active');
                $('#list_banking_details').attr('href', '#banking_details');
                $('#list_banking_details').attr('data-toggle', 'tab');
                $('#banking_details').addClass('active show');
            });

            $('#btn_document_details').click(function() {
                $('#btn_document_details').attr("disabled", "disabled");
                $(document).css('cursor', 'prgress');
                $("#register_form").submit();
            });
        });
    </script>
    </body>
</html>