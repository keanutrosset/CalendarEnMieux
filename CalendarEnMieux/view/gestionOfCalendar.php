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
?>

<link rel="stylesheet" href="css/Profil.css" media="screen">
<link href="css/Calendar.css" rel="stylesheet" type="text/css" />

<h1 class="u-align-center u-custom-font u-font-lato u-text u-text-palette-5-dark-2 u-text-1">Gestion de la date : <?php echo $date["date"];?></h1>



<br>
<center>
  <?php if (@$_GET['eventsError'] == 1) :?>
  <h5><span style="color:red">L'heure ne correspond pas, ou alors il n'y a pas tout les champs de rempli.</span></h5>
  <?php endif ?>
  <?php if (@$_GET['eventsError'] == 2) :?>
  <h5><span style="color:red">Il n'y a pas tout les champs de rempli.</span></h5>
  <?php endif ?>
  <?php if (@$_GET['eventsError'] == 3) :?>
  <h5><span style="color:red">Il y a eu une erreur dans le processus.</span></h5>
  <?php endif ?>
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

    array_unshift($allEvents,array("ID" => "", "name" => "", "place" => "", "date" => "", "start time" => "", "end time" => "", "type" => "", "recurrence" => ""));

    foreach($allEvents as $num=>$data)
    {



  ?>
<form name="gestionEvent<?=((isset($data["recuID"])) ? $data['recuID'] : $data['ID'])?>" id="gestionEvent<?=((isset($data["recuID"])) ? $data['recuID'] : $data['ID'])?>" action="?action=audEvent" method="post"><input type='hidden' id='date' name='date' value='<?php echo $date["date"];?>'>
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
                <option value="0" <?= ($data["type"] == "0") ? "selected=True" : "" ?>>Aucun</option>
                <option style="background-color:cyan" value="1" <?= ($data["type"] == "1") ? "selected=True" : "" ?>>Privé</option>
                <option style="background-color:red" value="2" <?= ($data["type"] == "2") ? "selected=True" : "" ?>>Professionel</option>
                <option style="background-color:green" value="3" <?= ($data["type"] == "3") ? "selected=True" : "" ?>>Maison</option>
                <option style="background-color:pink" value="4" <?= ($data["type"] == "4") ? "selected=True" : "" ?>>Ecole</option>
                <option style="background-color:yellow" value="5" <?= ($data["type"] == "5") ? "selected=True" : "" ?>>Famille</option>
                <option style="background-color:grey" value="6" <?= ($data["type"] == "6") ? "selected=True" : "" ?>>Divers</option>
              </select>
            </td></tr>
            <tr height="50px"><td>
                <strong>Récurrence</strong></td><td>
                  <input type="radio" id="Aucun<?=$data['ID']?>" name="recurrence" value="0" <?= ($data["recurrence"] == "0") ? "checked=True" : "" ?> required="" autofocus="autofocus">
                  <label for="Aucun<?=$data['ID']?>" >Aucun</label>

                  <input type="radio" id="day<?=$data['ID']?>" name="recurrence" value="1" <?= ($data["recurrence"] == "1") ? "checked=True" : "" ?> required="" autofocus="autofocus">
                  <label for="day<?=$data['ID']?>" >Jours</label>

                  <input type="radio" id="month<?=$data['ID']?>" name="recurrence" value="2" <?= ($data["recurrence"] == "2") ? "checked=True" : "" ?> required="" autofocus="autofocus">
                  <label for="month<?=$data['ID']?>" >Mois</label>

                  <input type="radio" id="year<?=$data['ID']?>" name="recurrence" value="3" <?= ($data["recurrence"] == "3") ? "checked=True" : "" ?> required="" autofocus="autofocus">
                  <label for="year<?=$data['ID']?>" >Année</label>
                </button>
                <input id="qty" type="number" style="width:3em;" step="1" min="0" max="365"
                name="qty" placeholder="NB" required=""></td>
              </td></tr>


        <tr height="50px">
          <?php
      			if($num==0){
      				echo "<td colspan='2'><input type='submit' class='u-btn u-align-center' value='Ajouter'>";
              echo "<input type='hidden' id='add' name='add' value='0'></td>";
            }
      			else
      			{
      				echo "<td colspan='4'><input type='button' onclick='upda(".((isset($data["recuID"])) ? $data['recuID'] : $data['ID']).")' class='u-btn u-align-left' value='Modifier'><input type='button' class='u-btn u-align-right' value='Supprimer' onclick='supp(".((isset($data["recuID"])) ? $data['recuID'] : $data['ID']).")'>
              ";
              if($data["recurrence"] != 0)
              {
                 echo"<input type='button' class='u-btn u-align-right' value='Supprimer avec toutes les recurrences' onclick='suppAll(".$data['ID'].")'>";
                 echo"<input type='button' class='u-btn u-align-right' value='Supprimer celle ci et les suivantes' onclick='suppAfter(".$data['ID'].")'>";
               };
      				echo "<input type='hidden' id='sup".((isset($data["recuID"])) ? $data['recuID'] : $data['ID'])."' value='' name='sup'><input type='hidden' id='upd".$data['ID']."' name='upd' class='u-btn' value=''>
              ";
              if($data["recurrence"] != 0)
              {
                echo "<input type='hidden' id='supAll".$data['ID']."' value='' name='supAll'>";
                echo "<input type='hidden' id='supAfter".$data['ID']."' value='' name='supAfter'>";
              };
              echo "</td>";
      			}
  		    ?>
        </tr>
</table>
</form>
<?php } ?>

</center>
<br>


<script type="text/javascript">
function supp(id)
{
	if(confirm("Etes vous sur de supprimer cette Date")==true)
	{
		document.getElementById('sup'+id).value=id;
		document.getElementById('gestionEvent'+id).submit();
	}
}
function suppAll(id)
{
	if(confirm("Etes vous sur de supprimer cette Date")==true)
	{
		document.getElementById('supAll'+id).value=id;
		document.getElementById('gestionEvent'+id).submit();
	}
}
function suppAfter(id)
{
	if(confirm("Etes vous sur de supprimer cette Date")==true)
	{
		document.getElementById('supAfter'+id).value=id;
		document.getElementById('gestionEvent'+id).submit();
	}
}
function upda(id)
{
  document.getElementById('upd'+id).value=id;
  document.getElementById('gestionEvent'+id).submit();
}
</script>


<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
