<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Apt;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Repositories
 * @package Proxmox\Api\Nodes\Node\Apt
 */
class Repositories extends PVEPathClassBase
{
    /**
     * Repositories constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'repositories/');
    }

    /**
     * Get APT repository information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/repositories
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Add a standard repository to the configuration
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/repositories
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Change the properties of a repository. Currently only allows enabling/disabling.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/repositories
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}