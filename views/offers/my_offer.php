<?php echo $msg; ?>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            <h4>Moje oferty</h4>
            <?php
            foreach($list as $r) {
                echo "<hr>
                        <div class=\"row\">
                            <div class=\"col-md-2\">
                                <center><img src='img/" . $r->photo . "' class=\"img-thumbnail\" style=\"width:auto; 
                                height: 100px;\"></center>
                            </div>
                            <div class=\"col-md-6\">
                                <a href=\"index.php?controller=offers&action=detail&id_offer=" . $r->id . "\">" . $r->title . "</a>
                                <br />
                                <p>" . $r->quality . ", ". $r->class .", ". $r->level .", ". $r->school .", ". $r->category ."</p>
                            </div>
                            <div class=\"col-md-2\">
                                <p class=\"cena\">" . $r->price . " zł</p>
                            </div>
                            <div class=\"col-md-2\">
                                <a href=\"index.php?controller=offers&action=edit_offer&id_offer=" . $r->id ."\" class=\"btn btn-primary\">Edytuj</a>
                                <a href=\"index.php?controller=offers&action=end_offer&id_offer=" . $r->id ."\" class=\"btn btn-primary\">Zakończ</a>
                            </div>
                        </div>";
            }
            ?>
        </div>
    </div>
</div>