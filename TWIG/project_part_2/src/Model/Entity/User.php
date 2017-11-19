<?php

namespace MyApp\Model\Entity;

/**
 * Class User
 * @package MyApp\Model\Entity
 */
class User{

	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $firstname;

	/**
	 * @var int
	 */
	private $age;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * @param string $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}

	/**
	 * @return int
	 */
	public function getAge()
	{
		return $this->age;
	}

	/**
	 * @param int $age
	 */
	public function setAge($age)
	{
		$this->age = $age;
	}
}