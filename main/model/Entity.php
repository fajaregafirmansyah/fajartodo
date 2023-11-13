<?php

namespace Model;

use stdClass;

abstract class Entity
{
    public Storage $storage;

    public function __construct()
    {
        $this->storage = new Storage();
    }

    public function load($id)
    {
       
    }

    public function save()
    {
        
    }

    public function delete($id)
    {
       
    }

    public function push(stdClass $param) : void
    {
       
        $property = get_object_vars($this);
        $mapping = get_object_vars($param);

        foreach ($property as $key => $value) {
            foreach ($mapping as $keyMap => $valueMap) {
                if ($key === $keyMap) {
                    if ($value instanceof Storage) {
                       
                    } else {
                        $this->{$key} = $valueMap;
                    }
                }
            }
        }

        unset($this->storage);
    }

    public function pull()
    {
        unset($this->storage);
        return get_object_vars($this);
    }
}