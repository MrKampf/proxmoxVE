<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Lxc\VmId;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Config
 * @package Proxmox\Api\Nodes\Node\Lxc\VmId
 */
class Config extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'config/');
    }

    /**
     * Get container configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/config
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Set container options.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/lxc/{vmid}/config
     * @param array $params
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }
}