<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\ValidatorInterface;

interface RequestInterface
{
    public function getPath(): string;
    public function getMethod(): Method;
    public function input(string $key, $default = null): mixed;
    public function setValidator(ValidatorInterface $validator):void;
    public function validate(array $rules):bool;
    public function getErrors():array;
}
