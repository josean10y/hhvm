<?php
class entity
{
    private $data;
    private $modified;

    function __get($name)
    {
        if ( isset($this->data[$name]) )
            return $this->data[$name];
        else {
            $this->data = array();
            return $this->data[$name] = new set($this);
        }
    }

    function __set($name, $value)
    {
        if ($this->modified === null) $this->modified = array();
        $this->modified[$name] = $value;
    }
}

class set implements ArrayAccess
{
    private $entity;

    function __construct($entity)
    {
        $this->entity = $entity;
        $this->entity->whatever = $this;
    }

    function clear() {
        $this->entity->whatever = null;
    }

    function offsetUnset($offset)
    {
        $this->clear();
//            $this->entity->{$this->name} = null;
    }

    function offsetSet($offset, $value)
    {
    }

    function offsetGet($offset)
    {
        return 'Bogus ';
    }

    function offsetExists($offset)
    {
    }
}
<<__EntryPoint>> function main() {
$entity = new entity();
echo($entity->whatever[0]);

//This will crash
//    $entity->whatever->clear();
unset($entity->whatever[0]);

//This will not crash (comment previous & uncomment this to test
//    $test = $entity->whatever; unset($test[0]);

echo($entity->whatever[0]);
echo "ok\n";
}
