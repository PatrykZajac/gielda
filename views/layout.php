<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="vendor/ajax.js"></script>
        <style>
            .my-group .input {
                width: 75%;
            }
            .my-group .select {
                width: 25%;
            }
            hr{
                color:lightgray; height:1px;width:100%; background-color:lightgray; margin-top: 5px; margin-bottom: 5px;
            }
            .label-check{
                font-weight: normal;
            }
            .cena{
                font-size: 24; color:forestgreen;
            }
        </style>
        <link rel="stylesheet" href="vendor/style.css?v=8">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Giełda książek I LO</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?controller=offers&action=list_all">Oferty</a></li>
                        <li><a href="index.php?controller=offers&action=add_offer">Dodaj ofertę</a></li>
                        <?php if($_SESSION['permission']==1) echo "<li><a href=\"index.php?controller=admin&action=index\">Zgłoszone oferty</a></li>" ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($_SESSION['id_user'])){?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                   aria-expanded="false">Zalogowany jako: <?php echo $_SESSION['nazwa']; ?> <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?controller=user&action=profile&id_user=<?php echo $_SESSION['id_user']; ?>">Mój profil</a></li>
                                    <li><a href="index.php?controller=offers&action=add_offer">Dodaj ofertę</a></li>
                                    <li><a href="index.php?controller=offers&action=my_offer">Moje oferty</a></li>

                                    <li><a href="index.php?controller=login&action=settings_user">Zmień hasło</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?controller=login&action=logout_user">Wyloguj</a></li>
                        <?php } elseif(!isset($_SESSION['id_user'])){ ?> <li><a href="index.php?controller=login&action=login_user">Zaloguj się!</a></li>
                        <?php } ?>

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <div class="container theme-showcase" role="main">
            <form action="index.php?controller=offers&action=list_all" method="post">
                <div class="input-group my-group">
                    <span class="input-group-addon">Wyszukaj przedmiot</span>
                    <input type="text" class="form-control input" name="przedmiot">
                    <select name="kategoria" class="selectpicker form-control select" data-live-search="true">
                        <option value="0">--Wybierz kategorię--</option>
                        <?php
                        $db = DB::getInstance();
                        $kategorie = $db->prepare("SELECT * FROM kategorie ORDER BY nazwa ASC");
                        $kategorie->execute();
                        foreach($kategorie as $r){
                            echo "<option value='".$r['id_kategoria']."'>".$r['nazwa']."</option>";
                        }
                        ?>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Szukaj</button>
                    </span>
                </div>
            </form>
            <?php require_once('routes.php'); ?>
        </div>
    </body>
</html>