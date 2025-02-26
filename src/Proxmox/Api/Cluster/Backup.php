<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Backup\Id;
use Proxmox\Helper\Interfaces\PVEPathClassInterface;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;
use Proxmox\API;

/**
 * Class Backup
 * @package Proxmox\Api\Cluster
 */
class Backup extends PVEPathClassBase implements PVEPathClassInterface
{
    /**
     * Backup constructor.
     * @param PVE|API $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE|API $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'backup/');
    }

    /**
     * Read vzdump backup job definition.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup/{id}
     * @param string $tokenId
     * @return Id
     */
    public function id(string $tokenId): Id
    {
        return new Id($this->getPve(), $this->getPathAdditional() . $tokenId . '/');
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @param array $params
     * @return array|null
     */
    public function get(array $params = []): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional(), $params);
    }

    /**
     * Create new vzdump backup job.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}