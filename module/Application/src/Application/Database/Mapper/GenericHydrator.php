<?php
namespace Application\Database\Mapper;




use Application\Database\Entity\EntityInterface;

use Zend\Stdlib\Hydrator\ClassMethods;

class GenericHydrator extends ClassMethods 
{
	
	
	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object)
	{
		if (!$object instanceof EntityInterface ) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Database\Entity\EntityInterface');
		}
		/* @var $object UserInterface*/
		$data = parent::extract($object);
		return $data;
	}
	
	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return UserInterface
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object)
	{
		if (!$object instanceof EntityInterface) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Database\Entity\EntityInterface');
		}
		return parent::hydrate($data, $object);
	}
	

}