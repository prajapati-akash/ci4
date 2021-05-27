<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth_filter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (! session()->has('user_id'))
		{
			return redirect()->route('user_login');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
