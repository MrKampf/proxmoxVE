<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Services\Service;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Stop
 * @package Proxmox\Api\Nodes\Node\Services\Service
 */
class Stop extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'stop/');
    }

    /**
     * Stop service.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/services/{service}/stop
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }
}