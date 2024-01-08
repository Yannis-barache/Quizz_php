<?php

class InputCheckbox extends Input
{

    public function __construct(string $name, string $id, string $value)
    {
        parent::__construct($name, $id, "checkbox", $value);
    }

    public function render(): string
    {
        $html = "<input type='checkbox' name='{$this->getName()}' id='{$this->getId()}' placeholder='{$this->getPlaceholder()}' value='{$this->getValue()}'>".PHP_EOL;
        return $html;
    }
}
?>