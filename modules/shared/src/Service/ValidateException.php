<?php

namespace Chaos\Common\Service;

/**
 * Class ValidateException
 * @author ntd1712
 */
class ValidateException extends \RuntimeException
{
    /**
     * @var mixed|int
     */
    protected $code = 418;
}