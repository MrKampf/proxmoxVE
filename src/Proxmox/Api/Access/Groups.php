<?php
/**
 * @copyright 2020 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Api\Access;

use Proxmox\Api\Access\Groups\GroupId;
use Proxmox\Helper\PVEPathClassBase;
use Proxmox\PVE;

/**
 * Class groups
 * @package proxmox\api\access
 */
class Groups extends PVEPathClassBase
{
    /**
     * Groups constructor.
     * @param PVE $pve
     * @param string $parentAdditional
     */
    public function __construct(PVE $pve, string $parentAdditional)
    {
        parent::__construct($pve, $parentAdditional . 'groups/');
    }

    /**
     * Get group configuration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups/{groupid}
     * @param string $groupId
     * @return GroupId
     */
    public function groupId(string $groupId): GroupId
    {
        return new GroupId($this->getPve(), $this->getPathAdditional() . $groupId . '/');
    }

    /**
     * Group index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @return array|null
     */
    public function get(): ?array
    {
        return $this->getPve()->getApi()->get($this->getPathAdditional());
    }

    /**
     * Create new group.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access/groups
     * @param array $params
     * @return array|null
     */
    public function post(array $params = []): ?array
    {
        return $this->getPve()->getApi()->post($this->getPathAdditional(), $params);
    }

}