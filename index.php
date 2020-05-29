<?php

require_once 'vendor/autoload.php';

use App\User;

$user = new User;

$user->create("Nicola", "nikola@gmai.com");
$user->update(3, "New_name", "new_email_@gmail.com");
$user->delete(23);

var_dump($user::find(1));
