<?php

class Offer
{
    public $id;
    public $id_user;
    public $login;
    public $phone;
    public $email;
    public $category;
    public $quality;
    public $level;
    public $class;
    public $school;
    public $price;
    public $description;
    public $photo;
    public $title;
    public $reason;
    public function __construct($id, $id_user, $phone, $email, $category, $quality, $level, $class, $school, $price, $description, $photo, $title, $reason) {
        $this->id           = $id;
        $this->id_user      = $id_user;
        $this->phone        = $phone;
        $this->email        = $email;
        $this->category     = $category;
        $this->quality      = $quality;
        $this->level        = $level;
        $this->class        = $class;
        $this->school       = $school;
        $this->price        = $price;
        $this->description  = $description;
        $this->photo        = $photo;
        $this->title        = $title;
        $this->reason       = $reason;
    }
    public static function all($post){
        $list = [];
        $db = DB::getInstance();
        $select = "SELECT * FROM oferty INNER JOIN kategorie ON oferty.id_kategoria = kategorie.id_kategoria INNER JOIN users ON oferty.id_user = users.id";
        $temp = 0;
        $param = [];
        if($post['od']>0){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="cena >= :cena_min";
            $param["cena_min"] = $post['od'];
        }
        if($post['do']>0){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="cena <= :cena_max";
            $param["cena_max"] = $post['do'];
        }
        if($post['stan-nowe']=="on"||$post['stan-uzywane']=="on"){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            if($post["stan-nowe"]=="on"&&!isset($post['stan-uzywane'])){
                $select.="id_stan = 1";
            }
            elseif($post["stan-uzywane"]=="on"&&!isset($post['stan-nowe'])){
                $select.="id_stan = 2";
            }
            elseif($post["stan-nowe"]=="on"&&$post['stan-uzywane']=="on"){
                $select.="id_stan IN (1, 2)";
            }
        }
        if($post['klasa']>0){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="id_klasa = :klasa";
            $param['klasa'] = $post['klasa'];
        }
        if($post['poziom']>0){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="id_poziom = :poziom";
            $param['poziom'] = $post['poziom'];
        }
        if($post['szkola-liceum']=="on"||$post['szkola-technikum']=="on"){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            if($post["szkola-liceum"]=="on"&&!isset($post['szkola-technikum'])){
                $select.="id_szkola IN (1, 3)";
            }
            elseif($post["szkola-technikum"]=="on"&&!isset($post['szkola-liceum'])){
                $select.="id_szkola IN (2, 3)";
            }
            elseif($post["szkola-liceum"]=="on"&&$post['szkola-technikum']=="on"){
                $select.="id_szkola IN (1, 2, 3)";
            }
        }
        if(!empty($post['przedmiot'])){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="tytul like :tytul";
            $param['tytul'] = "%".$post['przedmiot']."%";
        }
        if($post['kategoria']>0){
            if($temp==0) {$select.=" WHERE "; $temp=1;}
            elseif($temp==1) $select.=" AND ";
            $select.="oferty.id_kategoria = :kategoria";
            $param['kategoria'] = $post['kategoria'];
        }
        if($temp==0) $select.=" WHERE stan = 0";
        elseif($temp==1) $select.=" AND stan = 0";




        $offers = $db->prepare($select);
        $offers->execute($param);

        // we create a list of Post objects from the database results
        if($offers->rowCount()>0){
            foreach($offers as $r) {
                $quality_temp = "";
                $class_temp = "";
                $level_temp = "";
                $school_temp = "";
                if($r['id_stan']==1) $quality_temp = "Nowe";
                elseif($r['id_stan']==2) $quality_temp = "Używane";
                switch ($r['id_klasa']) {
                    case 1:
                        $class_temp .= "Klasa 1";
                        break;
                    case 2:
                        $class_temp .= "Klasa 2";
                        break;
                    case 3:
                        $class_temp .= "Klasa 3";
                        break;
                    case 4:
                        $class_temp .= "Klasa 4";
                        break;
                    case 5:
                        $class_temp .= "Klasy 1-3";
                        break;
                    case 6:
                        $class_temp .= "Klasy 1-4";
                        break;
                }
                switch ($r['id_szkola']) {
                    case 1:
                        $school_temp .= "Liceum";
                        break;
                    case 2:
                        $school_temp .= "Technikum";
                        break;
                    case 3:
                        $school_temp .= "Liceum/Technikum";
                        break;
                }
                if ($r['id_poziom'] == 1) $level_temp .= "Poziom podstawowy";
                elseif ($r['id_poziom'] == 2) $level_temp .= "Poziom rozszerzony";
                $list[] = new Offer($r['id_oferty'], $r['id_user'], $r['telefon'], $r['email'], $r['nazwa'], $quality_temp, $level_temp, $class_temp, $school_temp, $r['cena'], $r['opis'], $r['zdjecie'], $r['tytul']);
            }
            //$list['type'] = "list";
            return $list;
        }
        else return "Obecnie nie ma ofert spełniających podane parametry wyszukiwania.";
    }
    public static function detail($id){
        $list = [];
        $db = DB::getInstance();
        $select = "SELECT * FROM oferty INNER JOIN kategorie ON oferty.id_kategoria = kategorie.id_kategoria INNER JOIN users ON oferty.id_user = users.id WHERE oferty.id_oferty = :id";
        $offers = $db->prepare($select);
        $offers->bindParam(":id", $id, PDO::PARAM_INT);
        $offers->execute();
        $offers_fetch = $offers->fetch();
        // we create a list of Post objects from the database results
        $quality_temp = "";
        $class_temp = "";
        $level_temp = "";
        $school_temp = "";
        if($offers_fetch['id_stan']==1) $quality_temp = "Nowe";
        elseif($offers_fetch['id_stan']==2) $quality_temp = "Używane";
        switch ($offers_fetch['id_klasa']) {
            case 1:
                $class_temp .= "Klasa 1";
                break;
            case 2:
                $class_temp .= "Klasa 2";
                break;
            case 3:
                $class_temp .= "Klasa 3";
                break;
            case 4:
                $class_temp .= "Klasa 4";
                break;
            case 5:
                $class_temp .= "Klasy 1-3";
                break;
            case 6:
                $class_temp .= "Klasy 1-4";
                break;
        }
        switch ($offers_fetch['id_szkola']) {
            case 1:
                $school_temp .= "Liceum";
                break;
            case 2:
                $school_temp .= "Technikum";
                break;
            case 3:
                $school_temp .= "Liceum/Technikum";
                break;
        }
        if ($offers_fetch['id_poziom'] == 1) $level_temp .= "Poziom podstawowy";
        elseif ($offers_fetch['id_poziom'] == 2) $level_temp .= "Poziom rozszerzony";
        return new Offer($offers_fetch['id_oferty'], $offers_fetch['id_user'], $offers_fetch['telefon'], $offers_fetch['email'], $offers_fetch['nazwa'], $quality_temp, $level_temp, $class_temp, $school_temp, $offers_fetch['cena'], $offers_fetch['opis'], $offers_fetch['zdjecie'], $offers_fetch['tytul']);
    }
    public static function report($id, $reason, $description){
        if($reason==0) return "<div class='alert alert-danger'>Musisz wybrać powód zgłoszenia</div>";
        $db = Db::getInstance();
        $insert = $db->prepare("INSERT INTO `zgloszenia`(`id_oferty`, `data_zgloszenia`, `powod`, `opis`) 
                            VALUES (:id_oferty, :data_zgloszenia, :powod, :opis)");
        $data = time();
        $insert->bindParam(":id_oferty", $id, PDO::PARAM_INT);
        $insert->bindParam(":data_zgloszenia", $data, PDO::PARAM_INT);
        $insert->bindParam(":powod", $reason, PDO::PARAM_INT);
        $insert->bindParam(":opis", $description, PDO::PARAM_STR);
        $insert->execute();
        return "<div class='alert alert-success'>Pomyślnie zgłoszono ofertę.</div>";
    }
    public static function my_offer($id_user){
        $list = [];
        $db = DB::getInstance();
        $select = "SELECT * FROM oferty INNER JOIN kategorie ON oferty.id_kategoria = kategorie.id_kategoria INNER JOIN users ON oferty.id_user = users.id WHERE stan = 0 AND id_user = :id";
        $offers = $db->prepare($select);
        $offers->bindParam(":id", $id_user, PDO::PARAM_INT);
        $offers->execute();
        // we create a list of Post objects from the database results
        if($offers->rowCount()>0){
            foreach($offers as $r) {
                $quality_temp = "";
                $class_temp = "";
                $level_temp = "";
                $school_temp = "";
                if($r['id_stan']==1) $quality_temp = "Nowe";
                elseif($r['id_stan']==2) $quality_temp = "Używane";
                switch ($r['id_klasa']) {
                    case 1:
                        $class_temp .= "Klasa 1";
                        break;
                    case 2:
                        $class_temp .= "Klasa 2";
                        break;
                    case 3:
                        $class_temp .= "Klasa 3";
                        break;
                    case 4:
                        $class_temp .= "Klasa 4";
                        break;
                    case 5:
                        $class_temp .= "Klasy 1-3";
                        break;
                    case 6:
                        $class_temp .= "Klasy 1-4";
                        break;
                }
                switch ($r['id_szkola']) {
                    case 1:
                        $school_temp .= "Liceum";
                        break;
                    case 2:
                        $school_temp .= "Technikum";
                        break;
                    case 3:
                        $school_temp .= "Liceum/Technikum";
                        break;
                }
                if ($r['id_poziom'] == 1) $level_temp .= "Poziom podstawowy";
                elseif ($r['id_poziom'] == 2) $level_temp .= "Poziom rozszerzony";
                $list[] = new Offer($r['id_oferty'], $r['id_user'], $r['telefon'], $r['email'], $r['nazwa'], $quality_temp, $level_temp, $class_temp, $school_temp, $r['cena'], $r['opis'], $r['zdjecie'], $r['tytul']);
            }
            return $list;
        }
        else return "Obecnie nie masz wystawionych żadnych ofert.";
    }
    public static function add_offer($category, $level, $class, $school, $quality, $price, $title, $description,$photo){
        if($category!=0&&$level!=0&&$class!=0&&$school!=0&&$quality!=0&&$price>0&&!empty($title)){
            require_once ("upload.php");
            if($uploadOk==1) {
                $db = DB::getInstance();
                $insert = $db->prepare("INSERT INTO `oferty`(`id_user`, `tytul`, `id_kategoria`, `cena`, `id_stan`, 
    `id_poziom`, `id_klasa`, `id_szkola`, `opis`, `zdjecie`) VALUES (:id_user, :tytul, :kategoria, :cena, :stan, 
    :poziom, :klasa, :szkola, :opis, :zdjecie)");
                $opis = NULL;
                $foto = $_SESSION['id_user'] . "_" . time() . "_" . $photo['foto']['name'];
                if (!empty($_POST['opis'])) $opis = $description;
                $insert->bindParam(":id_user", $_SESSION['id_user'], PDO::PARAM_INT);
                $insert->bindParam(":tytul", $title, PDO::PARAM_STR);
                $insert->bindParam(":kategoria", $category, PDO::PARAM_INT);
                $insert->bindParam(":cena", $price, PDO::PARAM_INT);
                $insert->bindParam(":stan", $quality, PDO::PARAM_INT);
                $insert->bindParam(":poziom", $level, PDO::PARAM_INT);
                $insert->bindParam(":szkola", $school, PDO::PARAM_INT);
                $insert->bindParam(":klasa", $class, PDO::PARAM_INT);
                $insert->bindParam(":opis", $opis, PDO::PARAM_STR);
                $insert->bindParam(":zdjecie", $foto, PDO::PARAM_STR);
                $insert->execute();
                return "<div class='alert alert-success'>Pomyślnie dodano ofertę!</div>";
            }
            else return $return;
        } elseif(($category==0&&isset($category))
            ||($level==0&&isset($level))
            ||($class==0&&isset($class))
            ||($school==0&&isset($school))
            ||($quality==0&&isset($quality))
            ||($price<=0&&isset($price))
            ||(isset($foto))
            ||(empty($title))&&isset($title)){
            return "<div class='alert alert-danger'>Wypełnij wszystkie pola poprawnie</div>";
        }
    }
    public static function edit_offer($id_offer,$category, $level, $class, $school, $quality, $price, $title, $description){
        $db = Db::getInstance();
        $insert = $db->prepare("UPDATE `oferty` SET `id_user` = :id_user, `tytul` = :tytul, `id_kategoria` = :kategoria,
        `cena` = :cena, `id_stan` = :stan, `id_poziom` = :poziom, `id_klasa` = :klasa, `id_szkola` = :szkola, `opis` 
        = :opis WHERE id_oferty = :id_oferty");
        $opis = NULL;
        if (!empty($description)) $opis = $description;
        $insert->bindParam(":id_user", $_SESSION['id_user'], PDO::PARAM_INT);
        $insert->bindParam(":tytul", $title, PDO::PARAM_STR);
        $insert->bindParam(":kategoria", $category, PDO::PARAM_INT);
        $insert->bindParam(":cena", $price, PDO::PARAM_INT);
        $insert->bindParam(":stan", $quality, PDO::PARAM_INT);
        $insert->bindParam(":poziom", $level, PDO::PARAM_INT);
        $insert->bindParam(":szkola", $school, PDO::PARAM_INT);
        $insert->bindParam(":klasa", $class, PDO::PARAM_INT);
        $insert->bindParam(":opis", $opis, PDO::PARAM_STR);
        $insert->bindParam(":id_oferty", $id_offer, PDO::PARAM_INT);
        $insert->execute();
        return "<div class='alert alert-success'>Pomyślnie edytowano ofertę!</div>";
    }
    public static function end_offer($id_offer){
        $db = DB::getInstance();
        $select = $db->prepare("SELECT * FROM oferty WHERE id_oferty = :id_oferty");
        $select->bindParam(":id_oferty", $id_offer, PDO::PARAM_INT);
        $select->execute();
        $select_fetch = $select->fetch();
        if($select_fetch['id_user']==$_SESSION['id_user']&&$select_fetch['stan']==0){
            $update = $db->prepare("UPDATE oferty SET stan = 1 WHERE id_oferty = :id_oferty");
            $update->bindParam(":id_oferty", $id_offer, PDO::PARAM_INT);
            $update->execute();
            return "<div class='alert alert-success'>Pomyślnie zakończono ofertę sprzedaży.</div>";
        }
        elseif($select_fetch['id_user']!=$_SESSION['id_user']) return "<div class='alert alert-danger'>To nie jest Twoja oferta.</div>";
        elseif($select_fetch['stan']!=0) return "<div class='alert alert-danger'>Ta oferta jest już zakończona.</div>";
    }
    public static function reported_offers(){
        $list = [];
        $db = DB::getInstance();
        $select = "SELECT * FROM zgloszenia INNER JOIN oferty ON zgloszenia.id_oferty = oferty.id_oferty INNER JOIN kategorie ON oferty.id_kategoria = kategorie.id_kategoria INNER JOIN users ON oferty.id_user = users.id WHERE status = 0";
        $offers = $db->prepare($select);
        $offers->execute();
        // we create a list of Post objects from the database results
        if($offers->rowCount()>0){
            foreach($offers as $r) {
                $quality_temp = "";
                $class_temp = "";
                $level_temp = "";
                $school_temp = "";
                if($r['id_stan']==1) $quality_temp = "Nowe";
                elseif($r['id_stan']==2) $quality_temp = "Używane";
                switch ($r['id_klasa']) {
                    case 1:
                        $class_temp .= "Klasa 1";
                        break;
                    case 2:
                        $class_temp .= "Klasa 2";
                        break;
                    case 3:
                        $class_temp .= "Klasa 3";
                        break;
                    case 4:
                        $class_temp .= "Klasa 4";
                        break;
                    case 5:
                        $class_temp .= "Klasy 1-3";
                        break;
                    case 6:
                        $class_temp .= "Klasy 1-4";
                        break;
                }
                switch ($r['id_szkola']) {
                    case 1:
                        $school_temp .= "Liceum";
                        break;
                    case 2:
                        $school_temp .= "Technikum";
                        break;
                    case 3:
                        $school_temp .= "Liceum/Technikum";
                        break;
                }
                switch ($r['powod']){
                    case 1: $reason_temp = "Paramtery oferty są niewłaściwe"; break;
                    case 2: $reason_temp = "Przedmiot niezgodny z regulaminem serwisu"; break;
                    case 3: $reason_temp = "Naruszenie zasad netykiety"; break;
                    case 4: $reason_temp = "Inne"; break;
                }
                if ($r['id_poziom'] == 1) $level_temp .= "Poziom podstawowy";
                elseif ($r['id_poziom'] == 2) $level_temp .= "Poziom rozszerzony";
                $list[] = new Offer($r['id_oferty'], $r['id_user'], $r['telefon'], $r['email'], $r['nazwa'], $quality_temp, $level_temp, $class_temp, $school_temp, $r['cena'], $r['opis'], $r['zdjecie'], $r['tytul'], $reason_temp);
            }
            //$list['type'] = "list";
            return $list;
        }
        else return "Obecnie żadna oferta nie jest zgłoszona";
    }
    public static function detail_reported($id){
        $list = [];
        $db = DB::getInstance();
        $select = "SELECT * FROM zgloszenia INNER JOIN oferty ON zgloszenia.id_oferty = oferty.id_oferty INNER JOIN kategorie ON oferty.id_kategoria = kategorie.id_kategoria INNER JOIN users ON oferty.id_user = users.id WHERE oferty.id_oferty = :id";
        $offers = $db->prepare($select);
        $offers->bindParam(":id", $id, PDO::PARAM_INT);
        $offers->execute();
        $offers_fetch = $offers->fetch();
        // we create a list of Post objects from the database results
        $quality_temp = "";
        $class_temp = "";
        $level_temp = "";
        $school_temp = "";
        if($offers_fetch['id_stan']==1) $quality_temp = "Nowe";
        elseif($offers_fetch['id_stan']==2) $quality_temp = "Używane";
        switch ($offers_fetch['id_klasa']) {
            case 1:
                $class_temp .= "Klasa 1";
                break;
            case 2:
                $class_temp .= "Klasa 2";
                break;
            case 3:
                $class_temp .= "Klasa 3";
                break;
            case 4:
                $class_temp .= "Klasa 4";
                break;
            case 5:
                $class_temp .= "Klasy 1-3";
                break;
            case 6:
                $class_temp .= "Klasy 1-4";
                break;
        }
        switch ($offers_fetch['id_szkola']) {
            case 1:
                $school_temp .= "Liceum";
                break;
            case 2:
                $school_temp .= "Technikum";
                break;
            case 3:
                $school_temp .= "Liceum/Technikum";
                break;
        }
        if ($offers_fetch['id_poziom'] == 1) $level_temp .= "Poziom podstawowy";
        elseif ($offers_fetch['id_poziom'] == 2) $level_temp .= "Poziom rozszerzony";
        return new Offer($offers_fetch['id_oferty'], $offers_fetch['id_user'], $offers_fetch['telefon'], $offers_fetch['email'], $offers_fetch['nazwa'], $quality_temp, $level_temp, $class_temp, $school_temp, $offers_fetch['cena'], $offers_fetch['opis'], $offers_fetch['zdjecie'], $offers_fetch['tytul']);
    }
}