<?php
namespace Mock\Service;



use Zend\Json\Json;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Mock\JsonSchema\Validator as JValidator;

class JsonValidator implements FactoryInterface {
	
	/**
	 * 
	 * @var String
	 */
	protected $schemaFileLocation;
	protected $decodedSchema;
	
	protected $validator;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator){
		//$cofig = $serviceLocator->get('config');
		//$config = $cofig['api'];
		
		//if(array_key_exists('inputSchemaFileLocation', $config)){
		//	$this->setSchemaFileLocation($config['inputSchemaFileLocation']);
		//}
		$this->validator =  new JValidator();
		return $this;
	}
	
	/**
	 * 
	 * @param String $schemaFileLocation
	 * @return \Listener\Validator\Factory
	 */
	public function setSchemaFileLocation($schemaFileLocation){
		$this->schemaFileLocation = $schemaFileLocation;
		$this->processJsonSchemaFromFile();
		return $this;
	}
	
	public function validate($jsonObjOrArray){
		return $this->validator->check($jsonObjOrArray, $this->decodedSchema);
	}
	

	public function isValid(){
		return $this->validator->isValid();
	}
	
	
	public function getErrors(){
		return $this->validator->getErrors();
	}
	
	/**
	 * @return \Listner\JsonSchema\Validator
	 */
	public function getValidator(){
		return $this->validator;
	}
	
	
	protected function processJsonSchemaFromFile(){
		try {
			//$this->decodedSchema = file_get_contents('./module/Listner/data/scenarioresults.json');
			$this->decodedSchema = Json::decode(file_get_contents($this->schemaFileLocation));
		} catch (Exception $e) {
			throw $e;
		}
		
	}
	
}