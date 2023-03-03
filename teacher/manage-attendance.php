<?php
include("../config.php");

if(isset($_POST["submit_class_info"])){
    $class_id = $_POST["class_id"];
    header("Location: ./attendance.php?class_id=$class_id");
}

if(isset($_POST["submit_subject_info"])){
    $class_id = $_POST["class_id"];
    $subject_id = $_POST["subject_id"];
    header("Location: ./attendance.php?class_id=$class_id&subject_id=$subject_id");
}

if (isset($_POST["submit_attendance"])) {
    $class_id = $_GET["class_id"];
    $subject_id = $_GET["subject_id"];
    $student_id_status = $_POST["attendance"];

    $max_classes_conducted_query = "SELECT MAX(total) AS MAX_CLASSES_CONDUCTED FROM attendance WHERE class_id = $class_id AND subject_id = $subject_id";
    $response = mysqli_query($conn, $max_classes_conducted_query) or die(mysqli_error($conn));
    $max_classes_conducted = mysqli_fetch_array($response)["MAX_CLASSES_CONDUCTED"] + 1;

    foreach ($student_id_status as $student_id => $status) {
        $attendance = "SELECT * FROM attendance WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
        $response = mysqli_query($conn, $attendance) or die(mysqli_error($conn));
        $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

        if (mysqli_num_rows($response) == 0) {
            if ($status == 1) {
                $insert = "INSERT INTO attendance (student_id, class_id, subject_id, present, absent, total) VALUES ('$student_id', '$class_id', '$subject_id', '1','0','$max_classes_conducted')";
            } else {
                $insert = "INSERT INTO attendance (student_id, class_id, subject_id, present, absent, total) VALUES ('$student_id', '$class_id', '$subject_id', '0','1','$max_classes_conducted')";
            }
            $response = mysqli_query($conn, $insert) or die(mysqli_error($conn));
        } else {
            if ($status == 1) {
                $present = $attendance_details["present"] + 1;
                $update = "UPDATE attendance SET present = '$present', total = '$max_classes_conducted' WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
            } else {
                $absent = $attendance_details["absent"] + 1;
                $update = "UPDATE attendance SET absent = '$absent', total = '$max_classes_conducted' WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
            }
            $response = mysqli_query($conn, $update) or die(mysqli_error($conn));
        }
    }
    header("Location: ../index.php");
}

if(isset($_POST['importSubmit'])){
   
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            fgetcsv($csvFile);
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                $student_id          = $line[0];
                $class_id            = $line[1];
                $subject_id          = $line[2];
                $present             = $line[3];
                $absent              = $line[4];
                $total               = $line[5];
                // $dob            = $line[6];
                // $address        = $line[7];
                // $password       = $line[8];
                
                // Check whether member already exists in the database with the same email
                $find_student = "SELECT * FROM students WHERE `student_id` = '$student_id'";
    $response = mysqli_query($conn, $find_student) or die(mysqli_error($conn));

        $attendance = "SELECT * FROM attendance WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
        $response = mysqli_query($conn, $attendance) or die(mysqli_error($conn));
        $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                
                if(mysqli_num_rows($response) == 1){
                    // Update member data in the database
                    
                    $update = "UPDATE attendance SET present = '$present', total = '$total' WHERE student_id = '$student_id' AND class_id = '$class_id' AND subject_id = '$subject_id'";
                    $response = mysqli_query($conn, $update) or die(mysqli_error($conn));
                    // $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                }else{
                    // Insert member data in the database
                    
                    $insert = "INSERT INTO attendance (student_id, class_id, subject_id, present, absent, total) VALUES ('$student_id', '$class_id', '$subject_id', '$present','$absent','$total')";
                    $response = mysqli_query($conn, $insert) or die(mysqli_error($conn));
                    // $attendance_details = mysqli_fetch_array($response, MYSQLI_ASSOC);
                }
                
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }

header("Location: ../index.php".$qstring);
}
