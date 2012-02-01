<?php

namespace Toad\Guzzle\Tests\Extensions;

use Toad\Guzzle\Extensions\PredisCacheAdapter;
use Predis\Client as PredisClient;

class PredisCacheAdapterTest extends \Guzzle\Tests\GuzzleTestCase
{

    /**
     * @var PredisClient
     */
    private $cache;

    /**
     * @var PredisCacheAdapter
     */
    private $adapter;

    protected function setUp()
    {
        parent::setUp();
        $this->cache = new PredisClient();
        $this->adapter = new PredisCacheAdapter($this->cache);
    }

    protected function tearDown()
    {
        $this->adapter = null;
        $this->cache = null;
        parent::tearDown();
    }

    public function testSave()
    {
        $this->assertTrue($this->adapter->save('id', 'data'));
    }

    public function testFetch()
    {
        $this->assertEquals('data', $this->adapter->fetch('id'));
    }

    public function testContains()
    {
        $this->assertTrue($this->adapter->contains('id'));
    }

    public function testDelete()
    {
        $this->assertEquals(1, $this->adapter->delete('id'));
    }
}
