<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Login</title>
        <link rel="stylesheet" href="/public/css/styles.css">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
        <!-- Angular JS -->
        <script src="/public/js/angular-1.5.8/angular.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-route.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-animate.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-aria.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-messages.min.js"></script>
        <!-- Angular Material -->
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
        <script src="/public/js/rivulet_app.js"></script>
        <script src="/public/js/user_controller.js"></script>
    </head>
    <body>
        <div ng-app="rivuletApp" ng-controller="userCtrl">
        <form>
        <table>
            <tr>
                <td>User Name:</td>
                <td><input type="text" ng-model="username" ng-init="username=''" placeholder="Input your username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" ng-model="password" ng-init="password=''" placeholder="Input your password"></td>
            </tr>
        </table>
            <button type="button" id="btnlogin" name="btnlogin" ng-click="login()">LOGIN</button>
        </form>
        </div>
    </body>
</html>
