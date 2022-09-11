<?php

namespace Vendor\Library\ResponseStrategy;

class RedirectResponse
{

    public function toUrl($url, $code=403)
    {
        header(sprintf('location: %1$s', $url), true, $code);
    }

}