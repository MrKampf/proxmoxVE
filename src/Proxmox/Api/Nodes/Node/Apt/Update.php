<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Apt;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Update
 * @package Proxmox\Api\Nodes\Node\Apt
 */
class Update extends PVEPathClassBase
{
    /**
     * Update constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'update/');
    }

    /**
     * List available updates.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/update
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * This is used to resynchronize the package index files from their sources (apt-get update).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/update
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}