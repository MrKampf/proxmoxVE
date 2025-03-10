<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\API;
use Proxmox\PVE;

/**
 * Class Vncshell
 * @package Proxmox\Api\Nodes\Node
 */
class Vncshell extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'vncshell/');
    }

    /**
     * Creates a VNC Shell proxy.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/vncshell
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}