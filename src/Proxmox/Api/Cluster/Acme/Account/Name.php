<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme\Account;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Name
 * @package Proxmox\Api\Cluster\Acme\Account
 */
class Name extends PVEPathClassBase
{
    /**
     * Acme constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Return existing ACME account information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update existing ACME account information with CA. Note: not specifying any new account information triggers a refresh.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Deactivate existing ACME account at CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }

}