<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Proxmox\Api\Access;
use Proxmox\Api\Cluster;
use Proxmox\Api\Nodes;
use Proxmox\Api\Pools;
use Proxmox\Api\Storage;
use Proxmox\Api\Version;
use Proxmox\Helper\Api;

/**
 * Class pve
 * @package proxmox
 */
class PVE
{

    /**
     * @var Client
     */
    private Client $httpClient;

    /**
     * @var Api
     */
    private Api $api;

    /**
     * @var CookieJar
     */
    private CookieJar $cookie;

    /**
     * @var string
     */
    private string $hostname, $apiURL, $username, $password, $authType, $CSRFPreventionToken, $ticket;

    /**
     * @var int
     */
    private int $port;

    /**
     * @var boolean
     */
    private bool $debug;

    /**
     * pve constructor.
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param int $port
     * @param string $authType
     * @param bool $debug
     */
    public function __construct(string $hostname, string $username, string $password, int $port = 8006, string $authType = "pam", bool $debug = false)
    {
        $this->setHostname($hostname); //Save hostname in class variable
        $this->setUsername($username); //Save username in class variable
        $this->setPassword($password); //Save user password in class variable
        $this->setPort($port); //Save port in class variable
        $this->setAuthType($authType); //Save auth type in class variable
        $this->setDebug($debug); //Save the debug boolean variable
        $this->setApiURL('https://' . $this->getHostname() . ':' . $this->getPort() . '/api2/json/'); //Create the basic api url
        $this->setApi(new Api($this));
        $this->setHttpClient(new Client());
        $this->getApi()->login();
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $authType
     */
    public function setAuthType(string $authType): void
    {
        $this->authType = $authType;
    }

    /**
     * @param string $apiURL
     */
    public function setApiURL(string $apiURL): void
    {
        $this->apiURL = $apiURL;
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
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
     * @return Api
     */
    public function getApi(): Api
    {
        return $this->api;
    }

    /**
     * @param Api $api
     */
    public function setApi(Api $api): void
    {
        $this->api = $api;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     */
    public function setHttpClient(Client $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     */
    public function getApiURL(): string
    {
        return $this->apiURL;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAuthType(): string
    {
        return $this->authType;
    }

    /**
     * @return string
     */
    public function getCSRFPreventionToken(): string
    {
        return $this->CSRFPreventionToken;
    }

    /**
     * @param string $CSRFPreventionToken
     */
    public function setCSRFPreventionToken(string $CSRFPreventionToken): void
    {
        $this->CSRFPreventionToken = $CSRFPreventionToken;
    }

    /**
     * @return string
     */
    public function getTicket(): string
    {
        return $this->ticket;
    }

    /**
     * @param string $ticket
     */
    public function setTicket(string $ticket): void
    {
        $this->ticket = $ticket;
    }

    /**
     * @return bool
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    /**
     * @return CookieJar
     */
    public function getCookie(): CookieJar
    {
        return $this->cookie;
    }

    /**
     * @param CookieJar $cookie
     */
    public function setCookie(CookieJar $cookie): void
    {
        $this->cookie = $cookie;
    }

    /**
     * Directory index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/access
     * @return Access
     */
    public function access(): Access
    {
        return new Access($this, "");
    }

    /**
     * Cluster index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/cluster
     * @return Cluster
     */
    public function cluster(): Cluster
    {
        return new Cluster($this, "");
    }

    /**
     * Node index.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/#/nodes/{node}
     * @return Nodes
     */
    public function nodes(): Nodes
    {
        return new Nodes($this, "");
    }

    /**
     * Storage index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/storage
     * @return Storage
     */
    public function storage(): Storage
    {
        return new Storage($this, "");
    }

    /**
     * Pool index.
     * @url https://pve.proxmox.com/pve-docs/api-viewer/index.html#/pools
     * @return Pools
     */
    public function pools(): Pools
    {
        return new Pools($this, "");
    }

    /**
     * API version details. The result also includes the global datacenter confguration.
     * @link https://pve.proxmox.com/pve-docs/api-viewer/index.html#/version
     * @return Version
     */
    public function version(): Version
    {
        return new Version($this, "");
    }

}