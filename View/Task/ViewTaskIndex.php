<?php

class ViewTaskIndex extends CoreView
{
    protected $helpers = ['Sessions', 'Forms', 'Pagination'];

    protected $sortingTag = '&#8593;';
    
    //elements for html form
    protected $elements  = [
            'header'     => 'New Task',
            'submitBtn'  => 'Add',
            'backBtn'    => 'task/index'
    ];

    public function render($data)
    {
        $html = '';
        $html .= '<div class = "page-head">
                    <div class="row justify-content-center">
                        <h2>TASK LIST</h2>
                    </div>
                    <div class="row justify-content-center">
                        <strong>Sort by:</strong>&nbsp;
                        ' . $this->getSortButtons($data) . '
                    </div>
                </div>
                <hr class="style2">
                <div class="row">';
        $html .= $this->renderTasks($data['tasks']);
        $html .= '</div>';
        $html .= '<hr class="style2">';    
        $html .= '<div class="row justify-content-center">';
        $html .= $this->Pagination->getPagination($data);
        $html .= '</div>';       
        echo $html;
    }

    private function renderTasks($data)
    {   
        $renderedData = '';
        foreach ($data as $key => $value) {
            $renderedData .= $this->Forms->renderDataForm($value);
        }
        return $renderedData;
    }

    private function getSortButtons($data)
    {
        $sortColumns = include('Config/sortColumns.php');
        $uri = $data['uri'];
        $page = $data['pagination']['page'];
        $column = $data['sorting']['column'];
        $sort = $data['sorting']['sort'];

        $renderedButtons = '';
        foreach ($sortColumns as $key => $value) {
            $this->sortingTag = ($key == $column && $sort == 'ASC') ? '&#8593;' : (($key == $column && $sort == 'DESC') ? '&#8595;' : '');
            $renderedButtons .= "<a href='/$uri/page:$page/column:$key/by:$sort/' class = 'btn btn-default btn-xs'>$value $this->sortingTag</a>&nbsp;|&nbsp";
        }
        return $renderedButtons;
    }
}
