<?php

namespace Plaza\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Plaza Permission Denied Exception';
}
