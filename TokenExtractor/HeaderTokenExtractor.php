<?php

namespace Drilliak\JWTBundle\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Extracts JWT from the request header.
 *
 * @author Vincent BATTU
 */
class HeaderTokenExtractor implements TokenExtractorInterface
{
    /**
     * @var string header name
     */
    private $name;

    /**
     * @var string header content prefix
     */
    private $prefix;

    public function __construct(string $name, string $prefix)
    {
        $this->name = $name;
        $this->prefix = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function extract(Request $request): ?string
    {
        if (!$request->headers->has($this->name)) {
            return null;
        }

        $header = $request->headers->get($this->name);

        if (empty($this->prefix)) {
            return $header;
        }

        $headerParts = explode(' ', $header);

        if (count($headerParts) !== 2 || strcasecmp($headerParts[0], $this->prefix) !== 0) {
            return null;
        }

        return $headerParts[1];
    }
}
