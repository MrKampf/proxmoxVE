<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Api\Cluster\Acme\Plugins\Id;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Plugins
 * @package Proxmox\Api\Cluster
 */
class Plugins extends PVEPathClassBase
{
    /**
     * Plugins constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'account/');
    }

    /**
     * Get ACME plugin configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/plugins/{id}
     * @param string $id
     * @return Id
     */
    public function id(string $id): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $id . '/');
    }

    /**
     * ACME plugin index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Add ACME plugin configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}