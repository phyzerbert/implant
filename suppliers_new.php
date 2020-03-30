<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>

    <?php

require 'db.php';
session_start();
$message = '';
if(isset($_POST["email"]))
{
 sleep(5);
 $query = "
 INSERT INTO tbl_login 
 (first_name, last_name, gender, email, password, address, mobile_no) VALUES 
 (:first_name, :last_name, :gender, :email, :password, :address, :mobile_no)
 ";
 $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
 $user_data = array(
  ':first_name'  => $_POST["first_name"],
  ':last_name'  => $_POST["last_name"],
  ':gender'   => $_POST["gender"],
  ':email'   => $_POST["email"],
  ':password'   => $password_hash,
  ':address'   => $_POST["address"],
  ':mobile_no'  => $_POST["mobile_no"]
 );
 $statement = $mysqli->prepare($query);
 if($statement->execute($user_data))
 {
  $message = '
  <div class="alert alert-success">
  Registration Completed Successfully
  </div>
  ';
 }
 else
 {
  $message = '
  <div class="alert alert-success">
  There is an error in Registration
  </div>
  ';
 }
}
?>

        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Multi Step Registration Form in PHP</title>
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
            <br />
            <div class="container box">
                <br />
                <h2 align="center">Multi Step Registration Form in PHP</h2>
                <br />
                <?php echo $message; ?>
                <form method="post" enctype="multipart/form-data" id="register_form">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Suppliers Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Company Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Business Unit / All Commodities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link inactive_tab1" id="list_financial_details" style="border:1px solid #ccc">Company Finanacial Capacity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Company Banking Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Vendor / Suppliers Document Attachment</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="margin-top:16px;">
                        <div class="tab-pane active" id="login_details">
                            <div class="panel panel-default">
                                <div class="panel-heading">Company Details</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Company Registered Name</label>
                                        <input type="text" name="companyname" id="companyname" class="form-control" />
                                        <span id="error_companyname" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Registered Number</label>
                                        <input type="text" name="companynumber" id="companynumber" class="form-control" />
                                        <span id="error_password" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Tax Registeration Number</label>
                                        <input type="text" name="companynumber" id="companynumber" class="form-control" />
                                        <span id="error_password" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Vat Registeration Number</label>
                                        <input type="text" name="companyvat" id="companyvat" class="form-control" />
                                        <span id="error_password" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Company Physical Address</label>
                                        <textarea name="address" class="form-control" id="address"></textarea>
                                        <span id="error_password" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <input type="text" name="postaladdress" id="postaladdress" class="form-control" />
                                        <span id="error_password" class="text-danger"></span>
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
                                        <label>Company Contact Person</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" />
                                        <span id="error_first_name" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Company Email</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Fax Number</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Company Website</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
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
                                <div class="panel-heading">Business Unit / All Commodities</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <p>
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" /> 10 - shift</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" /> Smelting plant</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" /> Metal Refineries</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> Meresky
                                            </label>
                                        </p>
                                    </div>
                                    <p>Primary Category</p>
                                    <hr />
                                    <p>Direct
                                        <br />
                                    </p>
                                    <div class="form-group">
                                        <p>
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" /> 10 - Construction</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" /> Electrical
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" /> Fluid
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> Material
                                            </label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Machenical
                                            </label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Minning commodity</label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Minning Equipment</label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Minning Services</label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Processing
                                            </label>
                                        </p>
                                    </div>
                                    <br /> Indirect
                                    <br />
                                    <div class="form-group">
                                        <p>
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" /> Fiacilittiest
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" /> Finacial
                                            </label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" /> Hr Services</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> Information Tech</label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Professional
                                            </label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Transport
                                            </label>
                                            <br />
                                            <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4" /> Travel
                                            </label>
                                        </p>
                                    </div>

                                    <div align="center">
                                        <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                        <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Next</button>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="financial_details">
                            <div class="panel panel-default">
                                <div class="panel-heading">Company Financial Capacity</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <p>
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0" /> 0 - R50000</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1" /> R50000 - R100000</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2" /> R100000 -R 350000</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> R350000 - 5000 000</label>
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> R5000000 - 1000000</label>
                                            0
                                            <br />
                                            <label>
                                                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3" /> R1000000 - Above</label>
                                            <br />
                                            <label>
                                                <input type="radio" name="radio" id="select" value="select" /> I declare that the company has the finacial capacity to render the service cost to the figure sellected above.</label>
                                        </p>
                                        <br />
                                    </div>
                                    <div align="center">
                                        <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
                                        <button type="button" name="btn_financial_details" id="btn_financial_details" class="btn btn-info btn-lg">Next</button>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="personal_details">
                            <div class="panel panel-default">
                                <div class="panel-heading">Company Banking Details</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Name of account holder</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" />
                                        <span id="error_first_name" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Name of bank</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Branch code</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Swift code</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" />
                                        <span id="error_last_name" class="text-danger"></span>
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
                        <div class="tab-pane fade" id="personal_details">
                            <div class="panel panel-default">
                                <div class="panel-heading">Vendor / Suppliers Document Upload</div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Company Registration</label>
                                        <label for="doc"></label>
                                        <input type="file" name="doc" id="doc" />
                                        <span id="error_first_name" class="text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <span id="error_last_name" class="text-danger"></span>
                                        <label for="doc"></label>
                                        <input type="file" name="doc" id="doc" />
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Bee</label>
                                        <label for="doc"></label>
                                        <input type="file" name="doc" id="doc" />
                                        <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <label>Id document</label>
                                        <label for="doc"></label>
                                        <input type="file" name="doc" id="doc" /> <span id="error_last_name" class="text-danger"></span>
                                    </div>
                                    <br />
                                    <div class="form-group">
                                        <input type="checkbox" name="terms" id="terms" />
                                        <label for="terms"></label>
                                        Accept terms and condition </div>
                                    <br />
                                    <div align="center">
                                        <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
                                        <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Submit</button>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </body>

        </html>

        <script>
            $(document).ready(function() {

                $('#btn_login_details').click(function() {

                    var error_companyname = '';
                    var error_companynumber = '';
                    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                    if ($.trim($('#companyname').val()).length == 0) {
                        error_email = 'Company is required';
                        $('#error_companyname').text(error_email);
                        $('#companyname').addClass('has-error');
                    } else {
                        if (!filter.test($('#companyname').val())) {
                            error_email = 'Invalid companyname';
                            $('#error_companyname').text(error_email);
                            $('#companyname').addClass('has-error');
                        } else {
                            error_companyname = '';
                            $('#error_companyname').text(error_companyname);
                            $('#companyname').removeClass('has-error');
                        }
                    }

                    if ($.trim($('#companynumber').val()).length == 0) {
                        error_password = 'Company number is required';
                        $('#error_companynumber').text(error_companynumber);
                        $('#companynumber').addClass('has-error');
                    } else {
                        error_companynumber = '';
                        $('#error_companynumber').text(error_companynumber);
                        $('#companynumber').removeClass('has-error');
                    }

                    if (error_companyname != '' || error_companynumber != '') {
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
                    if ($.trim($('#address').val()).length == 0) {
                        error_address = 'Address is required';
                        $('#error_address').text(error_address);
                        $('#address').addClass('has-error');
                    } else {
                        error_address = '';
                        $('#error_address').text(error_address);
                        $('#address').removeClass('has-error');
                    }

                    if ($.trim($('#mobile_no').val()).length == 0) {
                        error_mobile_no = 'Mobile Number is required';
                        $('#error_mobile_no').text(error_mobile_no);
                        $('#mobile_no').addClass('has-error');
                    } else {
                        if (!mobile_validation.test($('#mobile_no').val())) {
                            error_mobile_no = 'Invalid Mobile Number';
                            $('#error_mobile_no').text(error_mobile_no);
                            $('#mobile_no').addClass('has-error');
                        } else {
                            error_mobile_no = '';
                            $('#error_mobile_no').text(error_mobile_no);
                            $('#mobile_no').removeClass('has-error');
                        }
                    }
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