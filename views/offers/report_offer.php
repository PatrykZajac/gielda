<form action="index.php?controller=offers&action=list_all" method="POST">
    <div class="form-group">
        <label>Powód</label>
        <select name="powod" class="form-control">
            <option value="0">--Wybierz powód--</option>
            <option value="1">Parametry oferty są niewłaściwe</option>
            <option value="2">Przedmiot niezgody z regulaminem serwisu</option>
            <option value="3">Naruszenie zasad netykiety</option>
            <option value="4">Inne</option>
        </select>
    </div>
    <div class="form-group">
        <label>Opis</label>
        <textarea class="form-control" name="opis"></textarea>
    </div>
    <div class="form-group">
        <input type="hidden" value="<?php echo $_GET['id_offer']; ?>" name="id_oferty">
        <input type="submit" class="btn btn-primary" value="Zgłoś ofertę">
    </div>
</form>