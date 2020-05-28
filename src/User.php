<?php


namespace App;


class User extends Model
{

	static function getTable(): string
	{
		return 'users';
	}
}