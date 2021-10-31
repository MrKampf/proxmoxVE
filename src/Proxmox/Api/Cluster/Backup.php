<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Backup\Id;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Backup
 * @package Proxmox\Api\Cluster
 */
class Backup extends PVEPathClassBase
{
    /**
     * Backup constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
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
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create new vzdump backup job.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/backup
     * @param $params array
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}