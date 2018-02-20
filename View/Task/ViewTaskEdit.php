<?php

class ViewTaskEdit extends CoreView
{
    protected $helpers = ['Sessions', 'Forms'];
    
    //elements for html form
    protected $elements  = [
            'header'     => 'Edit Task',
            'submitBtn'  => 'Edit',
            'backBtn'    => 'task/index'
    ];

    public function render()
    {
        $html = '';
        $html .= $this->Forms->startForm($this->elements);
        foreach($this->structure['taskAdd'] as $field){
            $html .= $this->renderInputField($field);
        }
        $html .= $this->Forms->submitBtn($this->elements);
        $html .= $this->Forms->endForm();
        echo $html;
    }

    private function renderInputField($field)
    {
        $renderedField = '';
        $data = $this->Forms->getFieldData($field['name']);
        $renderedField .= $this->Forms->renderInput($field, $data);
        return $renderedField;
    }
}
