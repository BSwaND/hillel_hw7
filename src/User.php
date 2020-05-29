<?php


namespace App;

/**
 * Class Model
 * @package App\Model
 */
class User extends Model
{
	static function getTable(): string
	{
		return 'users';
	}
}