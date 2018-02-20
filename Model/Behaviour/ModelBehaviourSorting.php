<?php

class ModelBehaviourSorting
{
    public function getSortBy($param)
    {
        if (!isset($param['by'])) {
            $sort = 'ASC';
        } else {
            if ($param['by'] == 'ASC' || $param['by'] == 'DESC') {
                $sort = $param['by'];
            } else {
                $sort = 'ASC';
            }
        }
        return $sort;
    }

    public function changeSortBy($param)//TODO
    {
        $sort = $this->getSortBy($param);
        if ($sort == "ASC") {
            $sort = "DESC";
        } else {
            $sort = "ASC";
        }
        return $sort;
    }
    
    public function getColumn($param, $columns)
    {
        if (!isset($param['column'])) {
            $column = $columns[0];
        } else {
            foreach ($columns as $key => $value) {
                if ($param['column'] == $value) {
                    $column = $param['column'];
                    break;
                } else {
                    $column = $param['column'];
                }
            }
        }
        return $column;
    }   
}
