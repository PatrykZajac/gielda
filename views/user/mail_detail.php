<div class="container">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
    <div class="mail-box">
        <aside class="sm-side">
            <div class="inbox-body">
                <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
                    Nowa wiadomość
                </a>
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Nowa wiadomość</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Do</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" id="login" class="form-control">
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Temat</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Wiadomość</label>
                                        <div class="col-lg-10">
                                            <textarea rows="10" cols="30" class="form-control" id="body" name=""></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-send" type="submit">Wyślij</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
            <ul class="inbox-nav inbox-divider">
                <li class="active">
                    <a href="index.php?controller=user&action=mail"><i class="fa fa-inbox"></i> Odebrane <?php if($count!=0) echo " <span class=\"label label-danger pull-right\">$count</span>" ?></a>

                </li>
                <li>
                    <a href="index.php?controller=user&action=mail_sent"><i class="fa fa-envelope-o"></i> Wysłane</a>
                </li>
                <li>
                    <a href="index.php?controller=user&action=mail_trash"><i class=" fa fa-trash-o"></i> Kosz</a>
                </li>
            </ul>

        </aside>
        <aside class="lg-side">
            <div class="inbox-head">
                <h3>Odebrane</h3>
            </div>
            <div class="inbox-body">
                <div class="mail-option">
                        <div class="btn-group hidden-phone">
                            <a href="index.php?controller=user&action=mail" class="btn mini blue" aria-expanded="false">
                                <i class="fa fa-chevron-left"></i> Wróć
                            </a>
                        </div>

                        <div class="btn-group hidden-phone">
                            <a href="index.php?controller=user&action=move_to_trash&id_mail=<?php echo $mail->id_mail; ?>" class="btn mini blue" aria-expanded="false">
                                <i class="fa fa-trash"></i> Kosz
                            </a>
                        </div>
                        <div id="mCSB_5_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">

                            <div style="font-size: 28px; padding: 10px 0px"><?php echo $mail->title; ?></div>

                            <div class="row" style="margin: 5px 0px 25px 0px;">
                                <div class="col-md-6">
                                    <img src="img/<?php echo $mail->id_user_from->photo; ?>" style="width:50px; height: 50px;"><span style="font-size: 21px; padding: 5px 0px;"> <?php echo $mail->id_user_from->name; ?> <?php echo $mail->id_user_from->surname; ?></span>
                                </div>
                                <div class="col-md-6" >
                                    <div class="pull-right">
                                        <span style="font-size: 17px; padding: 5px 0px; color:gray;">
                                            <?php echo $mail->data; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dev-email-message-text">
                                <p>
                                    <?php echo $mail->body; ?>
                                </p>
                            </div>


                            <div class="dev-email-message-form">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Szybka odpowiedź" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger pull-right">Wyślij</button>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
        </aside>
    </div>
</div>