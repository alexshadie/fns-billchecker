<?php

namespace alexshadie\fns;

use PHPUnit\Framework\TestCase;

class RequestDataTest extends TestCase
{
    public function testCreate()
    {
        $rd = new BillRequestData(
            'dt', 100, 111, 111222, 111222333, 1
        );
        $this->assertEquals('dt', $rd->getDate());
        $this->assertEquals(100, $rd->getSum());
        $this->assertEquals('111', $rd->getFiscalNumber());
        $this->assertEquals('111222', $rd->getFiscalDocument());
        $this->assertEquals('111222333', $rd->getFiscalSign());
        $this->assertEquals('1', $rd->getOperation());
    }

    public function testBuilder()
    {
        $builder = new BillRequestDataBuilder();
        $builder
            ->setDate('dt')
            ->setSum(100)
            ->setFiscalNumber('111')
            ->setFiscalDocument('111222')
            ->setFiscalSign('111222333')
            ->setOperation('1');

        $rd = $builder->create();
        $this->assertEquals('dt', $rd->getDate());
        $this->assertEquals(100, $rd->getSum());
        $this->assertEquals('111', $rd->getFiscalNumber());
        $this->assertEquals('111222', $rd->getFiscalDocument());
        $this->assertEquals('111222333', $rd->getFiscalSign());
        $this->assertEquals('1', $rd->getOperation());
    }

    public function testCopyBuilder()
    {
        $rd = new BillRequestData(
            'dt', 100, 111, 111222, 111222333, 1
        );
        $builder = BillRequestDataBuilder::fromRequestData($rd);

        $rd = $builder->create();
        $this->assertEquals('dt', $rd->getDate());
        $this->assertEquals(100, $rd->getSum());
        $this->assertEquals('111', $rd->getFiscalNumber());
        $this->assertEquals('111222', $rd->getFiscalDocument());
        $this->assertEquals('111222333', $rd->getFiscalSign());
        $this->assertEquals('1', $rd->getOperation());
    }

    public function testQrBuilder()
    {
        $builder = BillRequestDataBuilder::fromQr('t=dt&s=1.00&fn=111&i=111222&fp=111222333&n=1');

        $rd = $builder->create();
        $this->assertEquals('dt', $rd->getDate());
        $this->assertEquals(100, $rd->getSum());
        $this->assertEquals('111', $rd->getFiscalNumber());
        $this->assertEquals('111222', $rd->getFiscalDocument());
        $this->assertEquals('111222333', $rd->getFiscalSign());
        $this->assertEquals('1', $rd->getOperation());
    }
}
