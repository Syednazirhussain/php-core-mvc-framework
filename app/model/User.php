<?php


class User extends pdocrudhandler
{


	public function getAllCountry()
	{
		$result = $this->select('country',array('*'));
		return $result;
	}


	public function signup($params)
	{
		$check = $this->select('users',array('*'),'where email = ?', array($params['email']) );
		if ($check["rowsAffected"] >= 1) {
			return ["status" => "failed","rowsAffected" => 0,"result" => "Email already taken"];
		}else{
			$password = md5($params['password']);
			$result = $this->insert('users',array(
				'fname'      => $params['fname'],
				'lname'      => $params['lname'],
				'email'      => $params['email'],
				'address'    => $params['address'],
				'dateofbirth'=> $params['dateofbirth'],
				'telephone'	 => $params['telephone'],
				'mobile'	 => $params['mobile'],
				'areacode'	 => $params['areacode'],
				'countryid'  => $params['country']
			));

			if ($result["status"] == "success" && $result["rowsAffected"] == 1) {

				$insert = $this->insert('account',array(
					'username'  => $params['username'],
					'password'  => $password,
					'ipAddress' => $_SERVER['REMOTE_ADDR'],
					'userAgent' => $_SERVER['HTTP_USER_AGENT'],
					'userid'	=> $result["lastInsertedId"]
				));

				if ($insert["status"] == "success" && $insert["rowsAffected"] == 1) {
					return $insert;
				}	
			}	
		}
	}


	public function login($params){

		$filter = new filter();

		$password = md5($params['password']);

		$result = $this->select('account',array('*'),'where username = ? and password = ?',array($params['username'],$password));
		if ($result['status'] == "success" && $result['rowsAffected'] == 1) {
			$_SESSION["accountid"] = $filter->Encrypt_id($result["result"][0]->accountid);
			$update = $this->update("account",array("ipAddress" => $_SERVER['REMOTE_ADDR'],"userAgent" => $_SERVER["HTTP_USER_AGENT"]),'where accountid = ?',array($result["result"][0]->accountid));
			if ($update["status"] == "success") {
				return $update;
			}else{
				return ["status" => "failed","result" => "There is some problem in updating"];
			}

		}else{
			return ["status" => "failed","result" => "username or password not found"];
		}
	}

	public function Logout(){

		$filter = new filter();

		if (isset($_SESSION['accountid'])) {
			$id = $filter->Decrypt_id($_SESSION['accountid']);

			$result = $this->select('account',array('userid'),'where accountid = ?',array($id));

			if ($result["status"] == "success" && $result["rowsAffected"] == 1) {
				unset($_SESSION['accountid']);
				session_destroy();
				return ["status" => "success"];
			}else{
				return ["status" => "failed","result" => $result];
			}			
		}else{
			return ["status" => "success"];
		}



	}


}



?>