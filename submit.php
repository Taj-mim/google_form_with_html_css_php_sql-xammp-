<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "google_form"
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['Number'];
$email = $_POST['email'];
$city = $_POST['City'];
$position = $_POST['Position'];
$experience = $_POST['Experience'];

$resume_name = $_FILES['Resume']['name'];
$temp_name = $_FILES['Resume']['tmp_name'];

$upload_folder = "uploads/";

move_uploaded_file(
    $temp_name,
    $upload_folder . $resume_name
);

$sql = "INSERT INTO job_applications
(name, phone, email, city, position, experience, resume)
VALUES
('$name', '$phone', '$email', '$city', '$position', '$experience', '$resume_name')";

$success = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Status</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container{
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.15);
            text-align: center;
            width: 450px;
        }

        h2{
            color: #28a745;
        }

        .error{
            color: red;
        }

        .btn{
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #4285F4;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn:hover{
            background: #3367d6;
        }
    </style>

</head>
<body>

<div class="container">

<?php
if($success){
    echo "<h2> Application Submitted Successfully!</h2>"; 
    echo "<p>Thank you, <strong>$name</strong>, for applying.</p>";

}
else{
    echo "<h2 class='error'> Submission Failed</h2>";
    echo "<p>Error occurred while saving data.</p>";
}
?>

<a href="form.html" class="btn">⬅ Back to Form</a>

</div>

</body>
</html>