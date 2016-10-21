<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rivulet</title>
        <link rel="stylesheet" href="/public/css/styles.css">
        <script src="/public/js/angular.min.js"></script>
        <script src="/public/js/angular-route.min.js"></script>
        <script src="/public/js/rivulet_app.js"></script>
        <script src="/public/js/home_controller.js"></script>
    </head>
    <body>
        <div ng-app="rivuletApp">
            <div class="left_menu">
                <ul>
                    <li><a href="#/">Welcome <?php echo $username; ?></a></li>
                    <li><a href="#category">Categories</a></li>
                    <li><a href="#transaction">Transactions</a></li>
                    <li><a href="/User/signOut">Sign out</a></li>
                </ul>
            </div>
            <div ng-view style="float: left">right
            </div>
        </div>
    </body>
</html>
