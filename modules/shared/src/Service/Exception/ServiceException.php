<?php

namespace Chaos\Common\Service\Exception;

/**
 * Class ServiceException
 * @author ntd1712
 */
class ServiceException extends \Exception
{
    /**
     * @var mixed|int
     */
    protected $code = 500;
}
