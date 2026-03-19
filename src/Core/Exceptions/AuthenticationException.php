<?php

namespace Plaza\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Authentication Exception';
}
