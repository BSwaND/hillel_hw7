<?php


namespace App;

/**
 * Class User
 * @package App
 */
class User extends Model
{
	private ?int $id;
	private ?string $email;
	private ?string $name;

	/**
	 * User constructor.
	 * @param int|null $id
	 * @param string|null $email
	 * @param string|null $name
	 */
	public function __construct(?int $id = null, ?string $email = null, ?string $name = null)
	{
		$this->id = $id;
		$this->email = $email;
		$this->name = $name;
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string|null $name
	 */
	public function setName(?string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @param int|null $id
	 */
	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * @param string|null $email
	 */
	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}


	/**
	 * @return string
	 */
	static function getTable(): string
	{
		return 'users';
	}
}