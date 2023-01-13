<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index($a=null, $b='home')
	{
		return view('home/index');

		//return $this->response->setStatusCode(200)->setBody('Witaj żwiecie');

		// helper('text');

		// return $this->response->setJSON(array(
		// 	'a' => $a,
		// 	'b' => $b,
		// 	'c' => random_string('crypto', 8)
		// ));
	}

	public function testEmail()
	{
		$email = service('email');

		$email->setTo('msgarski@gmail.com');

		$email->setFrom('garski@wp.pl');

		$email->setSubject('Testowa wiadomość');

		$email->setMessage('<h1>Witajcie!!!</h1>');

		if($email->send())
		{
			echo "Wysłano z sukcesem!";
		}
		else
		{
			echo $email->printDebugger();
		}
	}
}
