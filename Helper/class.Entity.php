<?php


namespace ILoveMarusia\Common\Helper;


class Entity
{
    protected $properties = array();

    public function __construct($properties = array())
    {
        foreach($properties as $key => $value)
        {
            $this -> __set($key , $value);
        }
    }
    /**
     * Сеттер
     * @param mixed $field
     * @param mixed $value
     */
    public function __set($field , $value)
    {
        $method = 'set'.ucfirst($field);

        if (method_exists($this , $method))
        {
            $this -> $method($value);
        }
        elseif (self::existsField($field))
        {
            $this -> properties[$field] = $value;
        }
    }

    public function __get($field)
    {
        $method = 'get'.ucfirst($field);

        if (method_exists($this , $method))
        {
            return $this -> $method();
        }

        if ($this -> existsField($field))
        {
            return $this -> properties[$field];
        }
        return null;
    }


    protected function existsField($field)
    {
        return array_key_exists($field,$this->properties);
    }
}