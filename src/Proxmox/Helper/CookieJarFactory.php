<?php

namespace Proxmox\Helper;

use GuzzleHttp\Cookie\CookieJar;
use Proxmox\Helper\Interfaces\CookieJarFactoryInterface;

class CookieJarFactory implements CookieJarFactoryInterface
{
    public function create(array $cookies, string $domain): CookieJar
    {
        return CookieJar::fromArray($cookies, $domain);
    }
}
