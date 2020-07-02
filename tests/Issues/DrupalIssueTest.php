<?php

namespace GraphAware\Neo4j\Client\Tests\Issues;

use GraphAware\Bolt\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Class DrupalIssueTest
 * @package GraphAware\Neo4j\Client\Tests
 *
 * @group drupal
 */
class DrupalIssueTest extends TestCase
{
    public function testDrupalConversion()
    {
        $this->addConnection('bolt://neo4j:sfadfewfn;kewvljnfd@ssl+graphene.com', null);
        self::assertTrue(true);
    }

    private function addConnection($uri, $config)
    {
        if (substr($uri, 0, 7) === 'bolt://') {
            $parts = explode('bolt://', $uri );
            if (count($parts) === 2) {
                $splits = explode('@', $parts[1]);
                $split = $splits[count($splits)-1];
                if (substr($split, 0, 4) === 'ssl+') {
                    $up = count($splits) > 1 ? $splits[0] : '';
                    $ups = explode(':', $up);
                    $u = $ups[0];
                    $p = $ups[1];
                    $uri = 'bolt://'.str_replace('ssl+', '', $split);
                    $config = Configuration::newInstance()
                        ->withCredentials($u, $p)
                        ->withTLSMode(Configuration::TLSMODE_REQUIRED);
                }
            }
        }
    }
}
