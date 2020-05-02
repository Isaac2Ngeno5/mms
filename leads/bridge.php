<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../login.php");
    exit;
}
require_once "../config/database.php";


$db = new Database();
$pdo = $db->getConnection();

$statement = $pdo->prepare("SELECT * FROM `users` WHERE `email`=?");
if ($statement->execute(array($_SESSION["user"]))) {
    $result = $statement->fetch();
} else {
    echo json_encode(array("error" => "failed to execute query"));
}

$user_id = $result['id'];

$id = $_POST['id'];
?>
    <script type="text/javascript" src="js/app.js"></script>
<?php

switch ($id) {
    case 1:
        echo '<div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Leads</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" id="add-lead" >
                                        <i class="zmdi zmdi-plus"></i>add Lead
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                            <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped ">
                                        <thead class="bg-dark">
                                        <tr>
                                            <th>date</th>
                                            <th>order ID</th>
                                            <th>name</th>
                                            <th class="text-right">price</th>
                                            <th class="text-right">quantity</th>
                                            <th class="text-right">total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>2018-09-29 05:57</td>
                                            <td>100398</td>
                                            <td>iPhone X 64Gb Grey</td>
                                            <td class="text-right">$999.00</td>
                                            <td class="text-right">1</td>
                                            <td class="text-right">$999.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-28 01:22</td>
                                            <td>100397</td>
                                            <td>Samsung S8 Black</td>
                                            <td class="text-right">$756.00</td>
                                            <td class="text-right">1</td>
                                            <td class="text-right">$756.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-27 02:12</td>
                                            <td>100396</td>
                                            <td>Game Console Controller</td>
                                            <td class="text-right">$22.00</td>
                                            <td class="text-right">2</td>
                                            <td class="text-right">$44.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-26 23:06</td>
                                            <td>100395</td>
                                            <td>iPhone X 256Gb Black</td>
                                            <td class="text-right">$1199.00</td>
                                            <td class="text-right">1</td>
                                            <td class="text-right">$1199.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-25 19:03</td>
                                            <td>100393</td>
                                            <td>USB 3.0 Cable</td>
                                            <td class="text-right">$10.00</td>
                                            <td class="text-right">3</td>
                                            <td class="text-right">$30.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-29 05:57</td>
                                            <td>100392</td>
                                            <td>Smartwatch 4.0 LTE Wifi</td>
                                            <td class="text-right">$199.00</td>
                                            <td class="text-right">6</td>
                                            <td class="text-right">$1494.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-24 19:10</td>
                                            <td>100391</td>
                                            <td>Camera C430W 4k</td>
                                            <td class="text-right">$699.00</td>
                                            <td class="text-right">1</td>
                                            <td class="text-right">$699.00</td>
                                        </tr>
                                        <tr>
                                            <td>2018-09-22 00:43</td>
                                            <td>100393</td>
                                            <td>USB 3.0 Cable</td>
                                            <td class="text-right">$10.00</td>
                                            <td class="text-right">3</td>
                                            <td class="text-right">$30.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        ';
        break;
    case 2:
        echo '
         <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Lead</strong> Form
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" id="add-lead-form" method="post" class="form-horizontal">
                                            <div class="form-group">
                                                <label for="name" class="form-control-label">Lead Name</label>
                                                <input type="text" name="lead" class="form-control" id="name" placeholder="leads Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="form-control-label">Date</label>
                                                <input type="date" name="date" class="form-control date" id="date" placeholder="09/09/19">
                                            </div>
                                            <div class="form-group">
                                                <label for="contactName">Contact Name</label>
                                                <input type="text" name="contactName" id="contactName" class="form-control" placeholder="Contact Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Physical Address</label>
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Physical Address">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" id="save-lead">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
        ';
        break;
    default:
        echo json_encode("invalid request");
        break;
}