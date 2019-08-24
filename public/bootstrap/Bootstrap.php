<?php
namespace Bootstrap;

class Bootstrap
{
	// private $_name = 'NVAA';
	// khai niem lazy loading - ten file trung ten class
	// sau nay tu dong nap file va trieu goi class
	
	public function __construct()
	{
		spl_autoload_register(array($this,'_autoload'));
	}
	

	private function _autoload($file)
	{
		// $file : ten file can tu dong nap
		// $file sau nay se duoc lay thong qua namespace va class o cho khac.
		// App\Controller\Home
		// \
		$file = str_replace('\\', '/', trim($file, '\\')) . '.php';
		require_once $file;
	}
}