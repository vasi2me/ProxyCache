<?php

date_default_timezone_set('UTC');
$zendFrameworkVersion = 'zend_2.1.5'; //zend_2.0.6

/**
 * This autoloading setup is really more complicated than it needs to be for most
 * applications. The added complexity is simply to reduce the time it takes for
 * new developers to be productive.
 */

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
	$loader = include 'vendor/autoload.php';
}

// Support for ZF2_PATH environment variable or git submodule
if ($zf2Path = getenv('ZF2_PATH') ?: (is_dir('vendor/'.$zendFrameworkVersion) ? 'vendor/'.$zendFrameworkVersion : false)) {
	if (isset($loader)) {
		$loader->add('Zend', $zf2Path . '/Zend');
	} else {
		include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
		Zend\Loader\AutoloaderFactory::factory(array(
		'Zend\Loader\StandardAutoloader' => array(
		'autoregister_zf' => true,
		)
		));
	}
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
	throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}