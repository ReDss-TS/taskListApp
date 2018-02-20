<?php

    function getMenuItems($items)
    {
        $menuItems = '';
        $menuItems .= '<ul class="nav navbar-nav">';
        foreach ($items as $key => $value) {
            if (isset($_SESSION['login']) && $value['action'] == 'login') {
               $menuItems .= ''; 
            } elseif (!isset($_SESSION['login']) && $value['action'] == 'logout') {
               $menuItems .= ''; 
            } elseif (isset($_SESSION['login']) && $value['action'] == 'logout') {
               $menuItems .= "<li><a href='/" . $value['controller'] . "/" . $value['action'] . "'><span>(".$_SESSION['login'].") $key</span></a></li>"; 
            } else {
                $menuItems .= "<li><a href='/" . $value['controller'] . "/" . $value['action'] . "'><span>$key</span></a></li>";
            }
        }
        $menuItems .= '</ul>';
        return $menuItems;
    }
