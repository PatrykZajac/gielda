<?php

/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 16.04.2017
 * Time: 19:45
 */
class Mail
{
    public $id_mail;
    public $id_user_from;
    public $id_user_to;
    public $title;
    public $body;
    public $status_from;
    public $status_to;
    public $data;

    public function __construct($id_mail, $id_user_from, $id_user_to, $title, $body, $status_from, $status_to, $data)
    {
        $this->id_mail      = $id_mail;
        $this->id_user_from = $id_user_from;
        $this->id_user_to   = $id_user_to;
        $this->title        = $title;
        $this->body         = $body;
        $this->status_from  = $status_from;
        $this->status_to    = $status_to;
        $this->data         = $data;
    }

    public static function inbox($id_user){
        $list = [];
        $db = Db::getInstance();
        $mail = $db->prepare("SELECT * FROM mail WHERE id_user_to = :id AND (status_to = 0 OR status_to = 1) ORDER BY data DESC");
        $mail->bindParam(":id", $id_user, PDO::PARAM_INT);
        $mail->execute();
        if($mail->rowCount()>0){
            foreach($mail as $r){
                $list[] = new Mail($r['id_mail'], User::user($r['id_user_from']), $r['id_user_to'], $r['title'], $r['body'], $r['status_from'], $r['status_to'], date( "H:i d M",$r['data']));

            }
        }
        else $list = "<center>Obecnie nie masz żadnych wiadomości</center>";
        return $list;
    }
    public static function sent($id_user){
        $list = [];
        $db = Db::getInstance();
        $mail = $db->prepare("SELECT * FROM mail WHERE id_user_from = :id AND (status_from = 0 OR status_from = 1) ORDER BY data DESC");
        $mail->bindParam(":id", $id_user, PDO::PARAM_INT);
        $mail->execute();
        if($mail->rowCount()>0){
            foreach($mail as $r){
                $list[] = new Mail($r['id_mail'], User::user($r['id_user_from']), $r['id_user_to'], $r['title'], $r['body'], $r['status_from'], $r['status_to'], date( "H:i d M",$r['data']));

            }
        }
        else $list = "<center>Obecnie nie masz żadnych wiadomości</center>";
        return $list;
    }
    public static function trash($id_user){
        $list = [];
        $db = Db::getInstance();
        $mail = $db->prepare("SELECT * FROM mail WHERE id_user_from = :id AND status_to = 2 ORDER BY data DESC");
        $mail->bindParam(":id", $id_user, PDO::PARAM_INT);
        $mail->execute();
        if($mail->rowCount()>0){
            foreach($mail as $r){
                $list[] = new Mail($r['id_mail'], User::user($r['id_user_from']), $r['id_user_to'], $r['title'], $r['body'], $r['status_from'], $r['status_to'], date( "H:i d M",$r['data']));

            }
        }
        else $list = "<center>Obecnie nie masz żadnych wiadomości</center>";
        return $list;
    }
    public static function detail($id_mail){
        $db = Db::getInstance();
        $mail = $db->prepare("SELECT * FROM mail WHERE id_mail = :id");
        $mail->bindParam(":id", $id_mail, PDO::PARAM_INT);
        $mail->execute();
        $r = $mail->fetch();
        return new Mail($r['id_mail'], User::user($r['id_user_from']), $r['id_user_to'], $r['title'], $r['body'], $r['status_from'], $r['status_to'], date( "H:i d M",$r['data']));
    }
    public static function mail_unread($id_user){
        $db = Db::getInstance();
        $count = $db->prepare("SELECT count(*) as suma FROM mail WHERE id_user_to = :id AND status_to = 0");
        $count->bindParam(":id", $id_user, PDO::PARAM_INT);
        $count->execute();
        $count_fetch = $count->fetch();
        return $count_fetch['suma'];
    }
    public static function read($id_mail){
        $db = Db::getInstance();
        $mail = $db->prepare("UPDATE mail SET status_to = 1 WHERE id_mail = :id");
        $mail->bindParam(":id", $id_mail, PDO::PARAM_INT);
        $mail->execute();
    }
    public static function new_mail($id, $title, $body){
        $time = time();
        $db = Db::getInstance();
        $insert = $db->prepare("INSERT INTO `mail`(`id_user_from`, `id_user_to`, `title`, `body`, `data`) VALUES (:id_user_from, :id_user_to, :title, :body, :data_time)");
        $insert->bindParam(":id_user_from", $_SESSION['id_user'], PDO::PARAM_INT);
        $insert->bindParam(":id_user_to", $id, PDO::PARAM_INT);
        $insert->bindParam(":title", $title, PDO::PARAM_STR);
        $insert->bindParam(":body", $body, PDO::PARAM_STR);
        $insert->bindParam(":data_time", $time, PDO::PARAM_INT);
        $insert->execute();
        return "<div class='alert alert-success'>Pomyślnie wysłano wiadomość</div>";
    }
    public static function move_to_trash($id_mail){
        $db = Db::getInstance();
        $select = $db->prepare("SELECT * FROM mail WHERE id_mail = :id");
        $select->bindParam(":id", $id_mail, PDO::PARAM_INT);
        $select->execute();
        $select_fetch = $select->fetch();
        if($select_fetch['id_user_to']==$_SESSION['id_user']){
            $update = $db->prepare("UPDATE mail SET status_to = 2 WHERE id_mail = :id");
            $update->bindParam(":id", $id_mail, PDO::PARAM_INT);
            $update->execute();
            return "<div class='alert alert-success'>Pomyślnie przeniesionio wiadomość do kosza.</div>";
        }
        return "<div class='alert alert-danger'>Ta wiadomość nie jest adresowana do Ciebie.</div>";
    }
}