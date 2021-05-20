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

<br>
<center>
  <?php
  if(isset($allEvents)){
    $mod=1;
  }
    else
    {
    $mod=0;
    $loc="";
    $eve="";
    }

    foreach($allEvents as $data)
    {



  ?>
<form name="gr" action="?action=addAnEvent" method="post"><input type='hidden' id='date' name='date' value='<?php echo $fullDate;?>'>
<table >

        <tr height="50px"><td width="150px">
            <strong>Nom de l'évènement</strong></td><td>
            <label for="event" class="u-form-control-hidden u-label">Evenement</label>
            <input type="text" name="event" value="<?php echo $data["name"];?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
        </td></tr>

        <br>

        <tr height="50px"><td>
              <strong>Lieu</strong></td><td>
              <label for="lieu" class="u-form-control-hidden u-label">Lieu</label>
              <input type="text" name="lieu" value="<?php echo $data["place"];?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
          </td></tr>

          <tr height="50px"><td>
                <strong>Heure de début</strong></td><td>
                <label for="startTime" class="u-form-control-hidden u-label">Heure de début</label>
                <input type="time" name="startTime" value="<?php echo $data["start time"];?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </td></tr>
          <tr height="50px"><td>
                <strong>Heure de fin</strong></td><td>
                <label for="endTime" class="u-form-control-hidden u-label">Heure de fin</label>
                <input type="time" name="endTime" value="<?php echo $data["end time"];?>" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </td></tr>

          <tr height="50px"><td>
              <strong>Type</strong></td><td>
              <select name="type" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" value="<?php echo $data["type"];?>" required="" autofocus="autofocus" >
                <option value="" disabled selected value>--Please choose an option--</option>
                <option value="0">Aucun</option>
                <option value="1">Privé</option>
                <option value="2">Professionel</option>
                <option value="3">Maison</option>
                <option value="4">Ecole</option>
                <option value="5">famille</option>
                <option value="6">Divers</option>
              </select>
            </td></tr>
            <tr height="50px"><td>
                <strong>Récurrence</strong></td><td>
                  <input type="radio" id="Aucun" name="recurrence[]" value="0" checked required="" autofocus="autofocus">
                  <label for="Aucun" >Aucun</label>

                  <input type="radio" id="day" name="recurrence[]" value="1" required="" autofocus="autofocus">
                  <label for="day" >Jours</label>

                  <input type="radio" id="month" name="recurrence[]" value="2" required="" autofocus="autofocus">
                  <label for="month" >Mois</label>

                  <input type="radio" id="year" name="recurrence[]" value="3" required="" autofocus="autofocus">
                  <label for="year" >Année</label>
                </button>
              </td></tr>


        <tr height="50px">
          <?php
      			if($mod==0)
      				echo "<td colspan='2'><input type='submit' class='u-btn u-align-center' value='Ajouter'></td>";
      			else
      			{
      				echo "<td colspan='2'><input type='submit' class='u-btn u-align-left' value='Modifier'><input type='button' class='u-btn u-align-right' value='Supprimer' onclick='supp()'>";
      				echo "<input type='hidden' id='sup' name='sup' value='0'><input type='hidden' name='upd' class='u-btn' value='$id'></td>";
      			}
  		    ?>
        </tr>
</table>
</form>
<?php } ?>

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
