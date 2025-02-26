<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Sdn;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Dns
 * @package Proxmox\Api\Cluster\Sdn
 */
class Dns extends PVEPathClassBase
{
    /**
     * Dns constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'dns/');
    }

    /**
     * Read sdn dns configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @param string $dns
     * @return Dns\Dns
     */
    public function controller(string $dns): Dns\Dns
    {
        return new Dns\Dns($this->getPve(), $this->getPathAdditional() . $dns . '/');
    }

    /**
     * SDN dns index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create a new sdn dns object.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/cluster/sdn/dns/{dns}
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}