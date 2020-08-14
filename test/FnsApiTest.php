<?php

namespace alexshadie\fns;

use alexshadie\fns\exception\FnsCallException;
use PHPUnit\Framework\TestCase;

class FnsApiTest extends TestCase
{
    public function testCheckVersion()
    {
        $fnsApi = new FnsApi();
        $v = $fnsApi->checkVersion();

        // Used to track version updated on remote side
        $this->assertEquals('v2.9.2', $v->getVersion());
        $this->assertEquals('25ad92fa', $v->getRevision());
    }

    public function testAuthorize()
    {
        $fnsApi = new FnsApi();
        try {
            $fnsApi->checkTicket(TEST_TICKET);
            $this->fail("Must be unauthorized");
        } catch (FnsCallException $e) {
            $this->assertEquals('Unauthorized', $e->getMessage());
        }

        $authData = new AuthData(TEST_INN, TEST_PASSWORD);
        $sessionData = $fnsApi->authenticate($authData);

        $fnsApi->setSessionData($sessionData);

        $status = $fnsApi->checkTicket(TEST_TICKET);
        $this->assertEquals('kkt', $status->getKind());
        $this->assertEquals(2, $status->getStatus());
    }

    public function testRefresh()
    {
        $fnsApi = new FnsApi();
        $authData = new AuthData(TEST_INN, TEST_PASSWORD);
        $sessionData = $fnsApi->authenticate($authData);

        $fnsApi = new FnsApi($sessionData);

        $sessionData = $fnsApi->refresh($sessionData);
        $fnsApi->setSessionData($sessionData);

        $status = $fnsApi->checkTicket(TEST_TICKET);
        $this->assertEquals('kkt', $status->getKind());
        $this->assertEquals(2, $status->getStatus());
    }

    public function testCheckTicket()
    {
        $fnsApi = new FnsApi();
        $authData = new AuthData(TEST_INN, TEST_PASSWORD);
        $sessionData = $fnsApi->authenticate($authData);

        $fnsApi = new FnsApi($sessionData);
        $status = $fnsApi->checkTicket(TEST_TICKET);
        $this->assertEquals('kkt', $status->getKind());
        $this->assertEquals(2, $status->getStatus());
    }

    public function testGetTicket()
    {
        $fnsApi = new FnsApi();
        $authData = new AuthData(TEST_INN, TEST_PASSWORD);
        $sessionData = $fnsApi->authenticate($authData);

        $fnsApi = new FnsApi($sessionData);
        $status = $fnsApi->checkTicket(TEST_TICKET);

        $ticket = $fnsApi->getTicket($status->getId());

        $this->assertEquals($status->getId(), $ticket->getId());
    }
}
