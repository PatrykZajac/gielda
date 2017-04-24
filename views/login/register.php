<?php echo $msg; ?>

<div class="row">
    <div class="page-header">
        <h1>Załóż konto</h1>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <form method="post" action="index.php?controller=login&action=register_user">
            <div class="form-group">
                <label>Imię <span style="color: red;">*</span></label>
                <input type="text" name="imie" class="form-control">
            </div>
            <div class="form-group">
                <label>Nazwisko <span style="color: red;">*</span></label>
                <input type="text" name="nazwisko" class="form-control">
            </div>
            <div class="form-group">
                <label>Login <span style="color: red;">*</span></label>
                <input type="text" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label>Hasło <span style="color: red;">*</span></label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="form-group">
                <label>Powtórz hasło <span style="color: red;">*</span></label>
                <input type="password" name="pass2" class="form-control">
            </div>
            <div class="form-group">
                <label>Email <span style="color: red;">*</span></label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Telefon</label>
                <input type="number" name="telefon" class="form-control">
            </div>
            <p><span style="color: red; font-weight: 700;">*</span> Pola wymagane</p>
            <button type="submit" class="btn btn-primary">Rejestruj!</button>

        </form>
    </div>
    <div class="col-md-7">Test1</div>
</div>