<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 17.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

  $title = "CalendarEnMieux - Details de la date";

	// tampon de flux stocké en  mémoire
	ob_start();

	if(isset($_POST['sup']))
	{
		$id=$_POST['upd'];
		$dat=$_POST['dd'];

		$d_l=explode('-',$dat);

		$mois=$d_l[1];
		$anne=$d_l[0];

		$lien="&annee=".$anne."&mois=".$mois;

		$l=$_POST['lieu'];
		$e=$_POST['event'];

		// to delete an event
		if($_POST['sup']==1){
			$suppQuery='DELETE from agenda where id=:id';
			$suppData= array(":id" => $id);
			$allEvents = executeQueryInsert($suppQuery, $suppData);
		}

		//to update an event
		else{
			$updateQuery='UPDATE agenda SET `lieu` = :lieu , `event` = :event WHERE id = :id';
			$updateData= array(":lieu" => $e, ":event" => $l, ":id" => $id);
			$allEvents = executeQueryInsert($updateQuery, $updateData);
		}
		header("location:myCalendar.php?$lien");
	}

//to add an event
	else if(isset($_POST['lieu']))
	{
		$dat=$_POST['dd'];
		$l=$_POST['lieu'];
		$e=$_POST['event'];
		$d_l=explode('-',$dat);
		$mois=$d_l[1];
		$anne=$d_l[0];
		$lien="&annee=".$anne."&mois=".$mois;
	}
	else
	{
		$fullDate=$_GET['dt'];

?>

<h1>Gestion de la date : <?php echo $fullDate;?></h1>
<?php
	$sql="SELECT * FROM agenda WHERE dt='$fullDate'";
	require_once 'model/dbConnector.php';

	if(isset($allEvents)){
		foreach($allEvents as $data)
		{
			$mod=1;
			$id=$data['id'];
			$loc=$data['event'];
			$eve=$data['lieu'];
		}
	}

	else
	{
		$mod=0;
		$loc="";
		$eve="";
	}
?>

<form name="gr" action="view/gestionOfCalendar.php" method="post"><input type='hidden' id='dd' name='dd' value='<?php echo $d; ?>'>
<table >
        <tr height="50px"><td width="150px"><strong>Evenement</strong></td><td><input type="text" name="lieu" value="<?php echo $loc;?>"/></td></tr>
        <tr height="50px"><td><strong>Lieu</strong></td><td><input type="text" name="event" value="<?php echo $eve;?>"/></td></tr>
        <tr height="50px">
        <?php
			if($mod==0)
				echo "<td colspan='2'><input type='submit' value='Ajouter'></td>";
			else
			{
				echo "<td colspan='2'><input type='submit' value='Modifier'>&nbsp;&nbsp;<input type='button' value='Supprimer' onclick='supp()'>";
				echo "<input type='hidden' id='sup' name='sup' value='0'><input type='hidden' name='upd' value='$id'></td>";
			}
		?>
        </tr>
</table>
</form>

<?php
}
?>


<script type="text/javascript">
function supp()
{
	if(confirm("Etes vous sur de supprimer cette Date")==true)
	{
		document.getElementById('sup').value=1;
		gr.submit();
	}
}
</script>
