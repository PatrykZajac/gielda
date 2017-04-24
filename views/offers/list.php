<?php
    echo $msg;
?>
<div class="row">
    <div class="col-md-3">
        <div class="well">
            <form action="index.php?controller=offers&action=list_all" method="post">
                <label>Parametry</label>
                <hr>
                <label>Cena</label>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6"><input type="number" class="form-control" placeholder="Od" name="od"
                                                     value="<?php if(isset($_POST['od'])) echo $_POST['od']; ?>"
                            ></div>
                        <div class="col-md-6"><input type="number" class="form-control" placeholder="Do" name="do"
                                                     value="<?php if(isset($_POST['do'])) echo $_POST['do']; ?>"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Stan</label><br />
                    <label class="label-check"><input type="checkbox" name="stan-nowe" <?php if(isset
                        ($_POST['stan-nowe'])) echo "checked"; ?>> Nowe</label><br />
                    <label class="label-check"><input type="checkbox" name="stan-uzywane" <?php if(isset
                        ($_POST['stan-uzywane'])) echo "checked"; ?>> Używane</label>
                </div>
                <div class="form-group">
                    <label>Klasa</label><br />
                    <select class="form-control" name="klasa">
                        <option value="0">--Wybierz--</option>
                        <option value="1" <?php if($_POST['klasa']==1) echo "selected"; ?>>Klasa 1</option>
                        <option value="2" <?php if($_POST['klasa']==2) echo "selected"; ?>>Klasa 2</option>
                        <option value="3" <?php if($_POST['klasa']==3) echo "selected"; ?>>Klasa 3</option>
                        <option value="4" <?php if($_POST['klasa']==4) echo "selected"; ?>>Klasa 4</option>
                        <option value="5" <?php if($_POST['klasa']==5) echo "selected"; ?>>Klasy 1-3</option>
                        <option value="6" <?php if($_POST['klasa']==6) echo "selected"; ?>>Klasy 1-4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Poziom</label><br />
                    <select class="form-control" name="poziom">
                        <option value="0">--Wybierz--</option>
                        <option value="1" <?php if($_POST['poziom']==1) echo "selected"; ?>>Podstawa</option>
                        <option value="2" <?php if($_POST['poziom']==2) echo "selected"; ?>>Rozszerzenia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Szkoła</label><br />
                    <label class="label-check"><input type="checkbox" name="szkola-liceum" <?php if(isset
                        ($_POST['szkola-liceum'])) echo "checked"; ?>> Liceum</label><br />
                    <label class="label-check"><input type="checkbox" name="szkola-technikum" <?php if(isset
                        ($_POST['szkola-technikum'])) echo "checked"; ?>> Technikum</label>
                </div>
                <input type="hidden" name="kategoria" value="<?php if(isset($_POST['kategoria'])) echo
                $_POST['kategoria']; ?>">
                <input type="hidden" name="przedmiot" value="<?php if(isset($_POST['przedmiot'])) echo
                $_POST['przedmiot']; ?>">
                <input type="submit" class="btn btn-primary" value="Filtruj">
            </form>
        </div>
    </div>
    <div class="col-md-9">
        <div class="well">
            <h4>Oferty sprzedaży</h4>
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
                                        <a href=\"index.php?controller=offers&action=detail&id_offer=" . $r->id . "\">" . $r->title . "</a>
                                        <br />
                                        <p>" . $r->quality . ", ". $r->class .", ". $r->level .", ". $r->school .", ". $r->category ."</p>
                                    </div>
                                    <div class=\"col-md-2\">
                                        <p class=\"cena\">" . $r->price . " zł</p>
                                    </div>
                                </div>";
                    }
                } else echo $list;
            ?>
        </div>
    </div>
</div>