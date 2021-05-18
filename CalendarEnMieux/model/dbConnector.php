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
 * This function is designed to execute a query received as parameter
 * @param $query : must be correctly build for sql (syntaxis) but the protection against sql injection will be done there
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return array|null : get the query result (can be null)
 * Source : http://php.net/manual/en/pdo.prepare.php
 */
function executeQuerySelect($query){
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);//prepare result for client
        /*PDO::FETCH_BOTH*/
        /*PDO::FETCH_ASSOC*/
        /*PDO::FETCH_NUM*/
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}


/**
 * This function is designed to insert value in database
 * @param $query
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return bool|null : $statement->execute() return true is the insert was successful
 */
function executeQueryInsert($query,$data)
{
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);//prepare query
        $queryResult = $statement->execute($data);//execute query
    }
    $dbConnexion = null;//close database connexion
    return $queryResult;
}


/**
 * This function is designed to manage the database connexion. Closing will be not proceeded there. The client is responsible of this.
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return PDO|null
 * Source : http://php.net/manual/en/pdo.construct.php
 */
function openDBConnexion()
{
    $tempDbConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'calenmieux21_cam';
    $userName = 'calenmieux21_cam';
    $userPwd = 'CalenMieux-21';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try
    {
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    }

    catch (PDOException $exception)
      {
        require_once "errorDbAccess.php";
        throw new errorDbAccess;
      }
    return $tempDbConnexion;
}
