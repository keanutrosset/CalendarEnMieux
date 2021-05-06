<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


session_start();

/*print_r("<br><br><br><br>");
print_r($_SESSION);*/

require "controler/event.php";
require "controler/user.php";


if (isset($_GET['action']))
{
  $action = $_GET['action'];

  switch ($action)
  {
      case 'home' :
          home();
          break;

      case 'login' :
          login($_POST, "home");
          break;

      case 'logout' :
          logout();
          break;

      case 'register' :
          register($_POST);
          break;

     case 'profil' :
          profil();
          break;

      case 'contact':
          contact();
          break;

      default :
          home();
  }
}
else
{
    home();
}