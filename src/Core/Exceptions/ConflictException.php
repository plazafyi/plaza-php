<?php

namespace Plaza\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Conflict Exception';
}
