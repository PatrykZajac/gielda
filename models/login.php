<?php

/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 14.04.2017
 * Time: 14:15
 */
class Login
{
    public $login;
    public $pass;

    public function __construct($login, $pass){
        $this->login = $login;
        $this->pass = $pass;
    }
    public static function login($login, $pass){
        $password = md5(sha1($pass));
        $db = Db::getInstance();
        $select = $db->prepare("SELECT * FROM users WHERE login = :login AND haslo = :pass");
        $select->bindParam(":login", $login, PDO::PARAM_STR);
        $select->bindParam(":pass", $password, PDO::PARAM_STR);
        $select->execute();
        if($select->rowCount()>0){
            $select_fetch = $select->fetch();
            $_SESSION = array();
            $_SESSION['id_user'] = $select_fetch['id'];
            $_SESSION['nazwa'] = $select_fetch['login'];
            $_SESSION['nazwa'] = $select_fetch['login'];
            $_SESSION['permission'] = $select_fetch['permission'];
            return "OK";
        } else return "<div class='alert alert-danger'>Podany login i hasło nie pasują do siebie.</div>";
    }
    public static function register($login, $pass, $pass2, $email, $imie, $nazwisko, $telefon){
        $db = DB::getInstance();
        $check = $db->prepare("SELECT count(*) as suma FROM users WHERE login = :login OR email = :email");
        $check->bindParam(":login", $login, PDO::PARAM_STR);
        $check->bindParam(":email", $email, PDO::PARAM_STR);
        $check->execute();
        $check_fetch = $check->fetch();
        if ($check_fetch['suma'] == 0) {
            if($pass==$pass2) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $new_user = $db->prepare("INSERT INTO `users`(`imie`, `nazwisko`, `email`, `login`, `haslo`, 
    `telefon`, `data_dolaczenia`) VALUES (:imie, :nazwisko, :email, :login, :haslo, :telefon, 
    :data_dolaczenia)");
                    if (!empty($_POST['telefon'])) $phone = $telefon;
                    else $phone = NULL;
                    $new_user->bindParam(":imie", $imie, PDO::PARAM_STR);
                    $new_user->bindParam(":nazwisko", $nazwisko, PDO::PARAM_STR);
                    $new_user->bindParam(":email", $email, PDO::PARAM_STR);
                    $new_user->bindParam(":login", $login, PDO::PARAM_STR);
                    $new_user->bindParam(":haslo", md5(sha1($pass)), PDO::PARAM_STR);
                    $new_user->bindParam(":telefon", $phone, PDO::PARAM_STR);
                    $new_user->bindParam(":data_dolaczenia", time(), PDO::PARAM_INT);
                    $new_user->execute();
                    return "<div class='alert alert-success'>Pomyślnie utworzono nowe konto</div>";
                } else return "<div class='alert alert-danger'>To nie jest adres email</div>";
            } else return "<div class='alert alert-danger'>Podane hasła nie pasują do siebie</div>";
        } else return "<div class='alert alert-danger'>Podany login lub email są już zajęte!</div>";
    }
    public static function change_pass($pass, $pass2, $old_pass){
        if($pass!=$pass2) return "<div class='alert alert-danger'>Podane hasła nie psują do siebie.</div>";

        $db = Db::getInstance();
        $user = $db->prepare("SELECT * FROM users WHERE id = :id");
        $user->bindParam(":id", $_SESSION['id_user'], PDO::PARAM_INT);
        $user->execute();
        $user_fetch = $user->fetch();
        if(md5(sha1($pass))==$user_fetch['haslo']) return "<div class='alert alert-danger'>Nowe hasło musi się różnić od starego!</div>";
        $update = $db->prepare("UPDATE users SET haslo = :pass WHERE id = :id");
        $update->bindParam(":pass", md5(sha1($pass)), PDO::PARAM_STR);
        $update->bindParam(":id", $_SESSION['id_user'], PDO::PARAM_STR);
        $update->execute();
        return "<div class='alert alert-success'>Pomyślnie zmieniono hasło.</div>";
    }
}