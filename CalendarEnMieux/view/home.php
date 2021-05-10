<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */
 $title = "CalendarEnMieux";

 // tampon de flux stocké en mémoire
 ob_start();
 ?>
 <link rel="stylesheet" href="css/Accueil.css" media="screen">

    <section class="u-clearfix u-image u-section-1" id="carousel_93ec">
      <div class="u-clearfix u-sheet u-valign-bottom-xl u-sheet-1">
        <div class="u-align-left u-container-style u-group u-palette-5-dark-3 u-group-1">
          <div class="u-container-layout u-valign-middle u-container-layout-1">
            <h1 class="u-custom-font u-text u-text-palette-3-base u-text-1">What time is it?</h1>
            <p class="u-large-text u-text u-text-variant u-text-2">Voici mon site de gestion de calendrier pour mon TPI</p>
            <a href="#beforeMyCalendar" data-page-id="431624438" class="u-btn u-btn-round u-button-style u-palette-3-base u-radius-50 u-btn-1">Voir plus</a>
          </div>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-image u-section-2" id="beforeMyCalendar">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="u-align-center u-container-style u-group u-palette-5-base u-shape-rectangle u-group-1">
          <div class="u-container-layout u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-container-layout-1">
            <h1 class="u-text u-title u-text-1">Votre calendrier</h1>
            <p class="u-text u-text-2"> Pour pouvoir commencer a utiliser cet outil, il vous faut en premier lieu vous connnectez. Si vous n'avez pas de compte, il vous suffis d'en crée un.&nbsp;</p>
            <a href="?action=login" data-page-id="59250005" class="u-active-palette-1-base u-align-center u-border-2 u-border-palette-1-base u-btn u-button-style u-hover-palette-1-base u-none u-text-black u-text-hover-white u-btn-1">Me connecter</a>
            <a href="?action=register" data-page-id="276759126" class="u-active-palette-2-base u-align-center u-border-2 u-border-palette-2-base u-btn u-button-style u-hover-palette-2-base u-none u-text-black u-text-hover-white u-btn-2">M'enregistrer</a>
          </div>
        </div>
      </div>
    </section>

  <?php
      $content = ob_get_clean();
      require "gabarit.php";
  ?>
