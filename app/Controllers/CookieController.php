<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CookieController extends BaseController
{
    public function setCookie()
    {
        $cookie = [
            'name' => 'user_token',
            'value' => 'abcd1234',
            'expire' => 10,
            'httponly' => true,
        ];
        response()->setCookie($cookie);
        return 'Cookie has been set';
    }

    public function getCookie()
    {
        $cookieValue = $this->request->getCookie('user_token');
        if ($cookieValue) {
            return 'cookie value is:' . $cookieValue;
        } else {
            return 'Cookie not found';
        }
    }

    public function deleteCookie()
    {
        response()->deleteCookie('user_token');
        return 'Cookie Has Been Not Found';
    }
}
