<?php
/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 14.04.2017
 * Time: 23:25
 */

class AdminController{
    public function index(){
        if($_SESSION['permission']==1) {
            $list = Offer::reported_offers();
            require_once ('views/admin/index.php');
        }
        else header("Location: index.php");
    }
    public function detail(){
        if($_SESSION['permission']==1) {
            $list = Offer::detail_reported($_GET['id_offer']);
            require_once ('views/admin/detail.php');
        }
        else header("Location: index.php");
    }
    public function usun(){
        if($_SESSION['permission']==1) {
            $msg = Admin::usun($_GET['id_offer']);
            $list = Offer::reported_offers();
            require_once ('views/admin/index.php');
        }
        else header("Location: index.php");
    }
    public function zostaw(){
        if($_SESSION['permission']==1) {
            $msg = Admin::zostaw($_GET['id_offer']);
            $list = Offer::reported_offers();
            require_once ('views/admin/index.php');
        }
        else header("Location: index.php");
    }
}