<?php

namespace Application\Database\Mapper;

use Application\Database\Entity\EntityInterface;

use Core\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Responses extends AbstractDbMapper
{

	protected $tableName  = 'responses';

	
	public function findById($id) {
		$select = $this->getSelect()
		->where(array('id' => $id));
	
		$entity = $this->select($select)->current();
		$this->getEventManager()->trigger('find', $this, array('entity' => $entity));
		return $entity;
	}
	
	public function fetchAll(){
		$enti = $this->select($this->getSelect())->toArray();
		return $enti;
	}
	
	
	public function save($entity) {
		if(is_object($entity) && $entity instanceof EntityInterface) {
			if(is_object($this->findById($entity->getId()))) {
				return $this->update($entity);
			}
			else {
				return $this->insert($entity);
			}
		}
		else {
			if(is_object($this->findById($entity["id"]))) {
				$where = array('id'=> $entity["id"]);
				return $this->update($entity , $where);
			}
			else {
				return $this->insert($entity);
			}
		}
	}
	
	
	public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
		$result = parent::insert($entity, $tableName, $hydrator);
		$this->getEventManager()->trigger('insert', $this, array('entity' => $entity));
		return $result;
	}
	
	public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
		if (!$where) {
			$where =  array('id'=>  $entity->getId());
		}
		$result = parent::update($entity, $where, $tableName, $hydrator);
		$this->getEventManager()->trigger('update', $this, array('entity' => $entity));
		return $result;
	}
}