<?php

namespace Chaos\Common\Support\Object;

/**
 * Class Collection
 * @author ntd1712
 */
abstract class Collection extends \ArrayObject implements Contract\ICollection
{
    use Contract\CollectionAware, Contract\ObjectAware;
}