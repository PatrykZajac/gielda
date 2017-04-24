<?php echo $msg; ?>
<div class="row">
    <div class="page-header">
        <h1>Zaloguj się</h1>
        <a href="index.php?controller=login&action=register_user">Nie masz konta?</a>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
        <form method="post" action="index.php?controller=login&action=login_user">
            <div class="form-group">
                <label>Login</label>
                <input type="text" name="login" class="form-control">
            </div>
            <div class="form-group">
                <label>Hasło</label>
                <input type="password" name="pass" class="form-control">
            </div>
            <div class="form-group">
                <a href="index.php?controller=login&action=password">Nie pamiętasz hasła?</a>
            </div>

            <button type="submit" class="btn btn-primary">Zaloguj się!</button>

        </form>
    </div>
    <div class="col-md-7">Test1</div>
</div>