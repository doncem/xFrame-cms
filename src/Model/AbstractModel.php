<?php

namespace XframeCMS\Model;

use JsonSerializable;

/**
 * Converting parameters to array.
 *
 * @MappedSuperclass
 */
abstract class AbstractModel implements JsonSerializable
{
    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Map class variables into an array.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $vars = \array_keys(\get_object_vars($this));
        $array = [];

        foreach ($vars as $var) {
            // we can't serialize closures. also disabling system vars
            if (!($this->$var instanceof \Closure) && '_' !== \mb_substr($var, 0, 1)) {
                // override ID variable
                $array[('id' === $var ? '_' : '') . $var] = $this->$var;
            }
        }

        return $array;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getMethodName(string $name)
    {
        $name_parts = \explode('_', $name);
        $tmp = \implode(' ', $name_parts);

        return \str_replace(' ', '', \ucwords($tmp));
    }

    /**
     * Magical getter.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $method = 'get' . $this->getMethodName($name);

        if (\method_exists($this, $method)) {
            return $this->{$method}();
        }

        return $this->{$name};
    }

    /**
     * Magical setter.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        $method = 'set' . $this->getMethodName($name);

        if (\method_exists($this, $method)) {
            $this->{$method}($value);
        } else {
            $this->{$name} = $value;
        }
    }
}
