<?php
/*
 * @copyright 2021 Daniel Engelschalk <hello@mrkampf.com>
 */

namespace Proxmox;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
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
     * @var false|string
     */
    private string|false $debug;

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
     * @return string
     */
    public function getApiURL(): string
    {
        return $this->apiURL;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
     * @return string
     */
    public function getAuthType(): string
    {
        return $this->authType;
    }

    /**
     * @param string $authType
     */
    public function setAuthType(string $authType): void
    {
        $this->authType = $authType;
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
     * @return false|string
     */
    public function getDebug(): bool|string
    {
        return $this->debug;
    }

    /**
     * @param bool|string $debug
     */
    public function setDebug(bool|string $debug): void
    {
        $this->debug = $debug;
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
     * pve constructor.
     *
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

}