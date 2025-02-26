<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster\Acme;

use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class ChallengeSchema
 * @package Proxmox\Api\Cluster
 */
class ChallengeSchema extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * ChallengeSchema constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'challenge-schema/');
    }

    /**
     * Get schema of ACME challenge types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/challenge-schema
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }
}