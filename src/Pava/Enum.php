<?php

namespace Pava;

/**
 * Enum with public static methods instead of constants.
 * 
 * Requires that Pava\register(MyClass::class) is appended to the MyClass definition.
 * 
 * 
 * 
 */
abstract class Enum
{
    private $__enum;

    /**
     * Returns true if the specified object is equal to this enum constant.
     */
    public final function equals(Enum $other): bool
    {
        return $this->__enum == $other->name();
    }

    /**
     * Returns the name of this enum constant, exactly as declared in its enum declaration.
     */
    public final function name(): string
    {
        return $this->__enum;
    }

    /**
     * Returns the enum instance if exists.
     * 
     * @param string $name
     * @return \Pava\Enum
     * @throws \InvalidArgumentException
     */
    public static function valueOf(string $name) : Enum
    {
        if(isset(static::$$name))
            return static::$$name;
        
        throw new \InvalidArgumentException("Not existing $name");
    }

    /**
     * Called after initialisation of the enum value.
     * 
     * Implement it to apply custom behaviour.
     */
    //public function __invoke(){}
}

function register(string $class)
{
    $refl = new \ReflectionClass($class);
    if (!$refl->isSubclassOf(Enum::class))
        throw new \LogicException($class . ' is not an Enum');
    
    $props = $refl->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_STATIC);
    foreach ($props as $prop) {
        /* @ var $prop \ReflectionProperty */
        $name = $prop->getName();
        $class::$$name = new $class();
        
        $prop = $refl->getParentClass()->getProperty('__enum');
        $prop->setAccessible(true);
        $prop->setValue($class::$$name, $name);
        
        if ($refl->hasMethod('__invoke'))
            $class::${$name}->__invoke();
    }
}
