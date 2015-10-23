<?php

namespace Ormin\DDDProjectExtension;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Exception\Example\NotEqualException;
use PhpSpec\Formatter\Presenter\PresenterInterface;
use PhpSpec\Matcher\BasicMatcher;

class ValueMatcher extends BasicMatcher
{
    /**
     * @var array
     */
    private static $keywords = array(
        'returnValue'
    );
    /**
     * @var \PhpSpec\Formatter\Presenter\PresenterInterface
     */
    private $presenter;

    /**
     * @param PresenterInterface $presenter
     */
    public function __construct(PresenterInterface $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return bool
     */
    public function supports($name, $subject, array $arguments)
    {
        return in_array($name, self::$keywords)
        && 1 == count($arguments)
            ;
    }

    /**
     * @param mixed $subject
     * @param array $arguments
     *
     * @return bool
     */
    protected function matches($subject, array $arguments)
    {
        return $subject == $arguments[0];
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return NotEqualException
     */
    protected function getFailureException($name, $subject, array $arguments)
    {
        return new NotEqualException(sprintf(
            'Expected ( value ) %s, but got %s.',
            $this->presenter->presentValue($arguments[0]),
            $this->presenter->presentValue($subject)
        ), $arguments[0], $subject);
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return FailureException
     */
    protected function getNegativeFailureException($name, $subject, array $arguments)
    {
        return new FailureException(sprintf(
            'Did not expect ( value ) %s, but got one.',
            $this->presenter->presentValue($subject)
        ));
    }
}
