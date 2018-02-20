<?php

$data['user_name']  = $_POST['user_name'];
$data['user_email'] = $_POST['user_email'];
$data['todo_Text']  = $_POST['todo_Text'];
$data['todo_img']   = $_POST['todo_img'];

$html = '';
$html .= renderDataForm($data);

echo $html;

function renderDataForm($data)
{
    $form = "
        <div class='col-md-4 col-md-offset-4'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    " . getPanelHeading($data) . "
                </div>
                <div class='panel-body'>
                    " . getPanelBody($data) . "
                </div>
                <div class= 'panel-footer'>
                    " . getPanelFooter($data) . "
                </div>
            </div>
        </div>
             ";
    return $form;
}

function getPanelHeading($data)//TODO NO
{
    $html = "<div class='row'>
                <div class='col-xs-10'>
                    <h4>Task by " . $data['user_name'] . " <br> Email: " . $data['user_email'] . "</h3>
                </div>
            </div>";
    return $html;
}

function getPanelBody($data)
{
    $html = "<div class= ''>
                <img src='/img/" . $data['todo_img'] . "' class='img-responsive' alt='' width='320' height='240'>
            </div>";
    return $html;
}

function getPanelFooter($data)
{
    $html = "<form class='form-horizontal' role='form' enctype='multipart/form-data' method='POST' action=''>
                <div class = 'text'>
                    " . $data['todo_Text'] . "
                </div>
            </form>";
    return $html;
}

