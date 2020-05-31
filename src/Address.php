<?php


namespace App;

/**
 * Class Address
 * @package App
 */
class Address extends Model
{
 private ?int $id;
 private ?string $city;
 private ?string $street;
 private ?int $numberHome;

	/**
	 * Adress constructor.
	 * @param int|null $id
	 * @param string|null $city
	 * @param string|null $street
	 * @param int|null $numberHome
	 */
	public function __construct(?int $id=null, ?string $city=null, ?string $street=null, ?int $numberHome=null)
	{
		$this->id = $id;
		$this->city = $city;
		$this->street = $street;
		$this->numberHome = $numberHome;
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
	public function getCity(): ?string
	{
		return $this->city;
	}

	/**
	 * @param string|null $city
	 */
	public function setCity(?string $city): void
	{
		$this->city = $city;
	}

	/**
	 * @return string|null
	 */
	public function getStreet(): ?string
	{
		return $this->street;
	}

	/**
	 * @param string|null $street
	 */
	public function setStreet(?string $street): void
	{
		$this->street = $street;
	}

	/**
	 * @return int|null
	 */
	public function getNumberHome(): ?int
	{
		return $this->numberHome;
	}

	/**
	 * @param int|null $numberHome
	 */
	public function setNumberHome(?int $numberHome): void
	{
		$this->numberHome = $numberHome;
	}


	static function getTable(): string
	{
		return 'address';
	}
}