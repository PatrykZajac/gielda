<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'offers':
          require_once('models/offers.php');
          require_once('models/user.php');
          $controller = new OffersController();
      break;
      case 'login':
          require_once('models/login.php');
          $controller = new LoginController();
      break;
      case 'user':
          require_once('models/ocena.php');
          require_once('models/user.php');
          require_once('models/mail.php');
          $controller = new UserController();
      break;
      case 'admin':
        // we need the model to query the database later in the controller
        require_once('models/admin.php');
        require_once('models/offers.php');
        $controller = new AdminController();
      break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('offers' => ['list_all', 'detail', 'add_offer', 'edit_offer', 'end_offer', 'my_offer', 'report_offer', 'user_list'],
                       'login' => ['login_user', 'register_user', 'logout_user', 'settings_user'],
                       'admin' => ['index', 'detail', 'usun', 'zostaw'],
                       'user' => ['profile', 'vote', 'mail', 'mail_detail', 'mail_sent', 'mail_trash', 'move_to_trash']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('offers', 'list_all');
    }
  } else {
    call('offers', 'list_all');
  }
?>