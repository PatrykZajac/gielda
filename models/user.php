<?php

/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 15.04.2017
 * Time: 14:25
 */
class User
{
    public $id;
    public $name;
    public $surname;
    public $login;
    public $email;
    public $phone;
    public $permission;
    public $photo;

    public function __construct($id, $name, $surname, $login, $email, $phone, $permission, $photo)
    {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->permission = $permission;
        $this->photo = $photo;
    }
    public static function user($id){
        $db = Db::getInstance();
        $user = $db->prepare("SELECT * FROM users WHERE id = :id");
        $user->bindParam(":id", $id, PDO::PARAM_INT);
        $user->execute();
        $user_fetch = $user->fetch();
        return new User($user_fetch['id'], $user_fetch['imie'], $user_fetch['nazwisko'], $user_fetch['login'], $user_fetch['email'], $user_fetch['telefon'], $user_fetch['permission'], $user_fetch['photo'] );
    }
    public static function vote($id, $id_vote){
        $db = Db::getInstance();

        $select = $db->prepare("SELECT count(*) as suma FROM notes WHERE id_user = :id AND ip = :ip");
        $select->bindParam(":id", $id, PDO::PARAM_INT);
        $select->bindParam(":ip", $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
        $select->execute();
        $select_fetch = $select->fetch();
        if($select_fetch['suma']==0){
            $insert = $db->prepare("INSERT INTO notes (id_user, id_star, add_data, ip) VALUES (:id, :star, :data, :ip)");
            $insert->bindParam(":id", $id, PDO::PARAM_INT);
            $insert->bindParam(":star", $id_vote, PDO::PARAM_INT);
            $insert->bindParam(":data", time(), PDO::PARAM_INT);
            $insert->bindParam(":ip", $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
            $insert->execute();
            return "<div class='alert alert-success'>Pomyślnie dodano ocenę użytkownika.</div>";
        }

        else return "<div class='alert alert-danger'>Oceniałeś już tego użytkownika.</div>";
    }

}