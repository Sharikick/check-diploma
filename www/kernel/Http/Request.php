<?php

namespace App\Kernel\Http;

use App\Kernel\Validator\ValidatorInterface;

class Request implements RequestInterface
{
    private ValidatorInterface $validator;

    public readonly array $get;
    public readonly array $post;
    public readonly array $server;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
    }

    public function getPath(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function getMethod(): Method
    {
        return match($this->server['REQUEST_METHOD']) {
            'GET' => Method::GET,
            'POST' => Method::POST,
            'PUT' => Method::PUT,
            'DELETE' => Method::DELETE
        };
    }

    public function input(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    public function validate(array $rules): bool
    {
        $data = [];

        foreach ($rules as $field => $rule) {
            $data[$field] = $this->input($field);
        }

        return $this->validator->validate($data, $rules);
    }

    public function getErrors(): array
    {
        return $this->validator->getErrors();
    }

}
