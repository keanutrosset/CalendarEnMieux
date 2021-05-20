<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

function showData($date){

    $result = false;

    $strSeparator = '\'';

    $dateAgenda = 'SELECT date FROM events WHERE date = '.$strSeparator.$date.$strSeparator;

    require_once 'model/dbConnector.php';

    $result = executeQuerySelect($dateAgenda);

    return $result;
}

function selectAllEvents($date){


    $selectAllEventsQuery="SELECT * FROM events WHERE date ='$date'";
   	require_once 'model/dbConnector.php';

   	$result = executeQuerySelect($selectAllEventsQuery);

    return $result;
}



function addEvent($eventToAdd, $userID){

    $date = $eventToAdd['date'];
    $place = $eventToAdd['lieu'];
    $event = $eventToAdd['event'];
    $startTime = $eventToAdd['startTime'];
    $endTime = $eventToAdd['endTime'];
    $type = $eventToAdd['type'];
    $recurrence = $eventToAdd['recurrence'];

    $i=0;
    if(isset($recurrence[$i])){
      $recurrence = $recurrence[$i];
    }
    else{
      $i++;
    }

    $addEventQuery = 'INSERT INTO events (`name`, `place`, `date`, `start time`, `end time`, `type`, `recurrence`, `FKusers`) VALUES (:name, :place, :date, :startTime, :endTime, :type, :recurrence, :userID)';
    $addEventData = array(":name" => $event, ":place" => $place, ":date" => $date, ":startTime" => $startTime, ":endTime" => $endTime, ":type" => $type, ":recurrence" => $recurrence, ":userID" => $userID);

    print_r($addEventQuery);
    print_r($addEventData);

    require_once 'model/dbConnector.php';

    $result = executeQueryInsert($addEventQuery,$addEventData);

    print_r($result);

    return $result;

}

function deleteEvent($eventToDelete){

    $suppQuery='DELETE from events where ID=:id';
    $suppData= array(":id" => $id);
    $req = executeQueryInsert($suppQuery, $suppData);

    return $req;
}

function updateEvent($eventToModify){

    $date = $eventToAdd['date'];
    $place = $eventToAdd['lieu'];
    $event = $eventToAdd['event'];
    $startTime = $eventToAdd['startTime'];
    $endTime = $eventToAdd['endTime'];
    $type = $eventToAdd['type'];
    $recurrence = $eventToAdd['recurrence'];

    $i=0;
    if(isset($recurrence[$i])){
      $recurrence = $recurrence[$i];
    }
    else{
      $i++;
    }

    $updateEventQuery = 'UPDATE events SET `name` = :name, `place` = :place, `date` = :date, `start time` = :startTime, `end time` = :endTime, `type` = :type, `recurrence` = :recurrence, `FKusers` = :userID';
    $updateEventData = array(":name" => $event, ":place" => $place, ":date" => $date, ":startTime" => $startTime, ":endTime" => $endTime, ":type" => $type, ":recurrence" => $recurrence, ":userID" => $userID);

    $result = executeQueryInsert($updateEventQuery, $updateEventData);

    return $result;
}
