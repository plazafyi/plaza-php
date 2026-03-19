<?php

namespace Plaza\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Unprocessable Entity Exception';
}
