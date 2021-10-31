<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Certificates;

use Proxmox\Api\Nodes\Node\Certificates\Acme\Certificate;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Acme
 * @package Proxmox\Api\Nodes\Node\Certificates
 */
class Acme extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'acme/');
    }

    /**
     * Order a new certificate from ACME-compatible CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/certificate
     * @return Certificate
     */
    public function certificate(): Certificate
    {
        return new Certificate($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ACME index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/acme
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}