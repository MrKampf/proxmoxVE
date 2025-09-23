<?php

namespace Proxmox\Helper\Interfaces;

use GuzzleHttp\Cookie\CookieJar;

interface CookieJarFactoryInterface
{
    public function create(array $cookies, string $domain): CookieJar;
}
