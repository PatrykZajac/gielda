<?php
    echo $msg;
?>

<form action="index.php?controller=offers&action=add_offer" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="page-header">
            <h1>Dodaj ofertę</h1>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tytuł książki (Dodatkowo można podać autora) <span style="color: red;">*</span></label>
                <input type="text" name="tytul" class="form-control">
            </div>
            <div class="form-group">
                <label>Cena <span style="color: red;">*</span></label>
                <input type="number" name="cena" class="form-control">
            </div>
            <div class="form-group">
                <label>Przedmiot <span style="color: red;">*</span></label>
                <select name="kategoria" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <?php
                    $db = DB::getInstance();
                    $kategorie = $db->prepare("SELECT * FROM kategorie");
                    $kategorie->execute();
                    foreach ($kategorie as $r){
                        echo "<option value='".$r['id_kategoria']."'>".$r['nazwa']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Poziom <span style="color: red;">*</span></label>
                <select name="poziom" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1">Podstawowoy</option>
                    <option value="2">Rozszerzony</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Klasa <span style="color: red;">*</span></label>
                <select name="klasa" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1">Klasa 1</option>
                    <option value="2">Klasa 2</option>
                    <option value="3">Klasa 3</option>
                    <option value="4">Klasa 4</option>
                    <option value="5">Klasy 1-3</option>
                    <option value="6">Klasy 1-4</option>
                </select>
            </div>
            <div class="form-group">
                <label>Szkoła <span style="color: red;">*</span></label>
                <select name="szkola" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1">Liceum</option>
                    <option value="2">Technikum</option>
                    <option value="3">Liceum/Technikum</option>
                </select>
            </div>
            <div class="form-group">
                <label>Stan <span style="color: red;">*</span></label>
                <select name="stan" class="form-control">
                    <option value="0">--Wybierz--</option>
                    <option value="1">Nowy</option>
                    <option value="2">Używane</option>
                </select>
            </div>
            <div class="form-group">
                <label>Zdjęcie (max 2 MB)<span style="color: red;">*</span></label>
                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                <input type="file" name="foto" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Opis</label>
                <textarea name="opis" rows="8" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group"><p><span style="color: red; font-weight: 700;">*</span> Pola wymagane</p>
                <input type="submit" value="Dodaj ofertę" class="form-control btn btn-primary">
            </div>
        </div>
    </div>
</form>