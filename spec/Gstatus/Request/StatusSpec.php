<?php

namespace spec\Gstatus\Request;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Http\Headers;

class StatusSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("gianarb", "project");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gstatus\Request\Status');
        $this->shouldBeAnInstanceOf('Zend\\Http\\Request');
    }

    function it_allow_status_preparation()
    {
        $this->setStatusFor("sha1", []);
        $this->getStatus()->shouldBe(["sha1" => "sha1", "data" => []]);
    }

    function it_should_be_preparable(Headers $headers)
    {
        $headers->clearHeaders()->shouldBeCalledTimes(1);
        $headers->addHeaderLine("Content-Type", "application/json")->shouldBeCalledTimes(1);
        $headers->addHeaderLine("Authorization", "token token")->shouldBeCalledTimes(1);

        $this->setHeaders($headers);
        $this->setStatusFor("sha1", ["pippo" => "pluto"]);
        $this->prepareRequest("token");

        $this->getUri()->toString()->shouldBe("https://api.github.com/repos/gianarb/project/statuses/sha1");
        $this->getContent()->shouldBe('{"pippo":"pluto"}');
        $this->getMethod()->shouldBe("POST");
    }
}
