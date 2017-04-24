<?php
class OffersController {
    public function list_all(){
        if(isset($_POST['id_oferty'])&&isset($_POST['powod'])&&isset($_POST['opis'])){
            $msg = Offer::report($_POST['id_oferty'], $_POST['powod'], $_POST['opis']);
        }
        $list = Offer::all($_POST);
        require_once ('views/offers/list.php');
    }
    public function detail(){
        $list = Offer::detail($_GET['id_offer']);
        $user = User::user($list->id_user);
        require_once ('views/offers/detail.php');
    }
    public function add_offer(){
        if(isset($_SESSION['id_user'])) {
            if (isset($_POST['kategoria']) && isset($_POST['poziom']) && isset($_POST['klasa']) && isset($_POST['szkola']) && isset($_POST['stan']) && isset($_POST['cena']) && isset($_POST['tytul'])) {
                $msg = Offer::add_offer($_POST['kategoria'], $_POST['poziom'], $_POST['klasa'], $_POST['szkola'], $_POST['stan'], $_POST['cena'], $_POST['tytul'], $_POST['opis'], $_FILES);
            }
            require_once('views/offers/add_offer.php');
        }else header("Location:index.php?controller=login&action=login_user");
    }
    public function edit_offer(){
        $list = Offer::detail($_GET['id_offer']);
        if($list->id_user==$_SESSION['id_user']) {
            if (isset($_POST['kategoria']) && isset($_POST['poziom']) && isset($_POST['klasa']) && isset($_POST['szkola']) && isset($_POST['stan']) && isset($_POST['cena']) && isset($_POST['tytul'])) {
                $msg = Offer::edit_offer($_GET['id_offer'], $_POST['kategoria'], $_POST['poziom'], $_POST['klasa'], $_POST['szkola'], $_POST['stan'], $_POST['cena'], $_POST['tytul'], $_POST['opis']);
                $list = Offer::my_offer($_SESSION['id_user']);
                require_once('views/offers/my_offer.php');
            }else require_once('views/offers/edit_offer.php');
        } else {
            $msg = "<div class='alert alert-danger'>To nie jest Twoje oferta. Nie możesz jej edytować.</div>";
            $list = Offer::my_offer($_SESSION['id_user']);
            require_once('views/offers/my_offer.php');
        }
    }
    public function end_offer(){
        $msg = Offer::end_offer($_GET['id_offer']);
        $list = Offer::my_offer($_SESSION['id_user']);
        require_once ('views/offers/my_offer.php');
    }
    public function my_offer(){
        $list = Offer::my_offer($_SESSION['id_user']);
        require_once ('views/offers/my_offer.php');
    }
    public function report_offer(){
        require_once ('views/offers/report_offer.php');
    }
    public function user_list(){
        $list = Offer::my_offer($_GET['id_user']);
        require_once ('views/offers/list.php');
    }
}