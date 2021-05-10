<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */
  $title = "CalendarEnMieux - Login";

  // tampon de flux stocké en mémoire
  ob_start();
  ?>
   <link rel="stylesheet" href="css/Login.css" media="screen">

    <section class="u-align-center u-clearfix u-palette-3-light-3 u-section-1" id="carousel_d794">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-expanded-width-sm u-expanded-width-xs u-shape u-shape-svg u-text-palette-1-light-1 u-shape-1">
          <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 140" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-60e1"></use></svg>
          <svg class="u-svg-content" viewBox="0 0 160 140" x="0px" y="0px" id="svg-60e1"><path d="M120,140H40L0,70L40,0h80l40,70L120,140z"></path></svg>
        </div>
        <div class="u-form u-form-1">
          <form action="#" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px" source="custom" name="form">
            <div class="u-form-email u-form-group">
              <label for="email-3b9a" class="u-form-control-hidden u-label">Email</label>
              <input type="email" placeholder="Entrez une adresse email valide" id="email-3b9a" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </div>
            <div class="u-form-group u-form-name">
              <label for="name-3b9a" class="u-form-control-hidden u-label">Name</label>
              <input type="text" placeholder="Entrez votre mot de passe" id="name-3b9a" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <a href="#" class="u-btn u-btn-submit u-button-style u-hover-palette-4-light-1 u-palette-4-base u-btn-1">Submit</a>
              <input type="submit" value="submit" class="u-form-control-hidden">
            </div>
            <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
            <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
            <input type="hidden" value="" name="recaptchaResponse">
          </form>
        </div>
        <p class="u-text u-text-palette-4-dark-2 u-text-1">Veuillez entrez vos information de connection pour pouvoir acceder à la suite</p>
        <p class="u-text u-text-palette-4-dark-2 u-text-2">
          <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-4-dark-2 u-btn-2" href="?action=register" data-page-id="276759126">Vous n'avez pas de compte?</a>
        </p>
        <h3 class="u-align-center u-text u-text-3">Login</h3>
      </div>
    </section>

      <?php
          $content = ob_get_clean();
          require "gabarit.php";
      ?>
