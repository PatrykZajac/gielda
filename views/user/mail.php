<?php echo $msg; ?>

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
                                <form role="form" class="form-horizontal" action="index.php?controller=user&action=mail" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Do</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" onkeyup="search_user(this.value);" id="user_to" class="form-control">
                                            <input type="hidden" placeholder="" name="id_user_to" id="id_user_to" class="form-control">
                                            <div id="livesearch" style="width:100%;"></div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Temat</label>
                                        <div class="col-lg-10">
                                            <input type="text" placeholder="" name="title" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Wiadomość</label>
                                        <div class="col-lg-10">
                                            <textarea rows="10" cols="30" class="form-control" name="body" id="body"></textarea>
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
                <li <?php if($type=="Odebrane") echo "class=\"active\""; ?>>
                    <a href="index.php?controller=user&action=mail"><i class="fa fa-inbox"></i> Odebrane <?php if($count!=0) echo " <span class=\"label label-danger pull-right\">$count</span>" ?></a>

                </li>
                <li <?php if($type=="Wysłane") echo "class=\"active\""; ?>>
                    <a href="index.php?controller=user&action=mail_sent"><i class="fa fa-envelope-o"></i> Wysłane</a>
                </li>
                <li <?php if($type=="Kosz") echo "class=\"active\""; ?>>
                    <a href="index.php?controller=user&action=mail_trash"><i class=" fa fa-trash-o"></i> Kosz</a>
                </li>
            </ul>

        </aside>
        <aside class="lg-side">
            <div class="inbox-head">
                <h3><?php echo $type; ?></h3>
            </div>
            <div class="inbox-body">
                <div class="mail-option">
                    <label>
                    <div class="chk-all">
                            <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                    Wszystkie
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"> Żadne</a></li>
                                    <li><a href="#"> Przeczytane</a></li>
                                    <li><a href="#"> Nieprzeczytane</a></li>
                                </ul>
                            </div>
                        </div>

                    <div class="btn-group hidden-phone">
                        <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                            <i class="fa fa-trash"></i> Kosz
                        </a>
                    </div>
                    <div class="btn-group">
                        <a data-toggle="dropdown" href="#" class="btn mini blue">
                            <i class="fa fa-tags"></i>
                            <i class="fa fa-angle-down "></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#"></i> Oznacz jako przeczytane</a></li>
                            <li><a href="#"></i> Ozancz jako nieprzeczytane</a></li>
                        </ul>
                    </div>
                </div>
                <table class="table table-inbox table-hover">
                    <tbody>

                    <?php
                    if(is_array($mail)) {
                        foreach ($mail as $r) {
                            $class="";
                            if ($r->status_to == 0) $class = "unread";
                            echo "<tr class=\"" . $class . "\">
                            <td class=\"inbox-small-cells\">
                                <input type=\"checkbox\" class=\"mail-checkbox\" id='" . $r->id_mail . "'>
                            </td>
        
                            <td class=\"view-message  dont-show\">" . $r->id_user_from->name . " " . $r->id_user_from->surname . "</td>
                            <td class=\"view-message \"><a href='index.php?controller=user&action=mail_detail&id_mail=" . $r->id_mail . "'>" . $r->title . "</a></td>
                            <td class=\"view-message  text-right\">" . $r->data . "</td>
                        </tr>";
                        }
                    }else echo $mail;

                    ?>

                    </tbody>
                </table>
            </div>
        </aside>
    </div>
</div>