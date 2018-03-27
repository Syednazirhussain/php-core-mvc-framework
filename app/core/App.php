<?php


class App extends Route{


	private $controller;
	private $method;
	private $params;

	public function __construct(){

		session_start();
		$urlInfo = $this->DefaultRoute();
		$this->controller = $urlInfo["Controller"];
		$this->method = $urlInfo["Method"];
		$this->params = $urlInfo["Params"];

	}


	public function run()
	{

		$url = $this->parseUrl();

		if (count($url) >= 2) {

			$this->params = array_slice($url, 2);

			if (file_exists('../app/controller/'.$url[0].'.php')) {

				$this->controller = $url[0];
				unset($url[0]);

			}

			require_once '../app/controller/'.$this->controller.'.php';
			
			$this->controller = new $this->controller;


			if (method_exists($this->controller, $url[1])) {

				$this->method = $url[1];
				unset($url[1]);
			}

			return call_user_func_array( [$this->controller,$this->method] , $this->params);

		}else{
			
			require_once '../app/controller/'.$this->controller.'.php';

			$this->controller = new $this->controller;

			return call_user_func_array([$this->controller,$this->method]);

		}

	}

	private function parseUrl()
	{
		session_regenerate_id();
        $_SESSION['SESSIONID'] = session_id();
		if(isset($_GET['url']))
		{
			return $url = explode('/' , filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
		}
	}

}


?>