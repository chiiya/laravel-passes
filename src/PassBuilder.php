<?php

namespace Chiiya\LaravelPasses;

use Chiiya\LaravelPasses\Domains\AppleDomain;
use Chiiya\LaravelPasses\Domains\GoogleDomain;

class PassBuilder
{
    public function __construct(
        protected AppleDomain $apple,
        protected GoogleDomain $google,
    ) {}

    public function apple(): AppleDomain
    {
        return $this->apple;
    }

    public function google(): GoogleDomain
    {
        return $this->google;
    }
}
