<?php


class Signup extends Controller
{

	function __construct(){

		$params =  $this->CheckRequestedMethod();
		$method = $params[0];
		array_shift($params);
		call_user_func_array(array($this,$method), $params);
	}


	public function index()
	{
		$this->view('Signup/index',func_get_args());
	}


	public function country(){

		$user = $this->model("User");
		return json_encode($user->getAllCountry());

	}


	public function signup_action($params = []){


		$pdo = new pdocrudhandler();

		$password = md5($params["password"]);

		$result = $pdo->insert('users',array(
			'fname' => $params["fname"],
			'lname' => $params["lname"],
			'email' => $params["email"],
			'address' => $params["address"],
			'cid' => $params["country"],
			'areacode' => $params["areacode"],
			'telephone' => $params["telephone"],
			'mobile' => $params["mobile"],
			'dateofbirth' => $params["dateofbirth"],
			'username' => $params["username"],
			'password' => $password,

		));

		echo json_encode($result);



	}




}






?>