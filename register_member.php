<?php

require_once 'config.php';
//require_once 'fpdf/fpdf.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $training_plan_id = $_POST['training_plan_id'];
    $trainer_id = 0;
//    $photo_path = $_POST['photo_path_member'];
//    $access_card_pdf_path = '';

   

$sql = "INSERT INTO members (first_name, last_name, email, phone_number, 
training_plan_id, trainer_id) 
VALUES (?,?,?,?,?,?)";
$run = $conn->prepare($sql);

if (!$run) {
    die("Prepare error: " . $conn->error);
}

$run->bind_param("ssssii", $first_name, $last_name, $email, $phone_number,$training_plan_id, $trainer_id);
$run->execute();

$member_id = $conn->insert_id;


//$pdf = new FPDF();
//$pdf -> AddPage();
//$pdf -> setFont('Arial','B',16);

//$pdf->Cell(40,10, 'Access Card');
//$pdf->Ln();
//$pdf->Cell(40,10, 'Member ID: ' . $member_id);
//$pdf->Ln();
//$pdf->Cell(40,10, 'Name: ' . $first_name . " " .$last_name);
////$pdf->Ln();
//$pdf->Cell(40,10, 'Email: ' . $email);
//$pdf->Ln();


//$filename = 'access_cards/access_card_' . $member_id . '.pdf';
//$pdf->Output('F', $filename);

// // $sql = "UPDATE members SET access_card_pdf_path = '$filename' WHERE member_id = $member_id";
// $conn->query($sql);
// $conn->close();

$_SESSION['member_id'] = $member_id;

//var_dump($photo_path);

$_SESSION['success-message'] = "Član teretane je uspješno <b>dodat</b>.";
header('location: admin_dashboard.php');
exit();

}


