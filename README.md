# ProxmoxVE API
This **PHP 5.5+** Proxmox library allow, to interact with your Proxmox server and cluster via API.

[![Latest Stable Version](https://poser.pugx.org/mrkampf/proxmox-ve/v/stable)](https://packagist.org/packages/mrkampf/proxmox-ve)
[![Total Downloads](https://poser.pugx.org/mrkampf/proxmox-ve/downloads)](https://packagist.org/packages/mrkampf/proxmox-ve)
[![Latest Unstable Version](https://poser.pugx.org/mrkampf/proxmox-ve/v/unstable)](https://packagist.org/packages/mrkampf/proxmox-ve)
[![License](https://poser.pugx.org/mrkampf/proxmox-ve/license)](https://packagist.org/packages/mrkampf/proxmox-ve)

> You find any errors, typos or you detect that something is not working as expected please open an [issue](https://github.com/MrKampf/proxmoxVE/issues/new). I'll try to release a fix asap.

## Getting Started

Recommended installation is using **Composer**, if you do not have **Composer** what are you waiting?

In the root of your project execute the following:

```sh
$ composer require mrkampf/proxmox-ve
```

Or add this to your `composer.json` file:

```json
{
    "require": {
        "mrkampf/proxmox-ve": "~2.0"
    }
}
```

Then perform the installation:
```sh
$ composer install --no-dev
```

### Example

```php
<?php
// Require the autoloader
require_once 'vendor/autoload.php';

// Use the library namespace
use proxmox\pve;

// authType and port defaults to 'pam' and '8006' but you can specify them like so
$credentials = [
    'hostname' => '127.0.0.1',
    'username' => 'root',
    'password' => 'example',
    'authType' => 'pam',
    'port' => '8006',
];

// Then simply pass your credentials when creating the API client object.
$proxmox = new pve($credentials);

//Read all nodes
print_r($proxmox->nodes()->get());

```

[LICENSE]:./LICENSE
[PVE2 API Documentation]:http://pve.proxmox.com/pve-docs/api-viewer/index.html
[ProxmoxVE API]:http://pve.proxmox.com/wiki/Proxmox_VE_API
[Proxmox wiki]:http://pve.proxmox.com/wiki
[Composer]:https://getcomposer.org/