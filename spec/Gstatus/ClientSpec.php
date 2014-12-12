<?php

namespace spec\Gstatus;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("your-token");
        $this->shouldHaveType('Gstatus\Client');
    }
}
