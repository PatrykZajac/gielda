<p style="font-size: 30; font-weight: 700;"><?php echo $list->title; ?></p>
<a href="index.php?controller=offers&action=report_offer&id_offer=<?php echo $list->id; ?>" style="float:right">Zgłoś
    ofertę.</a>
<div class="row">
    <div class="col-md-4">
        <center><img src="img/<?php echo $list->photo; ?>" class="img-thumbnail" style="width: auto; max-width: 350px; height:
        300px;"></center>
    </div>
    <div class="col-md-8">
        <div class="well">
            <div class="row">
                <div class="col-md-6"><span style="font-size: 24;">Cena:</span> <span class="cena"><?php echo
                        $list->price; ?>zł</span></div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <td>Właściciel</td>
                            <td><a href="index.php?controller=user&action=profile&id_user=<?php echo $user->id; ?>"><?php echo $user->login; ?></a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <tr>
                        <td>Przedmiot</td>
                        <td><?php echo $list->category; ?></td>
                    </tr>
                    <tr>
                        <td>Stan</td>
                        <td><?php echo $list->quality; ?></td>
                    </tr>
                    <tr>
                        <td>Klasa</td>
                        <td><?php echo $list->class; ?></td>
                    </tr>
                    <tr>
                        <td>Poziom</td>
                        <td><?php echo $list->level ?></td>
                    </tr>
                    <tr>
                        <td>Szkoła</td>
                        <td><?php echo $list->school; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo $list->description; ?>
    </div>
</div>
