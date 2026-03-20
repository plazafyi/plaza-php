<?php

namespace Plaza\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Not Found Exception';
}
