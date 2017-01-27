<?php

require_once 'things.php';

/**
 * Description of EnumTest
 *
 * 
 */
class EnumTest extends PHPUnit_Framework_TestCase
{
    public function testIsInstance()
    {
        $this->assertInstanceOf(Pava\Enum::class, Fruit::$BANANA);
        $this->assertInstanceOf(Fruit::class, Fruit::$BANANA);
        $this->assertInstanceOf(Pava\Enum::class, Fruit::$CHERRY);
        $this->assertInstanceOf(Fruit::class, Fruit::$CHERRY);
        $this->assertInstanceOf(Pava\Enum::class, Fruit::$STRAWBERRY);
        $this->assertInstanceOf(Fruit::class, Fruit::$STRAWBERRY);
        
        assert(Fruit::$BANANA instanceof Fruit);
    }
    
    public function testUnregistered()
    {
        $this->assertNull(Animal::$CAT);
        $this->assertNull(Animal::$DOG);
    }
    
    /**
     * @depends testUnregistered
     */
    public function testRegistered()
    {
        Pava\register(Animal::class);
        $this->assertInstanceOf(Pava\Enum::class, Animal::$CAT);
        $this->assertInstanceOf(Animal::class, Animal::$CAT);
    }
    
    public function testInvokeIsCalled()
    {
        $this->assertEquals('#000000', Color::$BLACK->getHexcode());
        $this->assertEquals('#ffffff', Color::$WHITE->getHexcode());
    }
    
    public function testValueOf()
    {
        $this->assertTrue(Fruit::$BANANA->equals(Fruit::valueOf("BANANA")));
    }
    
    public function testEquals()
    {
        $this->assertTrue(Fruit::$BANANA->equals(Fruit::$BANANA));
    }
    
    public function testNotEquals()
    {
        $this->assertFalse(Fruit::$BANANA->equals(Fruit::$CHERRY));
    }
    
    public function testName()
    {
        $this->assertEquals('BANANA', Fruit::$BANANA->name());
    }
}

