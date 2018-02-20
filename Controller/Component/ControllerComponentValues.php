<?php

class ControllerComponentValues
{

    public function isDone($result)
    {
        $amount = 0;
        foreach ($result as $key => $value) {
            if (!empty($value)) {
                $amount++;
            }
        }
        if ($amount == count($result)) {
            return true;
        }
        return false;
    }
}
