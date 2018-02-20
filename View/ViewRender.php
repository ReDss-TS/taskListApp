<?php

class ViewRender
{
    /**
     * generate all html code
     * @param string $view With a name class with render form in view folder
     * @param string $data With a data for render form such as input data, validated data
     */
    function __construct($view, $data) {
        $data = $this->sanitizeSpecialChars($data);
        ob_start();
        include "View/ViewStructure.php";
    }

    protected function sanitizeSpecialChars($data)
    {
        $filteredResult = [];
        $keys = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $result = $this->sanitizeSpecialChars($value); 
                    $filteredResult[$key] = $result;
                } else {
                    $filteredResult[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (is_bool($value)) {
                        $filteredResult[$key] = $value;
                    }
                }
            }
            return $filteredResult;
        }
    }
}
