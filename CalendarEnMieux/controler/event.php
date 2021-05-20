<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */


function addAnEvent($eventToAdd, $userID){

  if(isset($eventToAdd['event']) && isset($eventToAdd['lieu']) && isset($eventToAdd['startTime']) && isset($eventToAdd['endTime']) && isset($eventToAdd['type']))
  {
    require_once "model/eventsManagement.php";
    $result = addEvent($eventToAdd, $userID);

    if($result){
      header("Location:?action=myCalendar");
    }
    else{
      header("Location:?action=home");
    }
  }
  else{
    header("Location:?action=home");
  }
}

function updateAnEvent($eventToUpdate, $userID){
  if(isset($eventToAdd['event']) && isset($eventToAdd['lieu']) && isset($eventToAdd['startTime']) && isset($eventToAdd['endTime']) && isset($eventToAdd['type']))
  {
    require_once "model/eventsManagement.php";
    $result = updateEvent($eventToAdd, $userID);

    if($result){
      header("Location:?action=myCalendar");
    }
    else{
      header("Location:?action=home");
    }
  }
  else{
    header("Location:?action=home");
  }
}

function deleteAnEvent($eventToDelete){
  if(isset($_POST['sup']))
  {
    require_once "model/eventsManagement.php";
    $result = updateEvent($eventToAdd, $userID);

    if($result){
      header("Location:?action=myCalendar");
    }
    else{
      header("Location:?action=home");
    }
  }
}
