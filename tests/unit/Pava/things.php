<?php

/*
 * Test enums
 *
 * 
 */

class Fruit extends Pava\Enum
{
    /**
     * @var Fruit
     */
    public static $BANANA;
    
    /**
     * @var Fruit
     */
    public static $STRAWBERRY;
    
     /**
     * @var Fruit
     */
    public static $CHERRY;
}
Pava\register(Fruit::class);

/**
 * Unregistered.
 */
class Animal extends Pava\Enum
{
    /**
     * @var Animal
     */
    public static $CAT;
    
    /**
     * @var Animal
     */
    public static $DOG;
}

class Color extends Pava\Enum
{
    /**
     * @var Color
     */
    public static $WHITE;
    
    /**
     * @var Color
     */
    public static $BLACK;
    
    /**
     * @var string
     */
    private $hexCode;

    public function __invoke()
    {
        if ($this->name() == 'WHITE')
            $this->hexCode = '#ffffff';
        if ($this->name() == 'BLACK')
            $this->hexCode = '#000000';
    }
    
    public function getHexCode() : string
    {
        return $this->hexCode;
    }
}
Pava\register(Color::class);