<?php

namespace Vendor\Library;

use Vendor\Library\Interfaces\ViewInterface;

abstract class AbstractView
{

    protected array $data;

    protected bool $hasLayout = true;

    protected Container $container;

    protected Request $request;


    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function setPath($path): self
    {
        if (!is_file($path)) {
            throw new \Exception('file not found');
        }
        $this->path = $path;

        return $this;
    }


    public function nolayout(): self
    {
        $this->hasLayout = false;
        return $this;
    }

    public function hasLayout(): bool
    {
        return $this->hasLayout;
    }

    public function setContainer(Container $container): self
    {
        $this->container = $container;
        return $this;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }

}