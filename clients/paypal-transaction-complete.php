<?php

include('../include/connection.php');
session_start();
date_default_timezone_set('Asia/Manila');
$tdate = date("m/d/Y");

$checkindate = $_POST['checkindate'];
$checkoutdate = $_POST['checkoutdate'];
$checkintime = $_POST['checkintime'];
$mop = $_POST['mop'];
$totalPay = $_POST['totalPay'];
$room_id = $_POST['room_id'];
$client_id = $_SESSION['id'];

$getClientID = mysqli_query($con, "SELECT * FROM clients WHERE user_id = '$client_id'");
$res = mysqli_fetch_array($getClientID);
$finalClientID = $res["id"];

// $getRoomDetails = mysqli_query($con, "SELECT * FROM rooms WHERE id = '$room_id'");
// $resRoom = mysqli_fetch_array($getRoomDetails);
// $rate = $resRoom["Rate"];

// $date1=date_create($checkindate);
// $date2=date_create($checkoutdate);
// $diff=date_diff($date1,$date2);

// $totalPay = $diff->format("%R%a") * $rate;


$reference = rand(10,10000000);


mysqli_query($con, "INSERT INTO reservation (`reference`, `tdate`,`client_id`, `room_id`, `start_date`, `checkout_date`, `time`, `totalPay`, `status`, `mop`, `paid`)
    Values ('$reference', '$tdate', '$finalClientID', '$room_id', '$checkindate', '$checkoutdate', '$checkintime', '$totalPay', 0, '$mop', 1)");
