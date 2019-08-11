<?php
// Fetching Values From URL
$name2 = strip_tags($_POST['name1']);
$email2 = strip_tags($_POST['email1']);
$password2 = md5(strip_tags($_POST['password1']));

// Create connection
$conn = new mysqli("localhost", "root", "", "trashbin");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO users (username, password, nagan)
VALUES ('$email2', '$password2', '$name2')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>