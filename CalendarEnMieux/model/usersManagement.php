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
* This function is designed to verify user's login
* @param $email
* @param $userPsw
* @throws ErrorDbAccess : Raise if database connexion fail
* @return bool : true only if the user and psw match the database. In all other cases will be false
*/
function isLoginCorrect($email, $userPsw)
{
   $result = false;

   $strSeparator = '\'';
   $loginQuery = 'SELECT password, ID, pseudo FROM users WHERE email = '.$strSeparator.$email.$strSeparator;

   require_once 'model/dbConnector.php';
   $queryResult = executeQuerySelect($loginQuery);

   if (count($queryResult) == 1)
   {
       $passwordHash = $queryResult[0]['password'];
       if(password_verify($userPsw, $passwordHash))
       {
           $result = $queryResult[0];
       }
       else
       {
           $result = false;
       }
   }
   return $result;
}

  /**
  * This function is designed to register a new account
  * @param $email
  * @param $pseudo
  * @param $userPsw
  * @throws ErrorDbAccess : Raise if database connexion fail
  * @return bool|null
  */
  function registerNewAccount($email, $pseudo, $userPsw)
  {
     $result = false;

     $strSeparator = '\'';

     $registerTest = 'SELECT email FROM users WHERE email = '.$strSeparator.$email.$strSeparator;
     require_once 'model/dbConnector.php';
     $queryTest = executeQuerySelect($registerTest);

     if($queryTest == null){

       $pswHash = password_hash($userPsw, PASSWORD_DEFAULT);

       $registerQuery = 'INSERT INTO users (`email`, `pseudo`, `password`) VALUES (:email, :pseudo, :password)';
       $registerData = array(":email"=>$email, ":pseudo"=>$pseudo, ":password"=>$pswHash);

       /*require_once 'model/dbConnector.php';*/
       $queryResult = executeQueryInsert($registerQuery,$registerData);

       $registerQuery2 = 'SELECT ID FROM users WHERE email = '.$strSeparator.$email.$strSeparator;

       $queryResult2 = executeQuerySelect($registerQuery2);

       if($queryResult and $queryResult2){
           $result = $queryResult2[0]["ID"];
       }
       else
       {
           $result = false;
       }

       return $result;
     }
     else{

       $result = false;
       return $result;
     }

  }
