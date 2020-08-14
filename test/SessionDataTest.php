<?php

namespace alexshadie\fns;

use PHPUnit\Framework\TestCase;

class SessionDataTest extends TestCase
{
    public function testCreate()
    {
        $sd = new SessionData('clientSecret', 'sessionId', 'refreshToken');
        $this->assertEquals('clientSecret', $sd->getClientSecret());
        $this->assertEquals('sessionId', $sd->getSessionId());
        $this->assertEquals('refreshToken', $sd->getRefreshToken());
    }
}
