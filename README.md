[![Build Status](https://travis-ci.org/gianarb/gstatus.svg)](https://travis-ci.org/gianarb/gstatus)

Little library to manage [Github Status API](https://github.com/blog/1935-see-results-from-all-pull-request-status-checks)

```php
<?php
use Gstatus\Client;
use Gstatus\Request\Status;
use Zend\Http\Client as HttpClient;

require 'vendor/autoload.php';

$status = new Status("gianarb", "gstatus");
$status->setStatusFor("1ab5f09eb4e736890b17b7abdb80ed3e368a478f", [
    "state" =>  "failure",
    "target_url" => "http://gianarb.it",
    "description" => "D'oh!",
    "context" => "my/test",
]);

$client = new Client($token);
$client->setHttpClient(new HttpClient());

$response = $client->send($status);

if ($response->getStatusCode() != 200) {
    throw new \RuntimeException("D'oh!!");
}
```

With the DiC

```php
<?php
$status = new Status("gianarb", "gstatus");
$status->setStatusFor("1ab5f09eb4e736890b17b7abdb80ed3e368a478f", [
    "state" =>  "failure",
    "target_url" => "http://gianarb.it",
    "description" => "D'oh!",
    "context" => "my/test",
]);

$client = $container->get("github.client");
$client->send($status);
```

## Install
` composer install gianarb/gstatus `

## Github Docs
[Api Statuses](https://developer.github.com/v3/repos/statuses/)

## Change Http Adapter
This lib use [Zend\Http](http://framework.zend.com/manual/2.3/en/modules/zend.http.client.html) see docs
Default it use socker adapter but support:
* Proxy
* Curl
```php
$zfclient = new \Zend\Http\Client();
$zfclient->setAdapter(new \Zend\Http\Client\Adapter\Curl());
$client = new \Gstatus\Client("token");
```
