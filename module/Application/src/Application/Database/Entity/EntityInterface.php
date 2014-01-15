<?php
namespace Application\Database\Entity;


interface EntityInterface {
	
	

	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId();
	
	/**
	 * Set id.
	 *
	 * @param int $id
	 * @return EntityInterface
	*/
	public function setId($id);
	
	
	
}