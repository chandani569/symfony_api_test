<?php
namespace App\Controller;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedisTestController extends AbstractController
{
    #[Route('/test-redis', name: 'test_redis')]
    public function index(CacheItemPoolInterface $cache): Response
    {
        $cacheItem = $cache->getItem('my_test_key');
        if (!$cacheItem->isHit()) {
            $cacheItem->set('Hello from Redis!');
            $cache->save($cacheItem);
        }
        return new Response($cacheItem->get());
    }
}