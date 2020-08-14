<?php

namespace alexshadie\fns;

use PHPUnit\Framework\TestCase;

class AuthDataTest extends TestCase
{
    public function testCreate()
    {
        $auth = new AuthData('123', 'password');
        $this->assertEquals('123', $auth->getInn());
        $this->assertEquals('password', $auth->getPassword());
    }
}
