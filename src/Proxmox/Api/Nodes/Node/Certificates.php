<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node;

use Proxmox\Api\Nodes\Node\Certificates\Acme;
use Proxmox\Api\Nodes\Node\Certificates\Custom;
use Proxmox\Api\Nodes\Node\Certificates\Info;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Certificates
 * @package Proxmox\Api\Nodes\Node
 */
class Certificates extends PVEPathClassBase
{
    /**
     * Apt constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'certificates/');
    }

    /**
     * ACME index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/acme
     * @return Acme
     */
    public function acme(): Acme
    {
        return new Acme($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Upload or update custom certificate chain and key.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/custom
     * @return Custom
     */
    public function custom(): Custom
    {
        return new Custom($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get information about node's certificates.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/info
     * @return Info
     */
    public function info(): Info
    {
        return new Info($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}