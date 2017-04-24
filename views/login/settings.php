<?php echo $msg; ?>

<div class="col-md-2"></div>
<div class="col-md-8">
    <div class="well">
        <h2 style="margin-top:0px;">Zmień hasło</h2>
        <hr>
        <form action="index.php?controller=login&action=settings_user" method="POST">
            <div class="form-group">
                <label>Stare hasło</label>
                <input type="password" name="old_pass" class="form-control">
            </div>
            <div class="form-group">
                <label>Nowe hasło</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="form-group">
                <label>Powtórz nowe hasło</label>
                <input type="password" name="pass2" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Zmień hasło!</button>
        </form>
    </div>
</div>