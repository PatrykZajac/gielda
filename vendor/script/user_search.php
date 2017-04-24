<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once ("../../connection.php");
$return = "";
$db = Db::getInstance();
$string = "%".$_POST['str']."%";
$select = $db->prepare("SELECT imie, nazwisko, login, id FROM users WHERE login LIKE :login");
$select->bindParam(":login", $string, PDO::PARAM_STR);
$select->execute();
foreach($select as $r){
    $return .= "<span class='col-md-12' onclick='autocomplite(".$r['id'].", \"".$r['login']."\")'>".$r['login']." (".$r['imie']." ".$r['nazwisko'].")</span><br />";
}
if($return != ""){
    echo $return;
}
else echo "Brak odpowiadających wyników";
