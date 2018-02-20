<?php

abstract class CoreController
{
    protected $fieldsStructure;

    function __construct()
    {
        $this->fieldsStructure = include('Config/structureInputFields.php');

        foreach ($this->models as $key => $property) {
            $this->{$property} = new $property;
        }

        foreach ($this->components as $key => $property) {
            $class = 'ControllerComponent' . $property;
            $this->{$property} = new $class;
        }
    }

    /**
     * Check user authentication for authorization and access rights
     * @param array $action With action name
     * @param array $params With parameters
     */
    public function beforeCallAction($action, $params)
    {
        foreach ($this->actionsRequireLogin as $key => $value) {
            if ('action' . $value === $action) {
                if ($this->Auth->isAuth() !== true) {
                    header("Location: /user/login");
                    exit();
                }
            }
        }
    }

    /**
     * get data from fields input by method POST
     * @param array $labels form input names
     * @return array
     */
    public function getInputValues($labels)
    {

        $inputValues = [];
        foreach ($labels as $key => $value) {
            $pos = stripos($value['name'], '_img');
            if ($pos !== false) {
                $inputValues[$value['name']] = $_FILES[$value['name']];
            } else {
                if (isset($_POST[$value['name']])) {
                    $inputValues[$value['name']] = $_POST[$value['name']];
                } else {
                    $inputValues[$value['name']] = '';
                }
            }
        }
        return $inputValues;
    }
}
