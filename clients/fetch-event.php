<?php
    include('../include/connection.php');
    $json = array();
    $room_id = $_GET['room_id'];
    $sqlQuery = "SELECT CONCAT('Reserved', '  ', '') as title, CONCAT(start_date, 'T',time) as start, 
    CONCAT(checkout_date, 'T',time) as end FROM reservation 
    INNER JOIN rooms ON rooms.id=reservation.room_id
    INNER JOIN clients ON clients.id=reservation.client_id
    WHERE room_id = '$room_id' AND reservation.status IN(0, 1)";

    $result = mysqli_query($con, $sqlQuery);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {    
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    echo json_encode($eventArray);
