<?php

namespace Vendor\Library;

abstract class AbstractController
{

    protected Request $request;

    protected Response $response;

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     * @return AbstractController
     */
    public function setRequest(Request $request): AbstractController
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return AbstractController
     */
    public function setResponse(Response $response): AbstractController
    {
        $this->response = $response;
        return $this;
    }

}