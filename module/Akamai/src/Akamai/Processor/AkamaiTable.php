<?php
namespace Akamai\Processor;

use Zend\Db\TableGateway\TableGateway;

class AkamaiTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		$resultSet->buffer();
		$resultSet->next();
		return $resultSet;
	}
	
	public function getTableGateway(){
		return $this->tableGateway;
	}
}