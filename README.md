# PHP Enums

Yet another implementation of Enums in PHP. The difference to most other implementations is that the
implemetation is very close to Java. Static properties are used, but like in Java they are real
instances of the Enum providing all methods etc:

```php

class Fruit extends \Pava\Enum
{
    /**
     * @var Fruit
     */
    public static $APPLE;

    /**
     * @var Fruit
     */
    public static $BANANA;
}

```

## So you can use static typing:

```php

$mix = function (Fruit $a, Fruit $b) {};

$blend = $mix(Fruit::$APPLE, Fruit::$BANANA);

$grow = function () : Fruit { return Fruit::$APPLE };

assert(Fruit::$APPLE instanceof Fruit);

```

## What are the drawbacks?

* Each enum has to be registered (unless static constructors arrive in PHP). The reason is that static properties can only have scalar values as default.

```php

//class Fruit ...

Pava\register(Fruit::class);
```

* You need to annotate all static props in order to get your IDE working with it, but at least this works.
* No default values usable. At "compile time" $BANANA is not yet an instance. However you can use null as default value.

```php

//not possible
$a = function (Fruit $a = Fruit::$BANANA) {};

```

* Use/import is not possible, i.e. you cannot just write $BANANA.

## Advanced use

Each enum instance can obtain its own properties by implementing the magic invoke method.

```php

class Fruit extends \Pava\Enum
{
    private $color;

    /**
     * @var Fruit
     */
    public static $APPLE;

    /**
     * @var Fruit
     */
    public static $BANANA;

    public function color() : string
    {
        return $this->color;
    }

    public function __invoke()
    {
        if ($this->name() == 'BANANA')
            $this->color = 'yellow';
        if ($this->name() == 'APPLE')
            $this->color = 'green';
    }
}
Pava\register(Fruit::class);

echo 'The apple is ' . Fruit::$APPLE->color();
```
