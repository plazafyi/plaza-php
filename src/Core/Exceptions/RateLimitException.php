<?php

namespace Plaza\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Rate Limit Exception';
}
