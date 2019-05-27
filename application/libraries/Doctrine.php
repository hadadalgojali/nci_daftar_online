<?php
	use Doctrine\Common\ClassLoader,
		Doctrine\ORM\Tools\Setup,
		Doctrine\ORM\EntityManager;
class Doctrine{
	public $em;
	public function __construct(){
		require_once __DIR__ . '/Doctrine/ORM/Tools/Setup.php';
        Setup::registerAutoloadDirectory(__DIR__);
		require APPPATH . 'config/database.php';
		$connection_options = array(
			'driver'        => 'pdo_mysql',
			'port' 			=> $db['default']['port'],
			'user'          => $db['default']['username'],
			'password'      => $db['default']['password'],
			'host'          => $db['default']['hostname'],
			'dbname'        => $db['default']['database'],
			'charset'       => $db['default']['char_set'],
			'driverOptions' => array(
				'charset'   	=> $db['default']['char_set'],
			),
		);
		$models_namespace = 'Entity';
		$models_path = APPPATH . 'models';
		$proxies_dir = APPPATH . 'models/Proxies';
		$metadata_paths = array(APPPATH . 'models');
		$config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir);
		$this->em = EntityManager::create($connection_options, $config);
		$loader = new ClassLoader($models_namespace, $models_path);
		$loader->register();
	}
}