<?php

namespace Plaza\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Internal Server Exception';
}
