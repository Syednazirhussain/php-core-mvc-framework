<?php


class Controller
{

	private $UrlAgainstHttpMethod = array(
				'GET' => array(
					'/',
					'/Signup/index',
					'/Signup/country'

				),
				'POST' => array(
					'/Signup/signup_action'
				)
			);

	protected function model($model)
	{
		require_once '../app/model/'.$model.'.php';

		return new $model;
	}


	protected function view($view,$data = [])
	{
		
		require_once '../app/view/'.$view.'.php';
	}


	protected function CheckRequestedMethod()
	{
		foreach ($this->UrlAgainstHttpMethod as $key => $value) {

			if ($key == 'GET' && $_SERVER['REQUEST_METHOD'] == 'GET') {

				if (in_array('/', $value) && $_SERVER['REQUEST_URI'] == '/') {

					$this->index();
					$this->RequestLog("success");
					exit;

				}
				else{

					foreach ($value as $urls) {

					    if (strpos($_SERVER['REQUEST_URI'], $urls) !== FALSE) {
							
							$method = explode('/', $_SERVER['REQUEST_URI']);
							
							$param =  array_slice($method,3);
							
							array_unshift($param,$method[2]);

							// $this->$method[2]();
							
							$this->RequestLog("success");
							
							return $param;
							
							exit;
					    }else{
							$this->RequestLog("failed");
							$this->view('ErrorPages/404');
							exit;
					    }

					}

				}
			
			}elseif ($key == 'POST' && $_SERVER['REQUEST_METHOD'] == 'POST') {


				if( $key == $_SERVER['REQUEST_METHOD'] && in_array( $_SERVER['REQUEST_URI'] , $value) )
				{
					$postdata = file_get_contents("php://input");
					$array = json_decode($postdata,true);

					$method = explode('/', $_SERVER['REQUEST_URI']);

					$this->$method[2]($array);
					$this->RequestLog("success");
					exit;				

				}else
				{
					$this->RequestLog("failed");
					$this->view('ErrorPages/404');
					exit;
				}
				
			}elseif ($key == 'PUT') {
			
				if( $key == $_SERVER['REQUEST_METHOD'] && in_array( $_SERVER['REQUEST_URI'] , $value) )
				{

					$method = explode('/', $_SERVER['REQUEST_URI']);
					$this->$method[2]();
					$this->RequestLog("success");
					exit;		

				}else
				{
					$this->RequestLog("failed");
					$this->view('ErrorPages/404');
					exit;
				}

			}elseif ($key == 'DELETE') {
				if( $key == $_SERVER['REQUEST_METHOD'] && in_array( $_SERVER['REQUEST_URI'] , $value) )
				{

					$method = explode('/', $_SERVER['REQUEST_URI']);
					$this->$method[2]();
					$this->RequestLog("success");
					exit;					

				}else
				{
					$this->RequestLog("failed");
					$this->view('ErrorPages/404');
					exit;
				}	
			}else{

				// $this->RequestLog("failed");
				// $this->view('ErrorPages/404');
				
			}
		}
	}

	private function RequestLog($status)
	{
		$myfile = fopen("../log.txt", "a");
		$txt = "Status : ".$status."    Method : ".$_SERVER['REQUEST_METHOD']."    Request URL : ".$_SERVER['REQUEST_URI']."     Time : ".date('i-h-s, j-m-y')."\n"; 
		fwrite($myfile, $txt);
		fclose($myfile);

	}



	
	
}



?>