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
     * @var View
     */
    protected View $view;

    /**
     * @var Layout
     */
    protected ?Layout $layout=null;

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
     * @return View
     */
    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @param View $view
     * @return Response
     */
    public function setView(View $view): Response
    {
        $this->view = $view;
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

    /**
     * @return Layout|null
     */
    public function getLayout(): ?Layout
    {
        return $this->layout;
    }

    /**
     * @param Layout $layout
     * @return Response
     */
    public function setLayout(Layout $layout): Response
    {
        $this->layout = $layout;
        return $this;
    }

}