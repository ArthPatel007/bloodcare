<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    //Code for Deletion
    if (isset($_REQUEST['del'])) {
        $did = intval($_GET['del']);
        $sql = "DELETE FROM recipient WHERE id = '$did'";
        if (mysqli_query($conn, $sql)) {
            $msg = "Record deleted Successfully";
        } else {
            $msg = "Error deleting record: " . mysqli_error($conn);
        }
    }
?>

    <!doctype html>
    <html lang="en" class="no-js">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>BloodCare | Recipient List </title>

        <!-- Font awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Sandstone Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap Datatables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <!-- Bootstrap social button library -->
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <!-- Bootstrap select -->
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <!-- Bootstrap file input -->
        <link rel="stylesheet" href="css/fileinput.min.css">
        <!-- Awesome Bootstrap checkbox -->
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <!-- Admin Stye -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="shortcut icon" href="faviconblood.png" type="image/x-icon" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>

    </head>

    <body>
        <?php include('includes/header.php'); ?>
        <div class="ts-main-content">
            <?php include('includes/leftbar.php'); ?>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="page-title">Recipient List</h2>
                            <!-- Zero Configuration Table -->
                            <div class="panel panel-default">
                                <div class="panel-heading">Recipient Info</div>
                                <a href="download-recipientrecords.php" style="font-size:16px;" class="btn btn-info">Download Recipient List</a>
                                <div class="panel-body">
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Blood Group</th>
                                                <th>City</th>
                                                <th>action </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S No</th>
                                                <th>Name</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Blood Group</th>
                                                <th>City</th>
                                                <th>action </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $sql = "SELECT * from  recipient ";
                                            $result = mysqli_query($conn, $sql);
                                            $cnt = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row['FullName']); ?></td>
                                                        <td><?php echo htmlentities($row['MobileNumber']); ?></td>
                                                        <td><?php echo htmlentities($row['email']); ?></td>
                                                        <td><?php echo htmlentities($row['age']); ?></td>
                                                        <td><?php echo htmlentities($row['Gender']); ?></td>
                                                        <td><?php echo htmlentities($row['BloodGroup']); ?></td>
                                                        <td><?php echo htmlentities($row['city']); ?></td>
                                                        <td>
                                                            <a href="managerecipient.php?del=<?php echo htmlentities($row['id']); ?>" onclick="return confirm('Do you really want to delete this record')" class="btn btn-danger" style="margin-top:1%;">Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $cnt = $cnt + 1;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Scripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/fileinput.js"></script>
        <script src="js/chartData.js"></script>
        <script src="js/main.js"></script>
    </body>

    </html>
<?php } ?>