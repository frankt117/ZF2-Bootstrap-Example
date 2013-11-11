<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Inputfilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
* Request table entity.
* @ORM\Entity
* @ORM\Table(name="requests")
* @property string $email
* @property string $description
* $property int $id
*/
class Requests {

	protected $inputFilter;

	/**
	* @ORM\Id
	* @ORM\Column(type="integer");
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="string")
	*/
	protected $email;

	/**
	* @ORM\Column(type="string")
	*/
	protected $description;

	public function __get($property){
		return $this->$property;
	}

	public function __set($property, $value){
		$this->$property = $value;
	}
}
