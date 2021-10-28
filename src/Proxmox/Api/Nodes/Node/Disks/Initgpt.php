<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Disks;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Initgpt
 * @package Proxmox\Api\Nodes\Node\Disks
 */
class Initgpt extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'initgpt/');
    }

    /**
     * Initialize Disk with GPT
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/disks/initgpt
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}