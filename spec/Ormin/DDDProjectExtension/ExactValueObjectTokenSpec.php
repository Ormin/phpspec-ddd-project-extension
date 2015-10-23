<?php

namespace spec\Ormin\DDDProjectExtension;

use PhpSpec\Formatter\Presenter\PresenterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExactValueObjectTokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(123);
        $this->shouldHaveType('Ormin\DDDProjectExtension\ExactValueObjectToken');
    }

    function it_will_score_the_primitives() {
        $this->beConstructedWith(123);
        $this->scoreArgument(123)->shouldReturn(10);
    }

    function it_will_score_same_classes_with_same_attributes() {
        $object = new \stdClass();
        $object->attr1 = 1;
        $object->attr2 = 3;

        $sameObject = new \stdClass();
        $sameObject->attr1 = 1;
        $sameObject->attr2 = 3;


        $this->beConstructedWith($object);
        $this->scoreArgument($sameObject)->shouldReturn(10);
    }

    function it_wont_score_same_classes_with_different_attributes() {
        $object = new \stdClass();
        $object->attr1 = 1;
        $object->attr2 = 3;

        $sameObject = new \stdClass();
        $sameObject->attr1 = 1;
        $sameObject->attr2 = 5;


        $this->beConstructedWith($object);
        $this->scoreArgument($sameObject)->shouldReturn(false);
    }

}
