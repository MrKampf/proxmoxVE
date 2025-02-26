<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Capabilities\Qemu;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Capabilities
 * @package Proxmox\Api\Nodes\Node
 */
class Capabilities extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'capabilities/');
    }

    /**
     * QEMU capabilities index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities/qemu
     * @return Qemu
     */
    public function qemu(): Qemu
    {
        return new Qemu($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node capabilities index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/capabilities
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}