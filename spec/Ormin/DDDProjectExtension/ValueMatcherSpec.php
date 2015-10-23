<?php

namespace spec\Ormin\DDDProjectExtension;

use PhpSpec\Formatter\Presenter\PresenterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValueMatcherSpec extends ObjectBehavior
{
    function it_is_initializable(PresenterInterface $presenter)
    {
        $this->beConstructedWith($presenter);
        $this->shouldHaveType('Ormin\DDDProjectExtension\ValueMatcher');
    }

    function it_will_match_the_primitives(PresenterInterface $presenter) {
        $this->beConstructedWith($presenter);
        $this->positiveMatch("TestMatch",123,[123])->shouldReturn(123);
    }

    function it_will_score_same_classes_with_same_attributes(PresenterInterface $presenter) {
        $this->beConstructedWith($presenter);
        $object = new \stdClass();
        $object->attr1 = 1;
        $object->attr2 = 3;

        $sameObject = new \stdClass();
        $sameObject->attr1 = 1;
        $sameObject->attr2 = 3;


        $this->positiveMatch("TestMatch", $object, [$sameObject])->shouldReturn($object);
    }

    function it_wont_score_same_classes_with_different_attributes(PresenterInterface $presenter) {
        $this->beConstructedWith($presenter);
        $object = new \stdClass();
        $object->attr1 = 1;
        $object->attr2 = 3;

        $differentObject = new \stdClass();
        $differentObject->attr1 = 1;
        $differentObject->attr2 = 5;


        $this->shouldThrow("\\PhpSpec\\Exception\\Example\\NotEqualException")->duringPositiveMatch("TestMatch", $object, [$differentObject]);
    }
}
