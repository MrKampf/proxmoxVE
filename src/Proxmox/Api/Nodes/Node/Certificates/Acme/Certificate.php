<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Nodes\Node\Certificates\Acme;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Certificate
 * @package Proxmox\Api\Nodes\Node\Certificates
 */
class Certificate extends PVEPathClassBase
{
    /**
     * Init constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'certificate/');
    }

    /**
     * Order a new certificate from ACME-compatible CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/certificate
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

    /**
     * Renew existing certificate from CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/certificate
     * @param $params array
     * @return array|null
     */
    public function put(array $params = []): ?array
    {
        return $this->getPve()->getApi()->put($this->getPathAdditional(), $params);
    }

    /**
     * Revoke existing certificate from CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}/certificates/certificate
     * @return array|null
     */
    public function delete(): ?array
    {
        return $this->getPve()->getApi()->delete($this->getPathAdditional());
    }
}