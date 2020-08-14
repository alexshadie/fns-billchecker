<?php

namespace alexshadie\fns;

use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    public function testCreate()
    {
        $v = new Version('1.1.1', 'aaabbbccc');
        $this->assertEquals('1.1.1', $v->getVersion());
        $this->assertEquals('aaabbbccc', $v->getRevision());
    }
}
