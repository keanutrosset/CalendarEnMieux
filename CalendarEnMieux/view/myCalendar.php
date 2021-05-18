<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

  $title = "CalendarEnMieux - Mon calendrier";

  include('model/dbConnector.php');

 // tampon de flux stocké en mémoire
ob_start();
 ?>

 <link rel="stylesheet" href="css/Profil.css" media="screen">
 <link href="css/calendar.css" rel="stylesheet" type="text/css" />

    <section class="u-clearfix u-image u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-section-1" id="carousel_61fd" data-image-width="1980" data-image-height="1409">
      <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
              <div class="u-container-layout u-valign-top u-container-layout-1">
                <h1 class="u-align-center u-custom-font u-font-lato u-text u-text-palette-5-dark-2 u-text-1">Mon calendrier</h1>
                <h5 class="u-align-center u-text u-text-2"><?= $_SESSION["pseudo"]; ?></h5>

                <?php
                $list_fer=array(7);//Liste pour les jours ferié; EX: $list_fer=array(7,1)==>tous les dimanches et les Lundi seront des jours fériers

                $dateAgenda="select dt from agenda";

                require_once 'model/dbConnector.php';

                $alldataAgenda = executeQuerySelect($dateAgenda);


                $counter=0;
                //foreach($data = $req)//$data=mysql_fetch_array($req))
                foreach($alldataAgenda as $data)
                {
                	$list_spe[$counter]=$data;
                	$counter++;
                }
                if($counter==0)
                	$list_spe[0]="";
                //$list_spe=array('1986-10-31','2009-4-12','2009-9-23');//Mettez vos dates des evenements ; NB format(annee-m-j)
                	$lienRedirect="view/gestionOfCalendar.php";

                	//$lienRedirect="date_info.php";//Lien de redirection apres un clic sur une date, NB la date selectionner va etre ajouter à ce lien afin de la récuperer ultérieurement
                	$clic=1;//1==>Activer les clic sur tous les dates; 2==>Activer les clic uniquement sur les dates speciaux; 3==>Désactiver les clics sur tous les dates
                $col1="#99ccff";//couleur au passage du souris pour les dates normales

                $col2="#8af5b5";//couleur au passage du souris pour les dates speciaux

                $col3="#cc66ff";//couleur au passage du souris pour les dates férié

                $mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre", "Octobre", "Novembre", "Décembre");
                //$week_fr = Array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                if(isset($_GET['jour']) && isset($_GET['mois']) && isset($_GET['annee']))
                {
                	$week=$_GET['mois'];
                	$day=$_GET['jour'];
                	$annee=$_GET['annee'];
                }
                else
                {
                	$mois=date("n");
                	$day=date("l");
                	$annee=date("Y");
                }
                $s=strlen($mois)-1;
                if($mois<10)
                	$mois=$mois[$s];
                $ccl2=array($col1,$col2,$col3);

                $l_day=date("t",mktime(0,0,0,$mois,1,$annee));
                $firstDay=date("N", mktime(0, 0, 0, $mois,1 , $annee));
                $lastDay=date("N", mktime(0, 0, 0, $mois,$l_day , $annee));

                $testhours=date("d", mktime(0, 0, 0, $mois,$l_day , $annee));

                $titre=$mois_fr[$mois]." : ".$annee;

                //$mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre", "Octobre", "Novembre", "Décembre");
                /*if(isset($_GET['mois']) && isset($_GET['annee']))
                {
                	$mois=$_GET['mois'];
                	$annee=$_GET['annee'];
                }
                else
                {
                	$mois=date("n");
                	$annee=date("Y");
                }
                $s=strlen($mois)-1;
                if($mois<10)
                	$mois=$mois[$s];
                $ccl2=array($col1,$col2,$col3);
                $l_day=date("t",mktime(0,0,0,$mois,1,$annee));
                $firstDay=date("N", mktime(0, 0, 0, $mois,1 , $annee));
                $lastDay=date("N", mktime(0, 0, 0, $mois,$l_day , $annee));
                $titre=$mois_fr[$mois]." : ".$annee;*/
                //echo $l_day;
                ?>


                <form name="dt" method="POST" action="?action=changeDate">

                <a onClick="change()" class="u-btn u-align-left">Aujourd'hui</a>
                <center>
                <br>
                <!--This fonction is here when the user change the month of the calendar-->
                <select name="mois" id="mois" onChange="change()" class="liste">
                <?php
                	for($i=1;$i<13;$i++)
                	{
                		echo '<option value="'.$i.'"';
                		if($i==$mois)
                			echo ' selected ';
                		echo '>'.$mois_fr[$i].'</option>';
                	}
                ?>
                </select>

                <select name="annee" id="annee" onChange="change()" class="liste">
                <?php
                	for($i=1970;$i<2039;$i++)
                	{
                		echo '<option value="'.$i.'"';
                		if($i==$annee)
                			echo ' selected ';
                		echo '>'.$i.'</option>';
                	}
                ?>
                </select>
                </form>

                <table class="tableau"><caption><?php echo $titre ;?></caption>
                <tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th></tr>
                <tr>
                <?php
                //echo $lastDay;
                $case=0;
                if($firstDay>1)
                	for($i=1;$i<$firstDay;$i++)
                	{
                		echo '<td class="desactive">&nbsp;</td>';
                		$case++;
                	}
                for($i=1;$i<($l_day+1);$i++)
                {
                	$f=$lastDay=date("N", mktime(0, 0, 0, $mois,$i , $annee));
                	if($i<10)
                		$jj="0".$i;
                	else
                		$jj=$i;
                	if($mois<10)
                		$mm="0".$mois;
                	else
                		$mm=$mois;
                	$da=$annee."-".$mm."-".$jj;
                	$lien=$lienRedirect;
                	$lien.="?dt=".$da;
                	echo "<td";
                	if(in_array($da, $list_spe))
                	{
                		echo " class='special' onmouseover='over(this,1,2)'";
                		if($clic==1||$clic==2)
                			echo " onclick='go_lien(\"$lien\",this)' ";
                	}
                	else if(in_array($f, $list_fer))
                	{
                		echo " class='ferier' onmouseover='over(this,2,2)'";
                		if($clic==1)
                			echo " onclick='go_lien(\"$lien\",this)' ";
                	}
                	else
                	{
                		echo" onmouseover='over(this,0,2)' ";
                		if($clic==1)
                			echo " onclick='go_lien(\"$lien\",this)' ";
                	}
                	echo" onmouseout='over(this,0,1)'>$i</td>";
                	$case++;
                	if($case%7==0)
                		echo "</tr><tr>";

                }
                if($lastDay!=7)
                	for($i=$lastDay;$i<7;$i++)
                	{
                		echo '<td class="desactive">&nbsp;</td>';
                	}
                ?></tr>
                </table>
                <?php
                	if(isset($_GET['mod']))
                		echo "<div id='notif'>Calendrier modifié</div>";
                	elseif(isset($_GET['add']))
                		echo "<div id='notif'>Evénement ajouté</div>";
                ?>
                </center>
    </section>
  <script type="text/javascript">
  function change()
  {
  	document.dt.submit("?action=changeDate");
  }
  	function over(this_,a,t)
  {
  	<?php
  	echo "var c2=['$ccl2[0]','$ccl2[1]','$ccl2[2]'];";
  	?>
  	var col;
  	if(t==2)
  		this_.style.backgroundColor=c2[a];
  	else
  		this_.style.backgroundColor="";
  }
  function go_lien(a,this_)
  {
  	over(this_,0,1);
  	top.document.location=a;
  }
  </script>


<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
