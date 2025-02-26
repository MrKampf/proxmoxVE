<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Ceph;

use Proxmox\Api\Nodes\Node\Ceph\Mgr\Id;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Mgr
 * @package Proxmox\Api\Nodes\Node\Ceph
 */
class Mgr extends PVEPathClassBase
{

    /**
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'mgr/');
    }

    /**
     * MGR directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mgr
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create Ceph Manager
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/ceph/mgr/{id}
     * @param string $id
     * @return Id
     */
    public function id(string $id): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $id . '/');
    }

}