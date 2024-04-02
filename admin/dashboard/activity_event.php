<?php
include_once("../../db/connection.php");
$sqlEvents = "SELECT id,
                     PostTitle,
                     start_date,
                     end_date
                FROM events
               WHERE status = 1
               LIMIT 20
               ";
$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {	
	// convert  date to milliseconds
	$start = strtotime($rows['start_date']) * 1000;
	$end = strtotime($rows['end_date']) * 1000;	
	$calendar[] = array(
        'id' =>$rows['id'],
        'title' => $rows['PostTitle'],
        'url' => "#",
		"class" => 'event-important',
        'start' => "$start",
        'end' => "$end"
    );
}
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
?>