<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\Interfaces\PVEPathEndpointInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Storage
 * @package Proxmox\Api\Nodes\Node
 */
class Storage extends PVEPathClassBase implements PVEPathEndpointInterface
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'storage/');
    }

    /**
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage/{storage}
     * @param string $Storage
     * @return Storage\Storage
     */
    public function storage(string $Storage): Storage\Storage
    {
        return new Storage\Storage($this->getPve(), $this->getPathAdditional() . $Storage . '/');
    }

    /**
     * Get status for all datastores.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/storage
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}