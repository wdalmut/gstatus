<?php

namespace spec\Gstatus;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Zend\Http\Client as ZFClient;
use Gstatus\Request\Status;

class ClientSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("my token");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gstatus\Client');
    }

    function it_should_reply_with_the_body(ZFClient $client, Status $status)
    {
        $status->prepareRequest("my token")->shouldBeCalledTimes(1);
        $client->send($status)->shouldBeCalledTimes(1);

        $this->setHttpClient($client);
        $client->send($status)->willReturn("the body");

        $this->send($status)->shouldBe("the body");
    }
}
