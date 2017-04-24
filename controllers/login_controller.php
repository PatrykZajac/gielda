<?php
/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 14.04.2017
 * Time: 14:14
 */

class LoginController {
    public function login_user(){
        if(isset($_POST['login'])&&isset($_POST['pass'])){
            $msg = Login::login($_POST['login'], $_POST['pass']);
            if($msg == "OK") header("Location: index.php?controller=offers&action=list_all");
        }
        require_once ('views/login/login.php');
    }
    public function register_user(){
        if(!empty($_POST['imie'])&&!empty($_POST['nazwisko'])&&!empty($_POST['login'])&&!empty($_POST['pass'])&&!empty
            ($_POST['pass2'])&&!empty($_POST['email'])){
            $msg = Login::register($_POST['login'], $_POST['pass'], $_POST['pass2'], $_POST['email'], $_POST['imie'], $_POST['nazwisko'], $_POST['telefon']);
        }elseif((empty($_POST['imie'])||empty($_POST['nazwisko'])||empty($_POST['login'])||empty($_POST['pass'])||empty
                ($_POST['pass2'])||empty($_POST['email']))&&(isset($_POST['imie'])&&isset($_POST['nazwisko'])&&isset
                ($_POST['login'])&&isset($_POST['pass'])&&isset($_POST['pass2'])&&isset($_POST['email']))) {
            $msg = "<div class='alert alert-danger'>Wypełnij wszystkie wymagane pola!</div>";
        }

        require_once ('views/login/register.php');
    }
    public function logout_user(){
        session_destroy();
        header ('Location: index.php');
    }
    public function settings_user(){
        if(isset($_POST['pass'])&&isset($_POST['pass2'])&&isset($_POST['old_pass'])){
            $msg = Login::change_pass($_POST['pass'], $_POST['pass2'], $_POST['old_pass']);
        }
        require_once ('views/login/settings.php');
    }
}