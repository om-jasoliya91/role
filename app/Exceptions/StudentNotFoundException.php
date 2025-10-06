<?php
namespace App\Exceptions;

use PhpParser\Node\Expr;
use Exception;

class StudentNotFoundException extends Exception
{
    protected $message = 'Student not Found in the database.';
}
?>