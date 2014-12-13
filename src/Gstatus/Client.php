<?php

namespace Gstatus;

use Zend\Http\Client as ZFClient;
use Zend\Http\Request;
use Gstatus\Request\Status;

class Client
{
    private $token;
    private $client;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getHttpClient()
    {
        return $this->client;
    }

    public function setHttpClient($client)
    {
        $this->client = $client;
    }

    public function send(Status $request)
    {
        $request->prepareRequest($this->token);
        return $this->getHttpClient()->send($request);
    }
}
