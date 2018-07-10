<?php

abstract class Enum
{
    const __default = NULL;

    private $__value;

    public final function __construct($value = null)
    {
        if (is_null($value)) {
            $this->__value = $this->getConstantName(static::__default);
        } else {
            $this->__value = $this->getConstantName($value);
        }
    }

    private function getConstantName($value)
    {

        $class = new ReflectionClass(get_called_class());
        $constants = $class->getConstants();

        $constName = null;

        foreach ($constants as $name => $val) {
            if ($val == $value && $name != '__default') {
                $constName = $name;
                break;
            }
        }

        if (is_null($constName)) {
            throw new UnexpectedValueException("Undefined Constant Value");
        }
        return $constName;

    }

    public final function __toString()
    {
        if (is_null($this->__value)) {
            return "";
        }
        return $this->__value;
    }
}


class Month extends Enum
{
    const __default = self::January;

    const January = 1;
    const February = 2;
    const March = 3;
    const April = 4;
    const May = 5;
    const June = 6;
    const July = 7;
    const August = 8;
    const September = 9;
    const October = 10;
    const November = 11;
    const December = 12;
}

echo new Month(Month::June) . PHP_EOL;

try {
    $a = new Month();
    echo $a;
} catch (UnexpectedValueException $uve) {
    echo $uve->getMessage() . PHP_EOL;
}

?>