<?php

namespace Plaza\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Bad Request Exception';
}
