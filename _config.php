<?php
$conn = new mysqli("localhost", "root", "", "siddharth");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
