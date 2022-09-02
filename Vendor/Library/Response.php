<?php

namespace Vendor\Library;

class Response
{

    /**
     * @var int
     */
    protected int $statusCode = 200;

    /**
     * @var string
     */
    protected string $responseMessage;

    /**
     * @var string
     */
    protected string $body;

    /**
     * @var string
     */
    protected string $strategy = 'HTML';

    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return Response
     */
    public function setStatusCode(int $statusCode): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseMessage(): string
    {
        return $this->responseMessage;
    }

    /**
     * @param string $responseMessage
     * @return Response
     */
    public function setResponseMessage(string $responseMessage): Response
    {
        $this->responseMessage = $responseMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Response
     */
    public function setBody(string $body): Response
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param string $strategy
     * @return Response
     */
    public function setStrategy(string $strategy): Response
    {
        $this->strategy = $strategy;
        return $this;
    }

}