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
        <link rel="stylesheet" href="/public/css/angular_material/1.1.0/angular-material.min.css">
    </head>
    <body>
        <div ng-app="rivuletApp" layout="row" style="height: 100%;" ng-cloak>
            <md-sidenav class="md-sidenav-left" md-component-id="left" md-is-locked-open="$mdMedia('gt-sm')" md-whiteframe="4" style="width: 270px;">
                <md-toolbar style="min-height: 50px; height: 50px;">
                    <h4 class="md-toobar-tools text-center" style="margin-top: 15px; min-height: 50px; height: 50px;">Hi <?php echo ucfirst($username); ?></h4>
                </md-toolbar>
                <md-content flex role="navigation">
                    <ul class="left-menu-ul">
                        <li><a href="#/" ng-click="openLeftMenu()">&nbsp;&nbsp;Welcome <?php echo ucfirst($username); ?></a></li>
                        <li><a href="#category" ng-click="openLeftMenu()">&nbsp;&nbsp;Categories</a></li>
                        <li><a href="#transaction" ng-click="openLeftMenu()">&nbsp;&nbsp;Transactions</a></li>
                        <li><a href="#budget" ng-click="openLeftMenu()">&nbsp;&nbsp;Budget</a></li>
                        <li><a href="#fixedexpenditure" ng-click="openLeftMenu()">&nbsp;&nbsp;Fixed Expenditure</a></li>
                        <li><a href="http://rivulet/User/signOut" ng-click="openLeftMenu()">&nbsp;&nbsp;Sign out</a></li>
                    </ul>
                </md-content>
            </md-sidenav>
            <div flex layout="column">
                <md-toolbar layout="row" style="min-height: 50px; height: 50px;">
                    <md-button class="md-accent hide-gt-sm" ng-click="openLeftMenu()">MENU</md-button>
                    <h4 class="md-toobar-tools" style="margin-top: 15px; margin-left: 10px; min-height: 50px; height: 50px;">
                        <?php echo ucfirst($username); ?>'s rivulet&nbsp;{{subTitle}}
                    </h4>
                </md-toolbar>
                <md-content flex layout-padding>
                    <div ng-view layout="column" layout-align="top"></div>
                </md-content>
            </div>
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
        <script src="/public/js/rivulet_service.js"></script>
        <script src="/public/js/home_controller.js"></script>
    </body>
</html>
