PhpSpecExtension
================

Extension to help you speccing your domain objects.

Includes a matcher and token for value objects, which will make it possible to compare objects by their values and not internal identities within tests.

To install it, use Composer:

```
$ composer require --dev ormin/phpspec-ddd-project-extension:dev-master
```

Then in a `phpspec.yml` file of your project, add the following:

```yaml
extensions:
    - Ormin\DDDProjectExtension\DDDProjectExtension
```

You can use the matcher like this ( in example I used an imagined UserId object, but you might use whatever Value Object you want ):


```

function it_will_return_the_correct_user_id() {

    $userId = new UserId(682);

    // $domainObject->returnMeSomeCoolUserId() will return a UserId value object, which we want to match against the above. ReturnValue will fail due to non-matching identity.
    $domainObject->returnMeSomeCoolUserId()->shouldReturnValue($userId);


}

```

You can use the token like this:


```

function it_will_call_funny_method() {

    $userId = new UserId(682);

    $domainObject->doSeriousStuff(new ExactValueObjectToken($userId))->shouldBeCalled();

    // $domainObject->doSomeFunnyStuff() should call doSeriousStuff(UserId $userId) with an UserId value object which is created inside the method, which we want to match against the above value object. Normal ExactValueToken will fail due to non-matching identity.
    $domainObject->doSomeFunnyStuff();


}

```

Warning: Do not abuse it for objects which are not explicitly value objects and are compared by identity! Every time you do it, a kitten dies, so please spare the kittens and write clean code :)

