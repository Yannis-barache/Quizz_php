<?php


class InputSubmit extends Input
{
    public function __construct(string $name, string $id, string $value, string $label)
    {
        parent::__construct($name, $id, '', $value, $label);
    }

    public function render(): string
    {
        return "<input type='submit' name='$this->name' id='$this->id' placeholder='$this->placeholder' value='$this->value'>";
    }
}

?>
