<?php

namespace Proxmox;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Proxmox\Api\Access;
use Proxmox\Api\Cluster;
use Proxmox\Api\Nodes;
use Proxmox\Api\Pools;
use Proxmox\Api\Storage;
use Proxmox\Api\Version;
use Proxmox\Helper\ApiToken;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class API
{

    /**
     * @var Client
     */
    private Client $httpClient;

    /**
     * @var ApiToken
     */
    private ApiToken $api;

    /**
     * @var CookieJar
     */
    private CookieJar $cookie;

    /**
     * @var string
     */
    private string $hostname, $apiURL, $user, $secret;

    /**
     * @var int
     */
    private int $port;

    /**
     * @var boolean
     */
    private bool $debug;

    /**
     * @var LoggerInterface|null
     */
    private ?LoggerInterface $logger;

    /**
     * @var boolean
     */
    private bool $throwOnError;

    /**
     * pve constructor.
     * @param string $hostname
     * @param string $user
     * @param string $secret
     * @param int $port
     * @param bool $debug
     * @param Client|null $httpClient
     * @param LoggerInterface|null $logger Optional PSR-3 logger. When set, API
     *        errors are logged (always, independent of $debug) and request/
     *        response info is mirrored to it at debug level instead of
     *        php://stderr.
     * @param bool $throwOnError When true a failed request raises a
     *        ProxmoxApiException (carrying the HTTP status + response body)
     *        instead of returning null. Defaults to false for backwards
     *        compatibility.
     */
    public function __construct(string $hostname, string $user, string $secret, int $port = 8006, bool $debug = false, Client|null $httpClient = null, ?LoggerInterface $logger = null, bool $throwOnError = false)
    {
        $this->setHostname($hostname); //Save hostname in class variable
        $this->setUser($user); //Save user in class variable
        $this->setSecret($secret); //Save secret in class variable
        $this->setPort($port); //Save port in class variable
        $this->setDebug($debug); //Save the debug boolean variable
        $this->logger = $logger; //Optional PSR-3 logger
        $this->throwOnError = $throwOnError; //Opt-in: throw instead of returning null
        $this->setApiURL('https://' . $this->getHostname() . ':' . $this->getPort() . '/api2/json/'); //Create the basic api url
        $this->setApi(new ApiToken($this)); //Create the api object

        if ($httpClient === NULL) {
            $httpClient = new Client(['handler' => $this->buildHandlerStack()]); //Create a new guzzle client
        }

        $this->setHttpClient($httpClient); //Save the guzzle client
    }

    /**
     * Build the Guzzle handler stack, attaching a PSR-3 logging middleware
     * when a logger has been supplied. Logged at debug level so it stays
     * quiet in production until the consumer raises the relevant channel.
     *
     * @return HandlerStack
     */
    private function buildHandlerStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        if ($this->logger !== null) {
            $stack->push(Middleware::log(
                $this->logger,
                new MessageFormatter('Proxmox API {method} {target} HTTP {code} {error}'),
                LogLevel::DEBUG
            ));
        }

        return $stack;
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger(): ?LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return bool
     */
    public function getThrowOnError(): bool
    {
        return $this->throwOnError;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
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
     * @return ApiToken
     */
    public function getApi(): ApiToken
    {
        return $this->api;
    }

    /**
     * @param ApiToken $api
     */
    public function setApi(ApiToken $api): void
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
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
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