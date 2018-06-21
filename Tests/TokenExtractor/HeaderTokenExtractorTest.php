<?php

namespace Drilliak\JWTBundle\Tests\TokenExtractor;

use Drilliak\JWTBundle\TokenExtractor\HeaderTokenExtractor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class HeaderTokenExtractorTest extends TestCase
{

    public function testWithoutHeader()
    {
        $extractor = new HeaderTokenExtractor('Authorization', 'Bearer');
        $request = new Request();

        $this->assertNull($extractor->extract($request));
    }

    public function testWithBadHeader()
    {
        $extractor = new HeaderTokenExtractor('Authorization', 'Bearer');
        $request = new Request();
        $request->headers->set('AUTH', 'Bearer azeazeaze');

        $this->assertNull($extractor->extract($request));
    }

    public function testWithEmptyPrefix()
    {
        $extractor = new HeaderTokenExtractor('Authorization', '');
        $request = new Request();
        $request->headers->set('Authorization', 'azeazeaze');

        $this->assertEquals('azeazeaze', $extractor->extract($request));
    }

    public function testWithoutSpaceBetweenPrefixAndToken()
    {
        $extractor = new HeaderTokenExtractor('Authorization', 'Bearer');
        $request = new Request();
        $request->headers->set('Authorization', 'Bearerazeazeaze');

        $this->assertNull($extractor->extract($request));
    }

    public function testPrefixCaseInsensitive()
    {
        $extractor = new HeaderTokenExtractor('Authorization', 'Bearer');
        $request = new Request();
        $request->headers->set('Authorization', 'BEARER azeazeaze');

        $this->assertEquals('azeazeaze', $extractor->extract($request));
    }

    public function testGoodExtract()
    {
        $extractor = new HeaderTokenExtractor('Authorization', 'Bearer');
        $request = new Request();
        $request->headers->set('Authorization', 'Bearer azeazeaze');

        $this->assertEquals('azeazeaze', $extractor->extract($request));
    }
}
