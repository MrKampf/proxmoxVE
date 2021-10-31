<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Cluster;

use Proxmox\Api\Cluster\Acme\Account;
use Proxmox\Api\Cluster\Acme\ChallengeSchema;
use Proxmox\Api\Cluster\Acme\Directories;
use Proxmox\Api\Cluster\Acme\Plugins;
use Proxmox\Api\Cluster\Acme\Tos;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class Acme
 * @package Proxmox\Api\Cluster
 */
class Acme extends PVEPathClassBase
{
    /**
     * Acme constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'acme/');
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return Account
     */
    public function account(): Account
    {
        return new Account($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ACME plugin index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/account
     * @return Plugins
     */
    public function plugins(): Plugins
    {
        return new Plugins($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get schema of ACME challenge types.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/challenge-schema
     * @return ChallengeSchema
     */
    public function challengeSchema(): ChallengeSchema
    {
        return new ChallengeSchema($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get named known ACME directory endpoints.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/directories
     * @return Directories
     */
    public function directories(): Directories
    {
        return new Directories($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Retrieve ACME TermsOfService URL from CA.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme/tos
     * @return Tos
     */
    public function tos(): Tos
    {
        return new Tos($this->getPve(), $this->getPathAdditional());
    }

    /**
     * ACMEAccount index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster/acme
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

}