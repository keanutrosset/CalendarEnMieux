<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

  $title = "CalendarEnMieux - Profil";

 // tampon de flux stocké en mémoire
ob_start();
 ?>

 <link rel="stylesheet" href="css/Profil.css" media="screen">

    <section class="u-clearfix u-image u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-section-1" id="carousel_61fd" data-image-width="1980" data-image-height="1409">
      <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
        <div class="u-layout">
          <div class="u-layout-row">
            <div class="u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
              <div class="u-container-layout u-valign-top u-container-layout-1">
                <h1 class="u-align-center u-custom-font u-font-lato u-text u-text-palette-5-dark-2 u-text-1">Mon profil</h1>
                <h5 class="u-align-center u-text u-text-2"><?= $_SESSION["pseudo"]; ?></h5>

                <h2 class="u-align-left u-text u-text-3">Changer d'email</h2>
                <div class="u-form u-form-1">
                  <form action="#" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px;" source="custom">
                    <div class="u-form-email u-form-group">
                      <label for="email-ef64" class="u-form-control-hidden u-label">Email</label>
                      <input type="email" placeholder="Veuillez mettre votre nouvel email" id="email-ef64" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-submit">
                      <a href="#" class="u-btn u-btn-submit u-button-style">Submit</a>
                      <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success">#FormSendSuccess</div>
                    <div class="u-form-send-error u-form-send-message">#FormSendError</div>
                    <input type="hidden" value="" name="recaptchaResponse">
                  </form>
                </div>

                <h2 class="u-align-left u-text u-text-4">Changer De mot de passe</h2>
                <div class="u-form u-form-1">
                  <form action="#" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-15 u-inner-form" style="padding: 15px;" source="custom">
                    <div class="u-form-email u-form-group">
                      <label for="email-ef64" class="u-form-control-hidden u-label">Email</label>
                      <input type="email" placeholder="Veuillez mettre votre nouveau mot de passe" id="email-ef64" name="email" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
                    </div>
                    <div class="u-form-group u-form-submit">
                      <a href="#" class="u-btn u-btn-submit u-button-style">Submit</a>
                      <input type="submit" value="submit" class="u-form-control-hidden">
                    </div>
                    <div class="u-form-send-message u-form-send-success">#FormSendSuccess</div>
                    <div class="u-form-send-error u-form-send-message">#FormSendError</div>
                    <input type="hidden" value="" name="recaptchaResponse">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <a href="?action=logout" class="u-border-1 u-input u-input-rectangle u-btn u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-50" style="margin-top:-20px">Se deconnecter</a>
    </section>


    <?php
      $content = ob_get_clean();
      require 'gabarit.php';
    ?>
