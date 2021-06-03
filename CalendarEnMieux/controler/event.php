<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

 /**
  * This function is designed to separate add, update and delete of the form
  * @param $event : contain all the information of one event
  * @param $userID : User unique id address to store in session
  */
function audEvent($event,$userID){
  if(isset($event["add"])){
    addAnEvent($event,$userID);
  }
  elseif($event["upd"] != ""){
    updateAnEvent($event,$userID);
  }
  elseif($event["sup"] != "" || $event["supAll"] != "" || $event["supAfter"] != ""){
    deleteAnEvent($event,$userID);
  }
}

/**
 * This function is designed to prepare the event to be added
 * @param $eventToAdd : Contain all the informations of the event to be added
 * @param $userID : User unique id address to store in session
 */
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

 /**
  * This function is designed to prepare the event to be modify
  * @param $eventToUpdate : Contain all the informations of the event to be modify
  * @param $userID : User unique id address to store in session
  */
function updateAnEvent($eventToUpdate, $userID){
  if(isset($eventToUpdate['event']) && isset($eventToUpdate['lieu']) && isset($eventToUpdate['startTime']) && isset($eventToUpdate['endTime']) && isset($eventToUpdate['type']) && $eventToUpdate['startTime'] < $eventToUpdate['endTime'])
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

/**
 * This function is designed to prepare the event to be delete
 * @param $eventToDelete : Contain all the informations of the event to be delete
 * @param $userID : User unique id address to store in session
 */
function deleteAnEvent($eventToDelete, $userID){

  require_once "model/eventsManagement.php";

  print_r($eventToDelete);
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
