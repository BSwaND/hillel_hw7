<?php

require_once 'vendor/autoload.php';

use App\User;
use App\Address;


$user = User::find(1);
$user = new User();

$user->create([
	'email' => 'mail@com',
	'name' => 'NAicname',
	]);

$user->update([
	'id' => 3,
	'name' => 'Petrov',
	'email' => 'petrov@gmail.com'
]);



$address = new Address();

$address->create([
	'city' => 'Odessa',
	'street' => 'Derabas',
]);
