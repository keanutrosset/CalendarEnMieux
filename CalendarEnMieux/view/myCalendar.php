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

 // tampon de flux stocké en mémoire
ob_start();
 // va etre utile uniquement pour le popup
date_default_timezone_set("Europe/Zurich");
 ?>

 <link rel="stylesheet" href="css/Profil.css" media="screen">
 <link href="css/Calendar.css" rel="stylesheet" type="text/css" />

    <section class="u-clearfix u-image u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-section-1" id="carousel_61fd" data-image-width="1980" data-image-height="1409">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
              <div class="u-container-layout u-valign-top u-container-layout-1">
                <h1 class="u-align-center u-custom-font u-font-lato u-text u-text-palette-5-dark-2 u-text-1">Mon calendrier</h1>
                <h5 class="u-align-center u-text u-text-2"><?= $_SESSION["pseudo"]; ?></h5>

                <?php
                $list_fer=array(7);//Liste pour les jours ferié; EX: $list_fer=array(7,1)==>tous les dimanches et les Lundi seront des jours fériers

                $counter=0;


                if($counter==0)
                	$list_spe[0]="";
                //$list_spe=array('1986-10-31','2009-4-12','2009-9-23');//Mettez vos dates des evenements ; NB format(annee-m-j)
                	$lienRedirect="?action=seeAnEvent";

                	//$lienRedirect="date_info.php";//Lien de redirection apres un clic sur une date, NB la date selectionner va etre ajouter à ce lien afin de la récuperer ultérieurement
                	$clic=1;//1==>Activer les clic sur tous les dates; 2==>Activer les clic uniquement sur les dates speciaux; 3==>Désactiver les clics sur tous les dates

                $col1="#99ccff";//couleur au passage du souris pour les dates normales

                $col2="#8af5b5";//couleur au passage du souris pour les dates speciaux

                $col3="#cc66ff";//couleur au passage du souris pour les dates férié

                $col4="#ffff00";//couleur au passage du souris pour les dates férié

                $mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août","Septembre", "Octobre", "Novembre", "Décembre");
                //$week_fr = Array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");

                //Capture des dates à afficher
                if(isset($newDate['mois']) && isset($newDate['annee']))
                {
                	$mois=$newDate['mois'];
                	//$day=$newDate['jour'];
                  //$day=date("l"); = EX: thuesday
                  $day=date("j");
                	$annee=$newDate['annee'];
                }
                else
                {
                	$mois=date("n");
                	$day=date("j");
                	$annee=date("Y");
                }
                $s=strlen($mois)-1;
                if($mois<10)
                	$mois=$mois[$s];
                $ccl2=array($col1,$col2,$col3,$col4);

                $l_day=date("t",mktime(0,0,0,$mois,1,$annee));
                $firstDay=date("N", mktime(0, 0, 0, $mois,1 , $annee));
                $lastDay=date("N", mktime(0, 0, 0, $mois,$l_day , $annee));

                $testhours=date("d", mktime(0, 0, 0, $mois,$l_day , $annee));

                $titre=$mois_fr[$mois]." : ".$annee;
                ?>

                <center>
                <form name="date" method="POST" action="?action=myCalendar">
                <br>
                <!--<div class="u-custom-menu u-nav-container">
                  <ul class="u-nav u-unstyled u-nav-2">
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#" style="padding: 10px 20px;">Jours</a></li>
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#" style="padding: 10px 20px;">Semaine</a></li>
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#" style="padding: 10px 20px;">Mois</a></li>
                    <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#" style="padding: 10px 20px;">Année</a></li>
                  </li></ul>-->
                <button onClick="today()" class="u-btn u-align-left">Aujourd'hui</button>

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

                  //Creation du tableau du calendrier
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
                    	$lien.="&date=".$da;
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
                      //affiche le numero du jour
                      if($i == $day && $mois == date("n") && $annee == date("Y")){
                        echo"style='background-Color:yellow' onmouseout='over(this,0,3,$i)'>".(in_array($da, array_column($alldata, 'date')) ? ('<u>'.$i.'</u>') : ($i))."</td>";
                      }
                      else{
                        echo" onmouseout='over(this,0,1,$i)'>".(in_array($da, array_column($alldata, 'date')) ? ('<u>'.$i.'</u>') : ($i))."</td>";
                      }

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
                  	if(isset($newDate['mod']))
                  		echo "<div id='notif'>Calendrier modifié</div>";
                  	elseif(isset($newDate['add']))
                  		echo "<div id='notif'>Evénement ajouté</div>";
                  ?>
                </center>
    </section>
  <script type="text/javascript">
  function change()
  {
  	document.date.submit("location:?action=myCalendar");
  }
  function today()
  {
    document.date["mois"].value = <?=date("n")?>;
    document.date["annee"].value = <?=date("Y")?>;
  	document.date.submit("location:?action=myCalendar");
  }
  function over(this_,a,t,numberDay)
  {
  	<?php
  	 echo "var c2=['$ccl2[0]','$ccl2[1]','$ccl2[2]','$ccl2[3]'];";
  	?>
  	var col;
  	if(t==2)
  		this_.style.backgroundColor=c2[a];
  	else{
      if(numberDay == <?=$day?>){
        this_.style.backgroundColor=c2[3];
      }
      else{

        this_.style.backgroundColor="";
      }
    }

  }
  function go_lien(a,this_)
  {
  	over(this_,0,1);
  	top.document.location=a;
  }
  window.onload = function(){
  //document.getElementsByTagName("body")[0].addEventListener("load", function {
      <?php
      $counter = 0;
      foreach($alldataAgenda as $data)
      {

        //TimeStamp de l'heure de debut de l'event
        $startTime = $alldataAgenda[$counter]["start time"];
        $start = new \DateTime("{$startTime}");
        $startTime = $start -> getTimeStamp();

        $startTime15Min = $startTime - 900;

        //TimeStamp de l'heure de fin de l'event
        $endTime = $alldataAgenda[$counter]["end time"];
        $end = new \DateTime("{$endTime}");
        $endTime = $end -> getTimeStamp();


        $inEvent = $endTime - $startTime;

        //TimeStamp de l'heure actuel
        $thisTime = date("G:i:s");
        $now = new \DateTime("{$thisTime}");
        $thisTime = $now -> getTimeStamp();
        //print_r($thisTime);

        $diffStartTime = $thisTime - $startTime15Min;
        $diffStartTimeReversed = $startTime - $thisTime;
        $diffStartTimeReversed = round($reversed / 60)+1;

        //popup 15 min avant
        if($diffStartTime <= 900){
          echo"alert('Vous avez un evenement qui va commencer dans environ ".$diffStartTimeReversed." minutes: ".$data["name"]."'); ";
          //print_r("bien ouej");
        }
        //popup pendant l'event
        elseif($thisTime - $startTime <= $inEvent)
        {
          echo"alert('Vous avez un evenement en cours: ".$data["name"]."'); ";
          //print_r("in time");
        }
        $counter++;
      }
      ?>

  //},false);
}

  </script>


<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
