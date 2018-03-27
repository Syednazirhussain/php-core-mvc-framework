<?php

class filter
{

	const salt = "HackingNotAllowed";

	private $error = array();


	public function CheckFieldNotNull($params = [])
	{
		foreach ($params as $key => $value) {
			if (empty($value)) {
				$this->error[$key] = $key." must be entered";
			}
		}
		return $this->error;
	}

	public function Encrypt_id($id){

		$encrypted_id = base64_encode($id .self::salt);
		return $encrypted_id;

	}

	public function Decrypt_id($hash){

		$decrypted_id_raw = base64_decode($hash);
		$decrypted_id = preg_replace(sprintf('/%s/', self::salt), '', $decrypted_id_raw);
		return $decrypted_id;

	}

	public function image(){
		$str = md5(microtime());

		$str = substr($str,0,6);
		        
		$img = imagecreate(100, 50);

		imagecolorallocate($img, 255, 255, 255);

		$txtcol = imagecolorallocate($img, 0, 0, 0);

		imagestring($img, 24, 5, 5, $str, $txtcol);

		//header('Content:image/jpeg');

		return imagejpeg($img);
	}


}



?>