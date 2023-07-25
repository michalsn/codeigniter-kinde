<?php

namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;
use Michalsn\CodeIgniterKinde\Kinde;
use Michalsn\CodeIgniterKinde\Config\Kinde as KindeConfig;

/**
 * @internal
 */
final class KindeTest extends CIUnitTestCase
{
    protected Kinde $kinde;

    protected function setUp(): void
    {
        parent::setUp();

        $config = config(KindeConfig::class);
        $this->kinde = new Kinde($config);
    }

    public function testKinde()
    {
        $this->assertInstanceOf(Kinde::class, $this->kinde);
    }

    public function testIsAuthenticated()
    {
        $this->assertFalse($this->kinde->isAuthenticated());
    }
}
