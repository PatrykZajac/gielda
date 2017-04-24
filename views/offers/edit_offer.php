<form action="index.php?controller=offers&action=edit_offer&id_offer=<?php echo $list->id; ?>" method="post">
    <div class="row">
        <div class="page-header">
            <h1>Edytuj ofertę</h1>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tytuł książki (Dodatkowo można podać autora)</label>
                <input type="text" name="tytul" class="form-control" value="<?php echo $list->title; ?>">
            </div>
            <div class="form-group">
                <label>Cena</label>
                <input type="number" name="cena" class="form-control" value="<?php echo $list->price; ?>">
            </div>
            <div class="form-group">
                <label>Przedmiot</label>
                <select name="kategoria" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <?php
                    $db = DB::getInstance();
                    $kategorie = $db->prepare("SELECT * FROM kategorie");
                    $kategorie->execute();
                    foreach ($kategorie as $r){
                        if($list->category==$r['nazwa'])
                        {
                            echo "<option value='".$r['id_kategoria']."' selected>".$r['nazwa']."</option>";
                        }
                        else echo "<option value='".$r['id_kategoria']."'>".$r['nazwa']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Poziom</label>
                <select name="poziom" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1" <?php if($list->level == "Poziom podstawowy") echo "selected"; ?>>
                        Podstawowoy
                    </option>
                    <option value="2" <?php if($list->level == "Poziom rozszerzony") echo "selected"; ?>>
                        Rozszerzony
                    </option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Klasa</label>
                <select name="klasa" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1" <?php if($list->class=="Klasa 1") echo "selected"; ?>>Klasa 1</option>
                    <option value="2" <?php if($list->class=="Klasa 2") echo "selected"; ?>>Klasa 2</option>
                    <option value="3" <?php if($list->class=="Klasa 3") echo "selected"; ?>>Klasa 3</option>
                    <option value="4" <?php if($list->class=="Klasa 4") echo "selected"; ?>>Klasa 4</option>
                    <option value="5" <?php if($list->class=="Klasy 1-3") echo "selected"; ?>>Klasy 1-3</option>
                    <option value="6" <?php if($list->class=="Klasy 1-4") echo "selected"; ?>>Klasy 1-4</option>
                </select>
            </div>
            <div class="form-group">
                <label>Szkoła</label>
                <select name="szkola" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1" <?php if($list->school=="Liceum") echo "selected"; ?>>Liceum</option>
                    <option value="2" <?php if($list->school=="Technikum") echo "selected"; ?>>Technikum</option>
                    <option value="3" <?php if($list->school=="Liceum/Technikum") echo "selected"; ?>>Liceum/Technikum</option>
                </select>
            </div>
            <div class="form-group">
                <label>Stan</label>
                <select name="stan" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1" <?php if($list->quality=="Nowe") echo "selected"; ?>>Nowy</option>
                    <option value="2" <?php if($list->quality=="Używane") echo "selected"; ?>>Używane</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Opis</label>
                <textarea name="opis" rows="8" class="form-control"> <?php echo $list->description; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" value="Uaktualnij ofertę" class="form-control btn btn-primary">
            </div>
        </div>
    </div>
</form>