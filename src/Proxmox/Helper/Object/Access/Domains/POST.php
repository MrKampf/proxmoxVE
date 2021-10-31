<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox\Helper\Object\Access\Domains;

/**
 * Class POST
 * @package Proxmox\Helper\Object\Access\Domain
 */
class POST
{

    /**
     * TODO: Test this class
     */

    /**
     * @var string
     */
    private string $realm;
    /**
     * @var string
     */
    private string $type;
    /**
     * @var string
     */
    private string $baseDn;
    /**
     * @var string
     */
    private string $bindDn;
    /**
     * @var string
     */
    private string $capath;
    /**
     * @var bool
     */
    private bool $caseSensitive;
    /**
     * @var string
     */
    private string $cert;
    /**
     * @var string
     */
    private string $certKey;
    /**
     * @var string
     */
    private string $comment;
    /**
     * @var bool
     */
    private bool $default;
    /**
     * @var string
     */
    private string $domain;
    /**
     * @var string
     */
    private string $filter;
    /**
     * @var string
     */
    private string $groupClasses;
    /**
     * @var string
     */
    private string $groupDn;
    /**
     * @var string
     */
    private string $groupFilter;
    /**
     * @var string
     */
    private string $groupNameAttr;
    /**
     * @var string
     */
    private string $mode;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var int
     */
    private int $port;
    /**
     * @var bool
     */
    private bool $secure;
    /**
     * @var string
     */
    private string $server1;
    /**
     * @var string
     */
    private string $server2;
    /**
     * @var string
     */
    private string $sslVersion;
    /**
     * @var string
     */
    private string $syncDefaultsOptions;
    /**
     * @var string
     */
    private string $syncAttributes;
    /**
     * @var string
     */
    private string $tfa;
    /**
     * @var string
     */
    private string $userAttr;
    /**
     * @var string
     */
    private string $userClasses;
    /**
     * @var bool
     */
    private bool $verify;

    /**
     * POST constructor.
     * @param string $realm
     * @param string $type
     */
    public function __construct(string $realm, string $type)
    {
        $this->setRealm($realm);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getRealm(): string
    {
        return $this->realm;
    }

    /**
     * @param string $realm
     */
    public function setRealm(string $realm): void
    {
        $this->realm = $realm;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getBaseDn(): string
    {
        return $this->baseDn;
    }

    /**
     * @param string $baseDn
     */
    public function setBaseDn(string $baseDn): void
    {
        $this->baseDn = $baseDn;
    }

    /**
     * @return string
     */
    public function getBindDn(): string
    {
        return $this->bindDn;
    }

    /**
     * @param string $bindDn
     */
    public function setBindDn(string $bindDn): void
    {
        $this->bindDn = $bindDn;
    }

    /**
     * @return string
     */
    public function getCapath(): string
    {
        return $this->capath;
    }

    /**
     * @param string $capath
     */
    public function setCapath(string $capath): void
    {
        $this->capath = $capath;
    }

    /**
     * @return bool
     */
    public function isCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    /**
     * @param bool $caseSensitive
     */
    public function setCaseSensitive(bool $caseSensitive): void
    {
        $this->caseSensitive = $caseSensitive;
    }

    /**
     * @return string
     */
    public function getCert(): string
    {
        return $this->cert;
    }

    /**
     * @param string $cert
     */
    public function setCert(string $cert): void
    {
        $this->cert = $cert;
    }

    /**
     * @return string
     */
    public function getCertKey(): string
    {
        return $this->certKey;
    }

    /**
     * @param string $certKey
     */
    public function setCertKey(string $certKey): void
    {
        $this->certKey = $certKey;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->default;
    }

    /**
     * @param bool $default
     */
    public function setDefault(bool $default): void
    {
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getGroupClasses(): string
    {
        return $this->groupClasses;
    }

    /**
     * @param string $groupClasses
     */
    public function setGroupClasses(string $groupClasses): void
    {
        $this->groupClasses = $groupClasses;
    }

    /**
     * @return string
     */
    public function getGroupDn(): string
    {
        return $this->groupDn;
    }

    /**
     * @param string $groupDn
     */
    public function setGroupDn(string $groupDn): void
    {
        $this->groupDn = $groupDn;
    }

    /**
     * @return string
     */
    public function getGroupFilter(): string
    {
        return $this->groupFilter;
    }

    /**
     * @param string $groupFilter
     */
    public function setGroupFilter(string $groupFilter): void
    {
        $this->groupFilter = $groupFilter;
    }

    /**
     * @return string
     */
    public function getGroupNameAttr(): string
    {
        return $this->groupNameAttr;
    }

    /**
     * @param string $groupNameAttr
     */
    public function setGroupNameAttr(string $groupNameAttr): void
    {
        $this->groupNameAttr = $groupNameAttr;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     */
    public function setSecure(bool $secure): void
    {
        $this->secure = $secure;
    }

    /**
     * @return string
     */
    public function getServer1(): string
    {
        return $this->server1;
    }

    /**
     * @param string $server1
     */
    public function setServer1(string $server1): void
    {
        $this->server1 = $server1;
    }

    /**
     * @return string
     */
    public function getServer2(): string
    {
        return $this->server2;
    }

    /**
     * @param string $server2
     */
    public function setServer2(string $server2): void
    {
        $this->server2 = $server2;
    }

    /**
     * @return string
     */
    public function getSslVersion(): string
    {
        return $this->sslVersion;
    }

    /**
     * @param string $sslVersion
     */
    public function setSslVersion(string $sslVersion): void
    {
        $this->sslVersion = $sslVersion;
    }

    /**
     * @return string
     */
    public function getSyncDefaultsOptions(): string
    {
        return $this->syncDefaultsOptions;
    }

    /**
     * @param string $syncDefaultsOptions
     */
    public function setSyncDefaultsOptions(string $syncDefaultsOptions): void
    {
        $this->syncDefaultsOptions = $syncDefaultsOptions;
    }

    /**
     * @return string
     */
    public function getSyncAttributes(): string
    {
        return $this->syncAttributes;
    }

    /**
     * @param string $syncAttributes
     */
    public function setSyncAttributes(string $syncAttributes): void
    {
        $this->syncAttributes = $syncAttributes;
    }

    /**
     * @return string
     */
    public function getTfa(): string
    {
        return $this->tfa;
    }

    /**
     * @param string $tfa
     */
    public function setTfa(string $tfa): void
    {
        $this->tfa = $tfa;
    }

    /**
     * @return string
     */
    public function getUserAttr(): string
    {
        return $this->userAttr;
    }

    /**
     * @param string $userAttr
     */
    public function setUserAttr(string $userAttr): void
    {
        $this->userAttr = $userAttr;
    }

    /**
     * @return string
     */
    public function getUserClasses(): string
    {
        return $this->userClasses;
    }

    /**
     * @param string $userClasses
     */
    public function setUserClasses(string $userClasses): void
    {
        $this->userClasses = $userClasses;
    }

    /**
     * @return bool
     */
    public function isVerify(): bool
    {
        return $this->verify;
    }

    /**
     * @param bool $verify
     */
    public function setVerify(bool $verify): void
    {
        $this->verify = $verify;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }


}