<?php
namespace Application\Database\Entity;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


class Configs  implements EntityInterface
{


	public $id;
	public $name;
	public $value;
	//private $inputFilter;
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
	
	/*
	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
	
			$inputFilter->add(array(
					'name'     => 'id',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'name',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'value',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			));
	
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
*/
}