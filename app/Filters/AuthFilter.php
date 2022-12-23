<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!session()->isLoggedIn) {
      return redirect()->to("/login");
    }
    // Return...
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Return...
  }
}
