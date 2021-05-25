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
  elseif($event["upd"] != ""){
    updateAnEvent($event,$userID);
  }
  elseif($event["sup"] != ""){
    deleteAnEvent($event,$userID);
  }
}


function addAnEvent($eventToAdd, $userID){

  if(isset($eventToAdd['event']) && isset($eventToAdd['lieu']) && isset($eventToAdd['startTime']) && isset($eventToAdd['endTime']) && isset($eventToAdd['type']) && $eventToAdd['startTime'] < $eventToAdd['endTime'])
  {
    require_once "model/eventsManagement.php";
    $result = addEvent($eventToAdd, $userID);
    if($result){
      header("Location:?action=myCalendar");
    }
    else{
      $_GET["eventsError"] = 3;
      require_once "controler/user.php";
      seeAnEvent($eventToAdd);
    }
  }
  else{
    $_GET["eventsError"] = 1;
    require_once "controler/user.php";
    seeAnEvent($eventToAdd);
  }
}

function updateAnEvent($eventToUpdate, $userID){
  if(isset($eventToUpdate['event']) && isset($eventToUpdate['lieu']) && isset($eventToUpdate['startTime']) && isset($eventToUpdate['endTime']) && isset($eventToUpdate['type']) && $eventToAdd['startTime'] < $eventToAdd['endTime'])
  {
    require_once "model/eventsManagement.php";
    $result = updateEvent($eventToUpdate, $userID);

    if($result){
      header("Location:?action=myCalendar");
    }
    else{
      $_GET["eventsError"] = 3;
      require_once "controler/user.php";
      seeAnEvent($eventToUpdate);
    }
  }
  else{
    $_GET["eventsError"] = 1;
    require_once "controler/user.php";
    seeAnEvent($eventToUpdate);
  }
}

function deleteAnEvent($eventToDelete, $userID){

  require_once "model/eventsManagement.php";
  $result = deleteEvent($eventToDelete, $userID);

  if($result){
    header("Location:?action=myCalendar");
  }
  else{
    $_GET["eventsError"] = 3;
    require_once "controler/user.php";
    seeAnEvent($eventToDelete);
  }
}
