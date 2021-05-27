<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

 function home()
 {
     ob_start();
     require "view/home.php";
     exit();
 }


 function contact(){
   require "view/contact.php";
   exit();
 }

 function myCalendar(){
   if(isset($_SESSION["userID"]))
   {
       $newDate=date("n");
       $mois=date("m");
       $day=date("j");
       $annee=date("Y");
       $da=$annee."-".$mois."-".$day;



       require "model/eventsManagement.php";

       $alldataAgenda = showData($da);

       require "view/myCalendar.php";
   }
   else
   {
       $_POST["loginMessage"] = 0;
       require "view/login.php";
   }
 }

 function changeDate($newDate){

   require "view/myCalendar.php";
   exit();
 }

 function seeAnEvent($date){

   require "model/eventsManagement.php";

   $allEvents = selectAllEvents($date["date"]);

   require "view/gestionOfCalendar.php";
   //header("location:?gestionOfCalendar.php$Date");
 }

 /**
  * This function is designed to manage login request
  * @param $loginRequest : contain login fields required to authenticate the user
  */
 function login($loginRequest, $redirect)
 {
     //If a login request was submitted
     if (isset($loginRequest['inputEmail']) && isset($loginRequest['inputUserPsw']))
     {
         //Extract login parameters
         $email = $loginRequest['inputEmail'];
         $userPsw = $loginRequest['inputUserPsw'];

         try
         {
             require_once "model/usersManagement.php";
             //Check if user/psw are matching with the database
             $userLog = isLoginCorrect($email, $userPsw);
         }
         catch (ErrorDbAccess $e)
         {
             home("Erreur","Notre site est en maintenance, merci pour votre compréhension");
             exit();
         }

         if ($userLog)
         {
             createSession($email, $userLog["pseudo"], $userLog["ID"]);

             $_GET['loginError'] = false;
             header("Location:?action=".$redirect);
             exit();
         }
         //If the user/psw doesn't match, login form appears again
         else
         {
             $_GET['loginError'] = true;
             $action = "login";
             require "view/login.php";
             exit();
         }
     }
     //The user hasn't filled the form yet
     else
     {
         $action = "login";
         require "view/login.php";
         exit();
     }
 }


 /**
  * This function is designed to display the register page or register the user if the inputs are filled
  * @param $registerRequest : contain register fields required to test and create the user
  */
 function register($registerRequest)
 {
     //If a register request was submitted
     if (isset($registerRequest['inputPseudo']) && isset($registerRequest['inputEmail']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat']))
     {

         //Extract register parameters
         $pseudo = $registerRequest['inputPseudo'];
         $email = $registerRequest['inputEmail'];
         $userPsw = $registerRequest['inputUserPsw'];
         $userPswRepeat = $registerRequest['inputUserPswRepeat'];

         if ($userPsw == $userPswRepeat)
         {
             try
             {
                 require_once "model/usersManagement.php";
                 $userID = registerNewAccount($email, $pseudo, $userPsw);
             }
             catch (ErrorDbAccess $e)
             {
                 home("<br><br><br><br>Erreur","Notre site est en maintenance, merci pour votre compréhension");
                 exit();
             }

             if ($userID)
             {
                 createSession($email, $pseudo, $userID);

                 $_GET['registerError'] = false;
                 $action = "home";
                 home();
                 exit();
             }
             else{
               $_GET['registerError'] = true;
               $action = "register";
               require "view/register.php";
               exit();
             }
         }
         //If submitted passwords doesn't match or email already exist
         else
         {
             $_GET['registerError'] = true;
             $action = "register";
             require "view/register.php";
             exit();
         }
     }
     else
     {
         $action = "register";
         require "view/register.php";
         exit();
     }
 }

 function profil()
 {
   if(isset($_SESSION["userID"]))
   {

       require "view/profil.php";
   }
   else
   {
       $_POST["loginMessage"] = 5;
       require "view/login.php";
   }
 }

 /**
  * This function is designed to create a new user session
  * Also store user's rents if there is any in the database
  * @param $email : Email address to store in session
  * @param $userID : User unique id address to store in session
  */
 function createSession($email, $pseudo, $userID)
 {
     $_SESSION['email'] = $email;
     $_SESSION['pseudo'] = $pseudo;
     $_SESSION['userID'] = $userID;
 }


 /**
  * This function is designed to manage logout request
  */
 function logout()
 {
     $_SESSION = array();
     session_destroy();

     $action = "home";
     home();
     exit();
 }
