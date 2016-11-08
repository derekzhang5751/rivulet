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
        <link rel="stylesheet" href="/public/css/angular_material/1.1.0/angular-material.min.css">
    </head>
    <body>
        <div ng-app="rivuletApp" ng-controller="userCtrl" class="login-div-center">
        <form name="loginForm" novalidate>
        <table>
            <tr>
                <td>User Name:</td>
                <td>
                    <md-input-container>
                        <label>Username</label>
                        <input type="text" ng-model="username" ng-init="username=''" required>
                    </md-input-container>
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <md-input-container>
                        <label>Password</label>
                        <input type="password" ng-model="password" ng-init="password=''" required>
                    </md-input-container>
                </td>
            </tr>
        </table>
            <md-button type="submit" ng-click="login()" ng-disabled="loginForm.$invalid" class="md-raised md-primary">LOGIN</md-button>
        </form>
        </div>
        <!-- Angular JS -->
        <script src="/public/js/angular-1.5.8/angular.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-route.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-animate.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-aria.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-messages.min.js"></script>
        <!-- Angular Material -->
        <script src="/public/js/angular_material/1.1.0/angular-material.min.js"></script>
        <script src="/public/js/rivulet_app.js"></script>
        <script src="/public/js/user_controller.js"></script>
    </body>
</html>
