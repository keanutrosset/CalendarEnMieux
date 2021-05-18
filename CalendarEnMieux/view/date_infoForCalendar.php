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

	include('model/dbConnector.php');
	$d=$_GET['dt'];
?>


<h1>Detail de la date : <?php echo $d;?></h1>
<?php
	$sql="SELECT * from agenda where dt='$d'";
	$req=mysql_query($sql);
	if(mysql_num_rows($req)==0)
		echo "Aucune information pour cette date";
	else
		while($data=mysql_fetch_array($req))
		{
?>
        <table >
        <tr height="50px"><td width="150px"><strong>Evenement</strong></td><td><?php echo $data['event'];?></td></tr>
        <tr height="50px"><td><strong>Lieu</strong></td><td><?php echo $data['lieu'];?></td></tr>
        </table>
<?php
		}
?>
