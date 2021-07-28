<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model {

	const SESSION = "User";

	public static function login($login, $password)
	{

		$db = new Sql();

		$results = $db->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0)
		{
			throw new \Exception("Não foi possível fazer login");
		}	

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)
		{

			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {
			throw new \Exception("Usuário inexistente ou senha invalida");
		}
	
	}

	public static function verifyLogin($inadmin = true)
	{

		if (
			!isset($_SESSION[User::SESSION]) // !isset fizer algo acontecer se o isset for lógico FALSE
			|| //ou
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0 // no BD para ser administrador iduser > 0
			||
			(bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin  // !== diferente
		) {

			header("Location: /admin/login");
			exit;
		}


	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;
		
	}


}



?>

