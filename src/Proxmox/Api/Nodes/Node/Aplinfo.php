<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Aplinfo
 * @package Proxmox\Api\Nodes\Node
 */
class Aplinfo extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'aplinfo/');
    }

    /**
     * Get list of appliances.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/aplinfo
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Download appliance templates.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/aplinfo
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}