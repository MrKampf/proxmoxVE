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
    }

    /**
     * Get the OpenId Authorization Url for the specified realm.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/auth-url
     * @return AuthUrl
     */
    public function authUrl(): AuthUrl
    {
        return new AuthUrl($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get the OpenId Authorization Url for the specified realm.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/openid/auth-url
     * @return Login
     */
    public function login(): Login
    {
        return new Login($this->getPve(), $this->getPathAdditional());
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