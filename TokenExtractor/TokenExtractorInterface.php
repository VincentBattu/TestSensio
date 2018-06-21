<?php

namespace Drilliak\JWTBundle\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Provides method allowing to extract JWT
 *
 * @author Vincent BATTU
 */
interface TokenExtractorInterface
{

    /**
     * Extracts JWT from the given request
     *
     * @param Request $request the given request
     * @return null|string The JWT if it could be extracted, null otherwise.
     */
    public function extract(Request $request): ?string;
}
