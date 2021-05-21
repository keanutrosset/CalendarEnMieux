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

    require_once 'model/dbConnector.php';

    $result = executeQueryInsert($addEventQuery,$addEventData);

    return $result;

}

function deleteEvent($eventToDelete, $userID){

    $suppQuery='DELETE from events where ID = :id AND FKusers = :idUser';
    $suppData= array(":id" => $eventToDelete['sup'], ":idUser" => $userID);

    print_r($suppQuery);
    print_r($suppData);
    print_r($eventToDelete);

    require_once 'model/dbConnector.php';
    $result = executeQueryInsert($suppQuery, $suppData);

    return $result;
}

function updateEvent($eventToModify,$userID){

    $date = $eventToModify['date'];
    $place = $eventToModify['lieu'];
    $event = $eventToModify['event'];
    $startTime = $eventToModify['startTime'];
    $endTime = $eventToModify['endTime'];
    $type = $eventToModify['type'];
    $recurrence = $eventToModify['recurrence'];
    $IDOfEvent = $eventToModify['upd'];

    $strSeparator = '\'';

    $i=0;
    if(isset($recurrence[$i])){
      $recurrence = $recurrence[$i];
    }
    else{
      $i++;
    }

    $updateEventQuery = 'UPDATE events SET `name` = :name, `place` = :place, `date` = :date, `start time` = :startTime, `end time` = :endTime, `type` = :type, `recurrence` = :recurrence, `FKusers` = :userID
    WHERE ID = '.$strSeparator.$IDOfEvent.$strSeparator.' AND FKusers = '.$strSeparator.$userID.$strSeparator;
    $updateEventData = array(":name" => $event, ":place" => $place, ":date" => $date, ":startTime" => $startTime, ":endTime" => $endTime, ":type" => $type, ":recurrence" => $recurrence, ":userID" => $userID);

    print_r($updateEventQuery);
    print_r($updateEventData);
    print_r($eventToModify);


    require_once 'model/dbConnector.php';
    $result = executeQueryInsert($updateEventQuery, $updateEventData);

    return $result;
}
