<?php

require_once 'config.php';

if(isset($_GET['what'])){
    if ($_GET['what'] == 'members'){
        $sql = "SELECT * FROM members";
        $csv_cols = [
            "member_id", 
            "first_name",
            "last_name",
            "email",
            "phone_number",
            "training_plan_id",
            "trainer_id",
            "photo_path",
            // "access_card_pdf_path",
            // "created_at"
        ];

    } elseif ($_GET['what'] == 'trainers'){
        $sql = "SELECT * FROM trainers";
        $csv_cols = [
            "trainer_id",
            "first_name",
            "last_name",
            "email",
            "phone_number",
            // "access_card_pdf_path",
            // "photo_path",
            "created_at"
        ];

    } else {
        die();
    }

    $run = $conn->query($sql);

    $results= $run->fetch_all(MYSQLI_ASSOC);

    $output = fopen('php://output', 'w');

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=' . $_GET['what'] . '.csv'); 

    fputcsv($output,$csv_cols);

    foreach ($results AS $result) {
        fputcsv($output, $result);
    }

    fclose($output);
}