<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link rel="stylesheet" href="/public/css/angular_material/1.1.0/angular-material.min.css">
        <link rel="stylesheet" href="/public/css/styles.css">
    </head>
    <body>
        <div class="frame-div login-div-center" ng-app="rivuletApp" ng-controller="userCtrl">
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
            <div style="text-align: center;">
            <md-button type="submit" ng-click="login()" ng-disabled="loginForm.$invalid" class="md-raised md-primary">LOGIN</md-button>
            </div>
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
