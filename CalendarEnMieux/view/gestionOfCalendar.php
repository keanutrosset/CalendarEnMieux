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

<link rel="stylesheet" href="css/Profil.css" media="screen">
<link href="css/Calendar.css" rel="stylesheet" type="text/css" />

<h1 class="u-align-center u-custom-font u-font-lato u-text u-text-palette-5-dark-2 u-text-1">Gestion de la date : <?php echo $fullDate;?></h1>
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
<br>
<center>
<form name="gr" action="?action=addAnEvent" method="post"><input type='hidden' id='date' name='date' value='<?php echo $d; ?>'>
<table >

        <tr height="50px"><td width="150px">
            <strong>Nom de l'évènement</strong></td><td>
            <label for="email-3b9a" class="u-form-control-hidden u-label">Evenement</label>
            <input type="text" name="event" value="<?php echo $event;?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
        </td></tr>

        <br>

        <tr height="50px"><td>
              <strong>Lieu</strong></td><td>
              <label class="u-form-control-hidden u-label">Lieu</label>
              <input type="text" name="lieu" value="<?php echo $lieu;?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
          </td></tr>

          <tr height="50px"><td>
                <strong>Heure de début</strong></td><td>
                <label class="u-form-control-hidden u-label">Heure de début</label>
                <input type="time" name="startTime" value="<?php echo $startTime;?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </td></tr>
          <tr height="50px"><td>
                <strong>Heure de fin</strong></td><td>
                <label class="u-form-control-hidden u-label">Heure de fin</label>
                <input type="time" name="startTime" value="<?php echo $endTime;?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </td></tr>

          <tr height="50px"><td>
              <strong>Type</strong></td><td>
              <select name="type" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" value="<?php echo $type;?>" required="" autofocus="autofocus" >
                <option value="" disabled selected value>--Please choose an option--</option>
                <option value="none">Aucun</option>
                <option value="private">Privé</option>
                <option value="professionel">Professionel</option>
                <option value="home">Maison</option>
                <option value="school">Ecole</option>
                <option value="family">famille</option>
                <option value="other">Divers</option>
              </select>
            </td></tr>


        <tr height="50px">
        <?php
			if($mod==0)
				echo "<td colspan='2'><input type='submit' class='u-btn u-align-center' value='Ajouter'></td>";
			else
			{
				echo "<td colspan='2'><input type='submit' value='Modifier'>&nbsp;&nbsp;<input type='button' value='Supprimer' onclick='supp()'>";
				echo "<input type='hidden' id='sup' name='sup' value='0'><input type='hidden' name='upd' value='$id'></td>";
			}
		?>
        </tr>
</table>
</form>
</center>
<br>
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


<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
