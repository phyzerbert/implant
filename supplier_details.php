<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Managements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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

        function getUser($id){
            require 'db.php';
            if(!$id) return null;
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row;
            } else {
                return null;
            }
        }

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

        $query = "SELECT * FROM suppliers";
        if($_SESSION['email'] != 'admin@admin.com') {
            $user_id = $_SESSION['id'];
            $query .= " WHERE user_id = $user_id";
        }
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
                    <table class="table table-bordered" id="supplierTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Reference Number</th>
                                <th>Company Registered Name</th>
                                <th>Company Registered Number</th>
                                <th>Tax Registeration Number</th>
                                <th>Vat Registeration Number</th>
                                <th>Company Physical Address</th>
                                <th>Postal Address</th>
                                <th>Company Contact Person</th>
                                <th>Telephone</th>
                                <th>Company Email</th>
                                <th>Fax Number</th>
                                <th>Company Website</th>
                                <th>Primary Category</th>
                                <th>Direct</th>
                                <th>Indirect</th>
                                <th>Financial Capacity</th>
                                <th>Declare</th>
                                <th>Name Of Account Holder</th>
                                <th>Name Of Bank/th>
                                <th>Account Number</th>
                                <th>Branch Code</th>
                                <th>Swift Code</th>
                                <th>Vendor / Suppliers Document Upload</th>
                                <th>Accept Terms</th>
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
                                    <td class="user_id">
                                        <?php
                                            $user = getUser($row['user_id']);
                                            if(is_array($user)) echo $user['first_name']." ".$user['last_name'];
                                        ?>
                                    </td>
                                    <td class="reference_no"><?php echo $row['reference_no']; ?></td>
                                    <td class="company_name"><?php echo $row['company_name']; ?></td>
                                    <td class="company_number"><?php echo $row['company_number']; ?></td>
                                    <td class="company_tax"><?php echo $row['company_tax']; ?></td>
                                    <td class="company_vat"><?php echo $row['company_vat']; ?></td>
                                    <td class="company_address"><?php echo $row['company_address']; ?></td>
                                    <td class="postal_address"><?php echo $row['postal_address']; ?></td>
                                    <td class="compay_contact_person"><?php echo $row['company_contact_person']; ?></td>
                                    <td class="company_telephone"><?php echo $row['company_telephone']; ?></td>
                                    <td class="company_email"><?php echo $row['company_email']; ?></td>
                                    <td class="company_fax"><?php echo $row['company_fax']; ?></td>
                                    <td class="company_website"><?php echo $row['company_website']; ?></td>
                                    <td class="business_primary_category">
                                        <?php echo ucwords(str_replace('_', ' ', $row['business_primary_category'])); ?>
                                    </td>
                                    <td class="business_direct">
                                        <?php echo ucwords(str_replace('_', ' ', $row['business_direct'])); ?>
                                    </td>
                                    <td class="business_indirect">
                                        <?php echo ucwords(str_replace('_', ' ', $row['business_indirect'])); ?>
                                    </td>
                                    <td class="financial_capacity">
                                        <?php
                                            $financial_array = explode(', ', $row['financial_capacity']);
                                            if(in_array(0, $financial_array)) {
                                                echo "<span class='badge badge-info'>0 - 50,000</span>";
                                            }
                                            if(in_array(50000, $financial_array)) {
                                                echo "<span class='badge badge-info ml-1'>50,000 - 350,000</span>";
                                            }
                                            if(in_array(350000, $financial_array)) {
                                                echo "<span class='badge badge-info ml-1'>350,000 - 500,000</span>";
                                            }
                                            if(in_array(500000, $financial_array)) {
                                                echo "<span class='badge badge-info ml-1'>500,000 - 1,000,000</span>";
                                            }
                                            if(in_array(1000000, $financial_array)) {
                                                echo "<span class='badge badge-info ml-1'>1,000,000 - Above</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="financial_declare">
                                        <?php 
                                            if($row['financial_declare']) {
                                                echo "<span class='badge badge-primary'>Yes</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>No</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="bank_account"><?php echo $row['bank_account']; ?></td>
                                    <td class="bank_name"><?php echo $row['bank_name']; ?></td>
                                    <td class="bank_account_number"><?php echo $row['bank_account_number']; ?></td>
                                    <td class="bank_branch_code"><?php echo $row['bank_branch_code']; ?></td>
                                    <td class="bank_swift_code"><?php echo $row['bank_swift_code']; ?></td>
                                    <td class="document">
                                            <?php
                                                if(file_exists($row['document_company_registration'])) {
                                                    echo "<a href='".$row['document_company_registration']."' download>Download...&nbsp;</a>";
                                                }
                                                if(file_exists($row['document_tax'])) {
                                                    echo "<a href='".$row['document_tax']."' download>Download...&nbsp;</a>";
                                                }
                                                if(file_exists($row['document_bee'])) {
                                                    echo "<a href='".$row['document_bee']."' download>Download...&nbsp;</a>";
                                                }
                                                if(file_exists($row['document_id_document'])) {
                                                    echo "<a href='".$row['document_id_document']."' download>Download...</a>";
                                                }
                                            ?>
                                    </td>
                                    <td class="document_terms">
                                        <?php 
                                            if($row['document_terms']) {
                                                echo "<span class='badge badge-primary'>Yes</span>";
                                            } else {
                                                echo "<span class='badge badge-danger'>No</span>";
                                            }
                                        ?>
                                    </td>
                                    <td class="py-2">
                                        <?php if($_SESSION['email'] != 'admin@admin.com') { ?>
                                            <a href="supplier_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info btn-edit">Edit</a>
                                        <?php } ?>
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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#supplierTable').DataTable();
        });
    </script>
</body>
</html>