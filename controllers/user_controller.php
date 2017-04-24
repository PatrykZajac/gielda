<?php
/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 15.04.2017
 * Time: 14:42
 */

class UserController {
    public function profile(){
        $user = User::user($_GET['id_user']);
        $notes = Ocena::oceny($_GET['id_user']);
        require_once ('views/user/profile.php');
    }
    public function vote(){
        $msg = User::vote($_GET['id_user'], $_GET['id_vote']);
        $user = User::user($_GET['id_user']);
        $notes = Ocena::oceny($_GET['id_user']);
        require_once ('views/user/profile.php');
    }
    public function mail(){
        if(isset($_POST['id_user_to'])&&isset($_POST['title'])&&isset($_POST['body'])){
            $msg = Mail::new_mail($_POST['id_user_to'],$_POST['title'],$_POST['body']);
        }

        $mail = Mail::inbox($_SESSION['id_user']);
        $count = Mail::mail_unread($_SESSION['id_user']);
        $type="Odebrane";
        require_once ('views/user/mail.php');
    }
    public function mail_sent(){
        $mail = Mail::sent($_SESSION['id_user']);
        $count = Mail::mail_unread($_SESSION['id_user']);
        $type="Wysłane";
        require_once ('views/user/mail.php');
    }
    public function mail_trash(){
        $mail = Mail::trash($_SESSION['id_user']);
        $count = Mail::mail_unread($_SESSION['id_user']);
        $type="Kosz";
        require_once ('views/user/mail.php');
    }
    public function mail_detail(){
        $mail = Mail::detail($_GET['id_mail']);
        $count = Mail::mail_unread($_SESSION['id_user']);
        $type="Odebrane";
        if($mail->id_user_to==$_SESSION['id_user'] || $mail->id_user_from->id==$_SESSION['id_user']) {
            if($mail->status_to==0){
                Mail::read($_GET['id_mail']);
                $count -= 1;
            }
            require_once('views/user/mail_detail.php');
        } else {
            $msg = "<div class='alert alert-danger'>Ta wiadomość nie jest adresowane do Ciebie!</div>";
            $mail = Mail::inbox($_SESSION['id_user']);
            require_once ('views/user/mail.php');
        }
    }
    public function move_to_trash(){
        $count = Mail::mail_unread($_SESSION['id_user']);
        $type="Odebrane";
        $msg = Mail::move_to_trash($_GET['id_mail']);
        $mail = Mail::inbox($_SESSION['id_user']);
        require_once ('views/user/mail.php');
    }
}