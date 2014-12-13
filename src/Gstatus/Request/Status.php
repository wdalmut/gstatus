<?php

namespace Gstatus\Request;

use Zend\Http\Request as ZFRequest;

class Status extends ZFRequest
{
    private $user;
    private $project;
    private $sha1;
    private $data;

    private $customUri = "https://api.github.com/repos/%s/%s/statuses/%s";

    public function __construct($user, $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    public function setStatusFor($sha1, array $data)
    {
        $this->sha1 = $sha1;
        $this->data = $data;
    }

    public function getStatus()
    {
        return [
            "sha1" => $this->sha1,
            "data" => $this->data,
        ];
    }

    public function prepareRequest($token)
    {
        $this->getHeaders()->clearHeaders();

        $this->setUri(sprintf($this->customUri, $this->user, $this->project, $this->sha1));
        $this->setMethod("POST");
        $this->getHeaders()->addHeaderLine("Authorization", "token {$token}");
        $this->getHeaders()->addHeaderLine("Content-Type", "application/json");
        $this->setContent(json_encode($this->data));
    }
}
