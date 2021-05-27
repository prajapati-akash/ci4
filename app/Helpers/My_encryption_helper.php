<?php
function encode($data = null)
{
		$encrypter = \Config\Services::encrypter();
		return bin2hex($encrypter->encrypt($data));
}	
function decode($data = null)
{
		$encrypter = \Config\Services::encrypter();
		return $encrypter->decrypt(hex2bin($data));
}

// class My_encryption
// {
// 	public function __construct()
// 	{
// 		$this->encrypter = \Config\Services::encrypter();
// 	}

// 	public function encode($data = null)
// 	{
// 		return bin2hex($this->encrypter->encrypt($data));
// 	}	

// 	public function decode($data = null)
// 	{
// 		return $this->encrypter->decrypt(hex2bin($data));
// 	}
// }
