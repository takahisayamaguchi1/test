<?php
require_once('functions.php');
remove_auth_session();
send_redirect('login.php');
