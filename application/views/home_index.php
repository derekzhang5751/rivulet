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
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    </head>
    <body>
        <div ng-app="rivuletApp" layout="column" style="height: 100%;" ng-cloak>
            <section layout="row" flex>
                <md-sidenav class="md-sidenav-left" md-component-id="left" md-is-locked-open="$mdMedia('gt-md')" md-whiteframe="4">
                    <md-toolbar class="md-theme-indigo">
                        <h4 class="md-toobar-tools text-center">Welcome <?php echo $username; ?></h4>
                    </md-toolbar>
                    <md-content flex role="navigation">
                        <ul>
                            <li><a class="left-menu-a text-center" href="#/">Welcome <?php echo $username; ?></a></li>
                            <li><a class="left-menu-a text-center" href="#category">Categories</a></li>
                            <li><a class="left-menu-a text-center" href="#transaction">Transactions</a></li>
                            <li><a class="left-menu-a text-center" href="/User/signOut">Sign out</a></li>
                        </ul>
                    </md-content>
                </md-sidenav>
                <md-content flex layout-padding>
                    <div ng-view layout="column" layout-align="top"></div>
                </md-content>
            </section>
            <!--div class="left_menu">
                <ul>
                    <li><a href="#/">Welcome <?php echo $username; ?></a></li>
                    <li><a href="#category">Categories</a></li>
                    <li><a href="#transaction">Transactions</a></li>
                    <li><a href="/User/signOut">Sign out</a></li>
                </ul>
            </div>
            <div ng-view style="float: left">
            </div-->
        </div>
        <!-- Angular JS -->
        <script src="/public/js/angular-1.5.8/angular.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-route.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-animate.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-aria.min.js"></script>
        <script src="/public/js/angular-1.5.8/angular-messages.min.js"></script>
        <!-- Angular Material -->
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
        <script src="/public/js/rivulet_app.js"></script>
        <script src="/public/js/home_controller.js"></script>
    </body>
</html>
