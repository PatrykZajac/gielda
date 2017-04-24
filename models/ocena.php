<?php

/**
 * Created by PhpStorm.
 * User: patrykzajac
 * Date: 15.04.2017
 * Time: 15:37
 */
class Ocena
{
    public $id_user;
    public $star_one;
    public $star_two;
    public $star_three;
    public $star_four;
    public $star_five;
    public $star_av;
    public $count;

    public function __construct($id_user, $star_one, $star_two, $star_three,$star_four,$star_five,$star_av, $count)
    {
        $this->id_user=$id_user;
        $this->star_one=$star_one;
        $this->star_two=$star_two;
        $this->star_three=$star_three;
        $this->star_four=$star_four;
        $this->star_five=$star_five;
        $this->star_av=$star_av;
        $this->count = $count;
    }

    public static function oceny($id){
        $list = [];
        $db = Db::getInstance();
        $notes = $db->prepare("SELECT id_star, count(*) as ilosc FROM notes WHERE id_user = :id GROUP BY id_star");
        $notes->bindParam(":id", $id, PDO::PARAM_INT);
        $notes->execute();
        $star_one_temp   = 0;
        $star_two_temp   = 0;
        $star_three_temp = 0;
        $star_four_temp  = 0;
        $star_five_temp  = 0;
        $count = 0;
        foreach ($notes as $r){
            $count += $r['ilosc'];
            switch($r['id_star']){
                case 1: $star_one_temp   = $r['ilosc']; break;
                case 2: $star_two_temp   = $r['ilosc']; break;
                case 3: $star_three_temp = $r['ilosc']; break;
                case 4: $star_four_temp  = $r['ilosc']; break;
                case 5: $star_five_temp  = $r['ilosc']; break;
            }
        }
        if($count !=0 )$av = number_format (($star_one_temp + $star_two_temp*2 + $star_three_temp *3 + $star_four_temp*4 + $star_five_temp*5)/$count, 2);
        else $av = "Brak ocen";
        return new Ocena($id, $star_one_temp, $star_two_temp, $star_three_temp, $star_four_temp, $star_five_temp, $av, $count);
    }
}