<?php 
namespace Application\Database\Mapper;

use Application\Database\Entity\EntityInterface;

use Core\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class Configs extends AbstractDbMapper
{

	protected $tableName  = 'config';

	public function findByName($name) {
		$select = $this->getSelect()
		->where(array('name' => $name));


		$entity = $this->select($select)->current();
		$this->getEventManager()->trigger('find', $this, array('entity' => $entity));
		return $entity;
	}

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


	public function getLatestResults($id){

	}


	public function isEnabled($entity){
		// TODO
	}


	public function save($entity) {
		if(is_object($entity) && $entity instanceof EntityInterface) {
			if(is_object($this->findById($entity->getId()))) {
				return $this->update($entity);
			}
			else if(is_object($this->findByName($entity->getName()))){
				$where = array('name'=> $entity->getName());
				return $this->update($entity , $where);
			}
			else {
				return $this->insert($entity);
			}
		}
		else {
			if(isset($entity["id"])  && is_object($this->findById($entity["id"]))) {
				$where = array('id'=> $entity["id"]);
				return $this->update($entity , $where);
			}
			else if(isset($entity["name"])  && is_object($this->findByName($entity["name"]))) {
				$where = array('name'=> $entity["name"]);
				return $this->update($entity , $where);
			}
			else {
				return $this->insert($entity);
			}
		}
	}

	public function saveByNameValue($name,$value) {
		if(!is_string($name) || !is_string($value)) {

		}
		$input = array( "name"=> $name, "value"=>$value);
		return $this->save($input);
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

	/*public function updateByName($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
		if (!$where) {
			if(is_object($entity))
				$where =  array('name'=>  $entity->getName());
			else
				$where =  array('name'=>  $entity["name"]);
		}
		$result = parent::update($entity, $where, $tableName, $hydrator);
		$this->getEventManager()->trigger('update', $this, array('entity' => $entity));
		return $result;
	}*/

}