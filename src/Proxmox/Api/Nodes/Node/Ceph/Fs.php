<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Api\Nodes\Node\Ceph\Fs\Name;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Fs
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Fs extends PVEPathClassBase
{
    /**
     * Fs constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'fs/');
    }

    /**
     * Create a Ceph filesystem
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/fs/{name}
     * @param string $name
     * @return Name
     */
    public function name(string $name): Name
    {
        return new Name($this->getPve(), $this->getPathAdditional() . $name . '/');
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/fs
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}