<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : TPI CalendarEnMieux
 * Created  : 06.05.2021
 *
 * Git source  : [https://github.com/keanutrosset/CalendarEnMieux]
 *
 */

 /**
  * This function is designed to show the home page
  */
 function home()
 {
     ob_start();
     require "view/home.php";
     exit();
 }

 /**
  * This function is designed to show the contact page
  */
 function contact(){
   require "view/contact.php";
   exit();
 }

 /**
  * This function is designed to show the calendar
  * Also if the date has been changed on the calendar, we pass here again with the new value
  * @param $newDate : Contain the month and year sent by the calendar when we change the date
  */
 function myCalendar($newDate){
   if(isset($_SESSION["userID"]))
   {
       /*$newDate=date("n");
       $newMois=date("m");*/
       $day=date("j");
       //$newannee=date("Y");

       // check if he need to show the date of today or another date
       if(isset($newDate['mois']) && isset($newDate['annee']))
       {
         $da=$newDate["annee"]."-".$newDate["mois"]."-".$day;
       }
       else
       {
         $newDate["mois"]=date("n");
         $newDate["annee"]=date("Y");
         $da=$newDate["annee"]."-".$newDate["mois"]."-".$day;
       }

       require_once "model/eventsManagement.php";

       $alldataAgenda = showData($da);

       $alldata = showAllData($_SESSION["userID"]);

       require "view/myCalendar.php";
   }
   else
   {
       $_POST["loginMessage"] = 0;
       require "view/login.php";
   }
 }

 function changeDate($newDate){

   require_once "view/myCalendar.php";
   exit();
 }

 /**
  * This function is designed to see the all the event/recurrence of a date when we click on a date of the calendar
  * @param $date : contain the date to the format yyyy-mm-dd
  */
 function seeAnEvent($date){

   require_once "model/eventsManagement.php";

   $allEvents = selectAllEvents($date["date"]);

   $allRecurence = selectAllRecurrence($date["date"]);

   foreach($allRecurence as $recurrence){
     array_push($allEvents,$recurrence);
  }

   require "view/gestionOfCalendar.php";
 }

 /**
  * This function is designed to manage login request
  * @param $loginRequest : contain login fields required to authenticate the user
  * @param $redirect : contain "home", prevent the user to refresh the page and recreate an account or log in one more time
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

 /**
  * This function is designed to redirect to the profil page
  */
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
  * This function is designed to create a new session which will be usefull for everything who need to be log in
  * @param $email : Email address to store in session
  * @param $pseudo : User pseudo to store in session
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
  * Also destroy the session
  */
 function logout()
 {
     $_SESSION = array();
     session_destroy();

     $action = "home";
     home();
     exit();
 }
