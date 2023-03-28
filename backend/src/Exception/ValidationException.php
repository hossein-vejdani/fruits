<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    private ConstraintViolationListInterface $errors;
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }

    public function setErrors(ConstraintViolationListInterface $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
}
