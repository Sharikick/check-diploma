<?php

namespace App\Kernel\Http;

class Request implements RequestInterface
{
    private readonly string $method; // POST, GET
    private readonly string $url; // /login без query параметров

    private readonly array $query;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->url = strtok($_SERVER['REQUEST_URI'], '?');
        $this->query = match($this->method) {
            "GET" => $_GET,
            "POST" => $_POST,
        };
    }

    public function getPath(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function query(string $key, $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }
}
