<?php

namespace Ormin\DDDProjectExtension;

use Prophecy\Argument\Token\TokenInterface;
use Prophecy\Util\StringUtil;

class ExactValueObjectToken implements TokenInterface
{

    /**
     * @var object
     */
    private $value;

    /**
     * @var StringUtil
     */
    private $util;

    /**
     * @var string
     */
    private $string;

    public function __construct($value, StringUtil $util = null)
    {
        $this->value = $value;
        $this->util = $util ?: new StringUtil();
    }

    /**
     * Calculates token match score for provided argument.
     *
     * @param $argument
     *
     * @return bool|int
     */
    public function scoreArgument($argument)
    {
        return ($this->value == $argument) ? 10 : false;
    }

    /**
     * Returns true if this token prevents check of other tokens (is last one).
     *
     * @return bool|int
     */
    public function isLast()
    {
        return false;
    }

    /**
     * Returns string representation for token.
     *
     * @return string
     */
    public function __toString()
    {

        if (null === $this->string) {
            $this->string = sprintf('exactvalueobject(%s)', $this->util->stringify($this->value));
        }

        return $this->string;
    }

}