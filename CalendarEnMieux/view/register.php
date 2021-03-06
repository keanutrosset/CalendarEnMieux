<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */
 $title = "CalendarEnMieux - Register";

 // tampon de flux stocké en mémoire
 ob_start();
 ?>
 <link rel="stylesheet" href="css/Register.css" media="screen">

    <section class="u-clearfix u-palette-3-light-3 u-section-1" id="sec-1b9a">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-shape u-shape-svg u-text-palette-2-base u-shape-1">
          <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 140" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-60e1"></use></svg>
          <svg class="u-svg-content" viewBox="0 0 160 140" x="0px" y="0px" id="svg-60e1"><path d="M120,140H40L0,70L40,0h80l40,70L120,140z"></path></svg>
        </div>

        <h3 class="u-align-center u-text u-text-palette-3-light-1 u-text-1">Register</h3>
        <div class="u-form u-form-1">

          <form action="?action=register" method="POST" style="padding: 10px" name="form">
            <div class="u-form-group u-form-name u-form-group-1">
              <label for="name-f13a" class="u-form-control-hidden u-label">pseudo</label>
              <input type="text" placeholder="Entrez votre pseudo" id="name-f13a" maxlength="12" name="inputPseudo" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" autofocus="autofocus">
            </div>
            <br>
            <div class="u-form-email u-form-group">
              <label for="email-3b9a" class="u-form-control-hidden u-label">Email</label>
              <input type="email" placeholder="Entrez une adresse email valide" id="email-3b9a" name="inputEmail" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <br>
            <div class="u-form-group u-form-name">
              <label for="name-3b9a" class="u-form-control-hidden u-label">Password</label>
              <input type="password" placeholder="Entrez votre mot de passe" id="name-3b9a" name="inputUserPsw" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <br>
            <div class="u-form-group u-form-group-4">
              <label for="text-6355" class="u-form-control-hidden u-label">Password Repeat</label>
              <input type="password" placeholder="Confirmez votre mot de passe" id="text-6355" name="inputUserPswRepeat" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <a class="u-btn u-btn-submit u-button-style u-hover-palette-3-light-1 u-palette-3-base u-btn-1">Submit</a>
              <input type="submit" class="u-form-control-hidden">
            </div>
            <!--<div class="u-form-send-message u-form-send-success"> Vous vous êtes connecter avec succès. </div>
            <div class="u-form-send-error u-form-send-message"> Vous n'avez pas reussi à vous connecter, veuillez ressayer. </div>
            <input type="hidden" value="" name="recaptchaResponse">-->
          </form>
        </div>
        <div class="u-align-center u-input u-input-rectangle u-form-send-error u-form-send-message" style="width:15rem; margin:auto;visibility:<?= @$_GET['registerError'] ? 'visible' : 'hidden' ?>"> Ce compte existe déjà ou le mot de passe n'est pas le même, veuillez ressayer. </div>
        <a class="u-align-center u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-3-base u-btn-3" style="margin:auto;margin-top:-30px" href="?action=login" >Vous avez deja un compte?</a>
        <p class="u-text u-text-palette-3-dark-2 u-text-2" >Veuillez entrez vos information de connection pour pouvoir acceder à la suite</p>

        </p>
      </div>
    </section>

<?php
  $content = ob_get_clean();
  require "gabarit.php";
?>
