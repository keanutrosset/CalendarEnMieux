<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */
 ?>

 <!DOCTYPE html>
<html style="font-size: 16px;" lang="fr-CH">
<!-- Header-->
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="What time is it?">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title><?=$title;?></title>
    <link rel="stylesheet" href="css/nicepage.css" media="screen">

    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.13.2, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quando:400|Boogaloo:400">




    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "TPI template",
		"url": "index.html"
}</script>
    <meta property="og:title" content="Accueil">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
  </head>

  <!-- Body-->
  <body class="u-body"><header class="u-clearfix u-header u-palette-2-light-1 u-sticky u-header" id="sec-d6e8"><div class="u-clearfix u-sheet u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#calendarHome"></use></svg>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="calendarHome" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
            </a>
          </div>
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="?action=home" style="padding: 10px 20px;">Accueil</a>

<?php if(isset($_SESSION["userID"])):?>
    </li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="?action=profil" style="padding: 10px 20px;">Profil</a>
    </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=myCalendar" style="padding: 10px 20px;">Mon Calendrier</a>
<?php else:?>
    </li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="?action=login" style="padding: 10px 20px;">Se connecter / S'enregistrer</a></li>
<?php endif?>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="?action=contact" style="padding: 10px 20px;">Contact</a>

</li></ul>
          </div>
          <div class="u-custom-menu u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=home" style="padding: 10px 20px;">Accueil</a>

                <?php if(isset($_SESSION["userID"])):?>
                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=profil" style="padding: 10px 20px;">Profil</a>
                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=myCalendar" style="padding: 10px 20px;">Mon Calendrier</a>
                <?php else:?>
                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=login" style="padding: 10px 20px;">Se connecter / S'enregistrer</a>
                <?php endif?>
                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="?action=contact" style="padding: 10px 20px;">Contact</a>
                </li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
        <h1 class="u-text u-text-1">
          <a class="u-border-2 u-border-palette-1-base u-btn u-button-style u-custom-font u-none u-text-active-palette-4-light-2 u-text-hover-palette-4-base u-text-palette-1-base u-btn-1" href="?action=home" data-page-id="431624438">CalendarEnMieux</a>
        </h1>
      </div></header>

    <!--__________CONTENU__________-->
    <div class="bg-light" id="divMain">
    <?=$content; ?>
    </div>

    <!--________FIN CONTENU________-->

    <!-- Footer-->
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-da5a"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1"> Keanu Trosset | TPI 2021</p>
      </div></footer>
  </body>
</html>
