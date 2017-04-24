<?php echo $msg; ?>


<div class="well">
    <h4>Zgłoszone oferty</h4>
    <?php
        if(is_array($list)) {
            foreach ($list as $r) {
                echo "<hr>
                <div class=\"row\">
                    <div class=\"col-md-2\">
                        <center><img src='img/" . $r->photo . "' class=\"img-thumbnail\" style=\"width:auto; 
                        height: 100px;\"></center>
                    </div>
                    <div class=\"col-md-8\">
                        <a href=\"index.php?controller=admin&action=detail&id_offer=" . $r->id . "\">" . $r->title
                    . " [" . $r->reason . "]" . "</a>
                        <br />
                        <p>" . $r->quality . ", " . $r->class . ", " . $r->level . ", " . $r->school . ", " . $r->category . "</p>
                    </div>
                    <div class=\"col-md-2\">
                        <p class=\"cena\">" . $r->price . " zł</p>
                    </div>
                </div>";
            }
        }
        else echo $list;
    ?>
</div>