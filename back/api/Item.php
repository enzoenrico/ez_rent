<?php 
class Item{
    public int $id;
    public string $name;
    public float $value;
    public bool $available;
    public string $group;
    public string $description;

    public function __construct($id, $name, $value, $available, $group, $description){
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->available = $available;
        $this->group = $group;
        $this->description = $description;
    }
}


?>