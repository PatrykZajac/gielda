<?php echo $msg; ?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $user->name." ".$user->surname; ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            <img alt="User Pic" src="img/<?php echo $user->photo; ?>" class="img-circle img-responsive">
                        </div>
                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td>Telefon:</td>
                                    <td><?php echo $user->phone; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $user->email; ?></td>
                                </tr>

                                </tbody>
                            </table>
                            <a href="index.php?controller=offers&action=user_list&id_user=<?php echo $user->id; ?>" class="btn btn-primary">Zobacz moje produkty</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Oceny</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="rating-block">
                                <h4>Średnia ocena</h4>
                                <h2 class="bold padding-bottom-7"><?php echo $notes->star_av; ?> <small>/ 5</small></h2>
                                <span style="padding: 5px;">
                                    1
                                </span>
                                <a href="index.php?controller=user&action=vote&id_user=<?php echo $user->id; ?>&id_vote=1" type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                                <a href="index.php?controller=user&action=vote&id_user=<?php echo $user->id; ?>&id_vote=2" type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                                <a href="index.php?controller=user&action=vote&id_user=<?php echo $user->id; ?>&id_vote=3" type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                                <a href="index.php?controller=user&action=vote&id_user=<?php echo $user->id; ?>&id_vote=4" type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                                <a href="index.php?controller=user&action=vote&id_user=<?php echo $user->id; ?>&id_vote=5" type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </a>
                                <span style="padding: 5px;">
                                    5
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Statystki oceniania</h4>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $notes->star_five/$notes->count*100; ?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;"><?php echo $notes->star_five; ?></div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $notes->star_four/$notes->count*100; ?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;"><?php echo $notes->star_four; ?></div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $notes->star_three/$notes->count*100; ?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;"><?php echo $notes->star_three; ?></div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $notes->star_two/$notes->count*100; ?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;"><?php echo $notes->star_two; ?></div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $notes->star_one/$notes->count*100; ?>%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;"><?php echo $notes->star_one; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div
    </div>
</div>