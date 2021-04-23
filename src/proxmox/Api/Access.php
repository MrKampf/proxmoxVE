<?php
/**
 * @copyright 2019 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace proxmox\Api;

use proxmox\Api\Access\domains;
use proxmox\Api\Access\groups;
use proxmox\Api\Access\roles;
use proxmox\Api\Access\users;
use proxmox\pve;

/**
 * Class access
 * @package proxmox\api
 */
class Access extends pve
{
    /**
     * @var string
     */
    public string $pathAdditional;

    /**
     * @return string
     */
    public function getPathAdditional(): string
    {
        return $this->pathAdditional;
    }

    /**
     * @param string $pathAdditional
     */
    public function setPathAdditional(string $pathAdditional): void
    {
        $this->pathAdditional = $pathAdditional;
    }

    /**
     * Access constructor.
     *
     * TODO: Check is this the best method
     *
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param int $port
     * @param string $authType
     * @param bool $debug
     * @param string $pathAdditional
     */
    public function __construct(string $hostname, string $username, string $password, int $port, string $authType, bool $debug, string $pathAdditional)
    {
        $this->setPathAdditional($pathAdditional);
        parent::__construct($hostname, $username, $password, $port, $authType, $debug);
    }

    /**
     * Authentication domain index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/domains
     * @return domains
     */
    public function domains()
    {
        return new domains($this->httpClient, $this->apiURL . 'domains/', $this->cookie);
    }

    /**
     * Group index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return groups
     */
    public function groups()
    {
        return new groups($this->httpClient, $this->apiURL . 'groups/', $this->cookie);
    }

    /**
     * Role index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/roles
     * @return roles
     */
    public function roles()
    {
        return new roles($this->httpClient, $this->apiURL . 'roles/', $this->cookie);
    }

    /**
     * User index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/users
     * @return users
     */
    public function users()
    {
        return new users($this->httpClient, $this->apiURL . 'users/', $this->cookie);
    }

    /**
     * GET
     */

    /**
     * Directory index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return mixed
     */
    public function get()
    {
        return $this->getApi()->get($this->pathAdditional);
    }

    /**
     * Get Access Control List (ACLs).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/acl
     * @return mixed
     */
    public function getAcl()
    {
        return $this->getApi()->get($this->pathAdditional . "acl");
    }

    /**
     * Retrieve effective permissions of given user/token.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/permissions
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
     * Update Access Control List (add or remove permissions).
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/acl
     * @param array $params
     * @return mixed
     */
    public function putAcl(array $params)
    {
        return $this->getApi()->put($this->pathAdditional . "acl", $params);
    }

    /**
     * Change user password.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/password
     * @param array $params
     * @return mixed
     */
    public function putPassword(array $params)
    {
        return $this->getApi()->put($this->pathAdditional . "password", $params);
    }

    /**
     * Change user u2f authentication.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
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
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/tfa
     * @param array $params
     * @return mixed
     */
    public function postTfa(array $params)
    {
        return $this->getApi()->post($this->pathAdditional . "tfa", $params);
    }

    /**
     * Create or verify authentication ticket.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/ticket
     * @param array $params
     * @return mixed
     */
    public function postTicket(array $params)
    {
        return $this->getApi()->post($this->pathAdditional . "ticket", $params);
    }
}