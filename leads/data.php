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
        $leadname = $_POST['leadName'];
        $date = $_POST['date'];
        $contactName = $_POST['contactName'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if(empty($leadname) && empty($date) && empty($contactName) && empty($phone) && empty($email) ){
            echo '<div class="alert alert-info">Please fill all fields</div>';
            exit();
        }else{
            $statement = $pdo->prepare("SELECT * FROM `leads` WHERE `email`=? OR `phone`=? OR `name`=? ");
            $statement->execute(array($email, $phone, $leadname));
            $result = $statement->rowCount();

            if ($result > 0) {
                echo "<div class='alert alert-warning'>leads may already exist in the records</div>";
            } else {

                // TODO : create a select for opportunity
                $statement = $pdo->prepare("INSERT INTO `leads`(`name`, `contact_person`, `phone`, `email`, `address`, `date`) VALUES (?, ?, ?, ?, ?, ?)");
                if ($statement->execute(array($leadname, $contactName, $phone, $email, $address, $date))) {
                    echo "<div class='alert alert-success'>leads saved successfully</div>";                    
                } else {
                    echo "<div class='alert alert-warning'>Failed to save leads</div>";
                }

            }
        }
        
    break;
    default:
    echo json_encode("invalid request");
break;
}