<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Journal
 * @package Proxmox\Api\Nodes\Node
 */
class Journal extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'journal/');
    }

    /**
     * Read Journal
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/journal
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}