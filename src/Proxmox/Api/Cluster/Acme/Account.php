<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Api\Cluster\Acme\Account\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Account
 * @package Proxmox\Api\Cluster
 */
class Account extends PVEPathClassBase
{
    /**
     * Acme constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'account/');
    }

    /**
     * Return existing ACME account information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account/{name}
     * @param string $name
     * @return Name
     */
    public function name(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Register a new ACME account with CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}