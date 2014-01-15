<?php
namespace Application\Database\Entity;


class Configs  implements EntityInterface
{


public $id;
public $name;
public $value;

/**
 * Get id.
 *
 * @return int
 */
public function getId(){
	return $this->id;
}

/**
 * Set id.
 *
 * @param int $id
 * @return EntityInterface
 */
public function setId($id){
	$this->id = $id;
	return $this;
}

/**
 * Get name.
 *
 * @return string
 */
public function getName(){
	return $this->name;
}

/**
 * Set name.
 *
 * @param string $name
 * @return EntityInterface
 */
public function setName($name){
	$this->name = $name;
	return $this;
}


/**
 * Get value.
 *
 * @return string
 */
public function getValue(){
	return $this->value;
}

/**
 * Set value.
 *
 * @param string $value
 * @return EntityInterface
 */
public function setValue($value){
	$this->value = $value;
	return $this;
}

}