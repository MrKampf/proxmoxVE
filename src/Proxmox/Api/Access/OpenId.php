<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\Access\OpenId\AuthUrl;
use Proxmox\Api\Access\OpenId\Login;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class OpenId
 * @package Proxmox\Api\Access
 */
class OpenId extends PVEPathClassBase
{

    /**
     * OpenId constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'openid/');
        return $this->get();
    }

    /**
     * Get the OpenId Authorization Url for the specified realm.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/auth-url
     * @param array $params
     * @return AuthUrl
     */
    public function authUrl(array $params = []): AuthUrl
    {
        return new AuthUrl($this->getPve(), $this->getPathAdditional(), $params);
    }

    /**
     * Get the OpenId Authorization Url for the specified realm.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/auth-url
     * @param array $params
     * @return Login
     */
    public function login(array $params = []): Login
    {
        return new Login($this->getPve(), $this->getPathAdditional(), $params);
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}