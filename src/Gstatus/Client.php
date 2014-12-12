<?php

namespace Gstatus;

use Zend\Http\Client as ZFClient;
use Zend\Http\Request;

class Client
{
    private $client;
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getClient()
    {
        if (!$this->client){
            $this->client = new ZFClient();
        }
        return $this->client;
    }

    public function setClient($c)
    {
        $this->client = $c;
    }

    public function send($owner, $repo, $sha, $data)
    {
        $request = new Request();
        $request->setMethod("POST");
        $request->setUri("https://api.github.com/repos/{$owner}/{$repo}/statuses/{$sha}");
        $request->getHeaders()->addHeaderLine("Authorization", "token {$this->token}");
        $request->getHeaders()->addHeaderLine("Content-Type", "application/json");
        $request->setContent(json_encode($data));
        return $this->getClient()->send($request);
    }
}
