<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class'    => 'Auth_hook',
    'function' => 'check_auth',
    'filename' => 'Auth_hook.php',
    'filepath' => 'hooks'
);
