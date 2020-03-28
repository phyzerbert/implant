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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="post" id="editForm">
                    <input type="hidden" name="edit_id" class="id" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Company Registration Name</label>
                            <input type="text" name="company_name" class="form-control company_name" placeholder="Company Registration Name" />
                        </div>
                        <div class="form-group">
                            <label for="">Company Registration Number</label>
                            <input type="text" name="company_number" class="form-control company_number" placeholder="Company Registration Number" />
                        </div>
                        <div class="form-group">
                            <label for="">Tax Registeration Number</label>
                            <input type="text" name="company_tax" class="form-control company_tax" placeholder="Tax Registeration Number" />
                        </div>
                        <div class="form-group">
                            <label for="">Vat Registeration Number</label>
                            <input type="text" name="company_vat" class="form-control company_vat" placeholder="Vat Registeration Number" />
                        </div>
                        <div class="form-group">
                            <label for="">Company Physical Address</label>
                            <input type="text" name="company_address" class="form-control company_address" placeholder="Company Physical Address" />
                        </div>
                        <div class="form-group">
                            <label for="">Postal Address</label>
                            <input type="text" name="postal_address" class="form-control postal_address" placeholder="Postal Address" />
                        </div>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="first_name" class="form-control first_name" placeholder="First Name" />
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control last_name" placeholder="Last Name" />
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="gender" class="form-control gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="contact_address" class="form-control contact_address" placeholder="Address" />
                        </div>
                        <div class="form-group">
                            <label for="">Mobile No</label>
                            <input type="text" name="contact_mobile_no" class="form-control contact_mobile_no" placeholder="Mobile No" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger ml-2" data-dismiss="modal">Close</button>
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
            })
        });
    </script>
</body>
</html>