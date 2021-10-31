<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Apt\Changelog;
use Proxmox\Api\Nodes\Node\Apt\Repositories;
use Proxmox\Api\Nodes\Node\Apt\Update;
use Proxmox\Api\Nodes\Node\Apt\Versions;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Apt
 * @package Proxmox\Api\Nodes\Node
 */
class Apt extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'apt/');
    }

    /**
     * Get package changelogs.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/changelog
     * @return Changelog
     */
    public function changelog(): Changelog
    {
        return new Changelog($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get APT repository information.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/repositories
     * @return Repositories
     */
    public function repositories(): Repositories
    {
        return new Repositories($this->getPve(), $this->getPathAdditional());
    }

    /**
     * List available updates.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/update
     * @return Update
     */
    public function update(): Update
    {
        return new Update($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get package information for important Proxmox packages.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt/versions
     * @return Versions
     */
    public function versions(): Versions
    {
        return new Versions($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Directory index for apt (Advanced Package Tool).
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/apt
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}