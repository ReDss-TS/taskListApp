<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My test task</title>

        <!-- Bootstrap -->
        <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="/bootstrap/css/main.css" rel="stylesheet">

        <script type="text/javascript">
            function insertData() {
                var user_name=$("#user_name").val();
                var user_email=$("#user_email").val();
                var todo_Text=$("#todo_Text").val();
                var todo_img=$("#todo_img").val();  
                // AJAX code to send data to php file.
                $.ajax({
                    url: '/previewData.php',
                    type: 'POST',
                    dataType: 'html',
                    data: { user_name:user_name,
                            user_email:user_email,
                            todo_Text:todo_Text,
                            todo_img:todo_img},
                    success: function(data) {
                        $("#preview").html(data);
                        //$("p").addClass("alert alert-success");
                    },
                    error: function(err) {  
                        alert(err);
                    }
                });
            }
        </script>


    </head>
    <body>
        <div class="container">
        <?php
            include "View/ViewHeader.php";
            include "View/ViewContent.php";
            include "View/ViewFooter.php";

