<?php


require_once 'IRender.php';

abstract class Input implements IRender
{
    protected string $value;
    protected string $placeholder;
    protected string $id;
    protected string $name;
    protected string $label;

    public function __construct(string $name, string $id, string $placeholder, string $value, string $label)
    {
        $this->name = $name;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->label = $label;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }

    public function getName(): string
    {
        return $this->name;
    }





}