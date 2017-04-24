<?php

/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 14.04.2017
 * Time: 23:26
 */
class Admin
{
    public function usun($id){
        $db = Db::getInstance();
        $usun = $db->prepare("UPDATE oferty SET stan = 2 WHERE id_oferty = :id");
        $usun->bindParam(":id", $id, PDO::PARAM_INT);
        $usun->execute();
        $zgloszenie = $db->prepare("UPDATE zgloszenia SET status = 1 WHERE id_oferty = :id");
        $zgloszenie->bindParam(":id", $id, PDO::PARAM_INT);
        $zgloszenie->execute();
        return "<div class='alert alert-success'>Pomyślnie usunięto zgłoszone zlecenie.</div>";
    }
    public function zostaw($id){
        $db = Db::getInstance();
        $zgloszenie = $db->prepare("UPDATE zgloszenia SET status = 1 WHERE id_oferty = :id");
        $zgloszenie->bindParam(":id", $id, PDO::PARAM_INT);
        $zgloszenie->execute();
        return "<div class='alert alert-success'>Pomyślnie oznaczono zgłoszenie jako przeczytane.</div>";

    }
}