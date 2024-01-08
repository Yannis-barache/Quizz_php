<?php

include 'IRender.php';
class Form implements IRender
{
    protected array $inputs;

    public function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * @return array
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function addInput(Input $input): void
    {
        $this->inputs[] = $input;
    }


    public function render(): string
    {
        $html = "<form class='form-horizontal' role='form' method='get'>".PHP_EOL;
        foreach ($this->inputs as $input) {
            $html .= "<div class='form-group'>".PHP_EOL;
            $html .= "<label class='col-sm-2 control-label' for='{$input->getId()}'>{$input->getPlaceholder()}</label>".PHP_EOL;
            $html .= "</div>".PHP_EOL;
            $html .= "<div class='col-sm-10'>".PHP_EOL;
            $html .= $input->render();
            $html .= "</div>".PHP_EOL;


        }

        $html .= "</form>";
        return $html;

    }

}