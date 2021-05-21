<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */


function audEvent($event,$userID){
  if(isset($event["add"])){
    addAnEvent($event,$userID);
  }
  elseif(isset($event["upd"])){
    updateAnEvent($event,$userID);
    /*print_r($event);
    print_r($userID);
    print_r("pas bien");*/
  }
  elseif(isset($event["sup"])){
    deleteAnEvent($event,$userID);
    /*print_r($event);
    print_r($userID);
    print_r("bien");*/
  }

  /*print_r("vraiment pas bien");
  print_r($event);
  print_r($userID);*/
}


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
  if(isset($eventToUpdate['event']) && isset($eventToUpdate['lieu']) && isset($eventToUpdate['startTime']) && isset($eventToUpdate['endTime']) && isset($eventToUpdate['type']))
  {
    require_once "model/eventsManagement.php";
    $result = updateEvent($eventToUpdate, $userID);

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

function deleteAnEvent($eventToDelete, $userID){

  require_once "model/eventsManagement.php";
  $result = deleteEvent($eventToDelete, $userID);

  if($result){
    header("Location:?action=myCalendar");
  }
  else{
    header("Location:?action=home");
  }
  header("Location:?action=home");
}
