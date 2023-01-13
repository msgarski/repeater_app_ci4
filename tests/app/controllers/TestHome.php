<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

class TestHome extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIndex()
    {
        // Get a simple page
        $result = $this->call('get', '/');

        $result->assertOK();
    }
}