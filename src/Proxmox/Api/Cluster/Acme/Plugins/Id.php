<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme\Plugins;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Id
 * @package Proxmox\Api\Cluster\Acme\Plugins
 */
class Id extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * Id constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Get ACME plugin configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/plugins/{id}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Update ACME plugin configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/plugins/{id}
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete ACME plugin configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/plugins/{id}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}