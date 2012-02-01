<?php

namespace Toad\Guzzle\Extensions;

use Guzzle\Common\Cache\AbstractCacheAdapter;
use Predis\Client as Cache;

class PredisCacheAdapter extends AbstractCacheAdapter
{
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function contains($id)
    {
        return $this->cache->exists($id);
    }

    public function delete($id)
    {
        return $this->cache->del($id);
    }

    public function fetch($id)
    {
        return $this->cache->get($id);
    }

    public function save($id, $data, $lifeTime = false)
    {
        if ($lifeTime != false) {
            return $this->cache->setex($id, $lifeTime, $data);
        } else {
            return $this->cache->set($id, $data);
        }
    }
}
