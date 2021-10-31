<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn\Dns;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Dns
 * @package Proxmox\Api\Cluster\Sdn\Dns
 */
class Dns extends PVEPathClassBase
{

    /**
     * Dns constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional);
    }

    /**
     * Read sdn dns configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Update sdn dns object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Delete sdn dns object configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}