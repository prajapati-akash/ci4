<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Admin_login implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (! session()->has('admin_id'))
		{
			return redirect()->route('admin_login');
		}
	}
	
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
