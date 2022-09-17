<?php

namespace Vendor\Library\Exceptions;

class ClassUnexistsException extends \Exception
{

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->code = 500;
    }

}