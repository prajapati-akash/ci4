<?php
namespace App\Libraries;

class Encryption extends \CodeIgniter\Encryption\Encryption
{
	public function __construct()
	{
		parent::__construct();
		$this->encrypter = \Config\Services::encrypter();

	}

	public function myMethod($data)
	{
		return $this->encrypter->encrypt($data);
	}
	
	public function decode($data)
	{
		return $this->encrypter->decrypt($data);
	}
}