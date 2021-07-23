<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api;

use Proxmox\Api\Access\Acl;
use Proxmox\Api\Access\Domains;
use Proxmox\Api\Access\Groups;
use Proxmox\Api\Access\Roles;
use Proxmox\Api\Access\Users;
use Proxmox\Helper\Interfaces\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class access
 * @package proxmox\api
 */
class Access extends PVEPathClassBase
{

    /**
     * Access constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional = "")
    {
        parent::__construct($pve, $parentAdditional . 'access/');
    }

    /**
     * Authentication domain index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return Domains
     */
    public function domains(): Domains
    {
        return new Domains($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Group index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return Groups
     */
    public function groups(): Groups
    {
        return new Groups($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Role index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles
     * @return Roles
     */
    public function roles(): Roles
    {
        return new Roles($this->getPve(), $this->getPathAdditional());
    }

    /**
     * User index.
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @return Users
     */
    public function users(): Users
    {
        return new Users($this->getPve(), $this->getPathAdditional());
    }

    /**
     * Get Access Control List (ACLs).
     *
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/acl
     * @return Acl
     */
    public function acl(): Acl
    {
        return new Acl($this->getPve(), $this->getPathAdditional());
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Retrieve effective permissions of given user/token.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/permissions
     * @param array $params
     * @return mixed
     */
    public function getPermissions(array $params)
    {
        return $this->getApi()->get($this->pathAdditional . "permissions", $params);
    }

    /**
     * PUT
     */

    /**
     * Change user password.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/password
     * @param array $params
     * @return mixed
     */
    public function putPassword(array $params)
    {
        return $this->getApi()->put($this->pathAdditional . "password", $params);
    }

    /**
     * Change user u2f authentication.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param array $params
     * @return mixed
     */
    public function putTfa(array $params)
    {
        return $this->getApi()->put($this->pathAdditional . "tfa", $params);
    }

    /**
     * POST
     */

    /**
     * Finish a u2f challenge.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param array $params
     * @return mixed
     */
    public function postTfa(array $params)
    {
        return $this->getApi()->post($this->pathAdditional . "tfa", $params);
    }

    /**
     * Create or verify authentication ticket.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @param array $params
     * @return mixed
     */
    public function postTicket(array $params)
    {
        return $this->getApi()->post($this->pathAdditional . "ticket", $params);
    }
}