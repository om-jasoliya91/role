<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Error extends BaseController
{
    public function notfound()
    {
        return view('errors/html/error_404', [
            'message' => session()->getFlashdata('error') ?? 'The page you are looking for does not exist.'
        ]);
    }

    public function general()
    {
        return view('errors/html/error_general', [
            'message' => session()->getFlashdata('error') ?? 'Something went wrong.'
        ]);
    }
}
