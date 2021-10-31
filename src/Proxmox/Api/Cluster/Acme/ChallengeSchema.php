<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class ChallengeSchema
 * @package Proxmox\Api\Cluster
 */
class ChallengeSchema extends PVEPathClassBase
{
    /**
     * ChallengeSchema constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'challenge-schema/');
    }

    /**
     * Get schema of ACME challenge types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/challenge-schema
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }
}