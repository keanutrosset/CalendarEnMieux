<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

function showData(){

    $result = false;

    $dateAgenda = 'SELECT date FROM events';

    require_once 'model/dbConnector.php';

    $result = executeQuerySelect($dateAgenda);

    return $result;


    /*$fullDate=$_GET['dt'];

    $sql="SELECT * FROM events WHERE date ='$fullDate'";
   	require_once 'model/dbConnector.php';

   	$req = executeQuerySelect($sql);

    return $req;

   	if(isset($req)){
   		foreach($req as $data)
   		{
   			$mod=1;
   			$id=$data['id'];
   			$loc=$data['event'];
   			$eve=$data['lieu'];
   		}}

   	else
   	{
   		$mod=0;
   		$loc="";
   		$eve="";
    }*/
}

function addEvent($eventToAdd){
  //if(isset($_POST['lieu']))
  //{
    $dat=$_POST['dd'];
    $l=$_POST['lieu'];
    $e=$_POST['event'];
    $d_l=explode('-',$dat);
    $mois=$d_l[1];
    $anne=$d_l[0];
    $lien="&annee=".$anne."&mois=".$mois;

    $sql="INSERT into events (dt,lieu,event) values('$dat','$l','$e')";
    require_once 'model/dbConnector.php';

    $req = executeQuerySelect($sql);
    return $req;

//  }
}
function deleteEvent($eventToDelete){
//  if(isset($_POST['sup']))
  //{
    $id=$_POST['upd'];
    $dat=$_POST['dd'];
    $d_l=explode('-',$dat);
    $mois=$d_l[1];
    $anne=$d_l[0];
    $lien="&annee=".$anne."&mois=".$mois;
    $l=$_POST['lieu'];
    $e=$_POST['event'];


    $suppQuery='DELETE from events where ID=:id';
    $suppData= array(":id" => $id);
    $req = executeQueryInsert($suppQuery, $suppData);

    return $req;

  //}
}

function updateEvent($eventToModify){
//  else{
    $updateQuery='UPDATE events SET `lieu` = :lieu , `event` = :event WHERE id = :id';
    $updateData= array(":lieu" => $e, ":event" => $l, ":id" => $id);
    $req = executeQueryInsert($updateQuery, $updateData);

    return $req;
  //}
  header("location:myCalendar.php?$lien");
}
