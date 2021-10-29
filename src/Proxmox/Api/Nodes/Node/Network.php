<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Network\Iface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Network
 * @package Proxmox\Api\Nodes\Node
 */
class Network extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'network/');
    }

    /**
     * Read network device configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network/{iface}
     * @param string $pciId
     * @return \Proxmox\Api\Nodes\Node\Network\Iface
     */
    public function iface(string $pciId): Iface
    {
        return new Iface($this->getPve(), $this->getPathAdditional() . $pciId . '/');
    }

    /**
     * List available networks
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());

    }

    /**
     * Create network device configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Reload network configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Revert network configuration changes.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/network
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}