<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$pageDescription = "Ministère de la communication et de l'économie numérique: Plateforme Echanges";
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $pageDescription ?>:
    </title>
    <?= $this->Html->meta('favicon.png','/img/favicon.png',['type'=>'icon']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->script('font_awesome') ?>
    <?= $this->Html->css('../node_modules/bulma/custom_bulma') ?>
    <?= $this->Html->css('main') ?>
    <?= $this->Html->css('../node_modules/toastr/build/toastr.min') ?>
    <?= $this->fetch('css') ?>


    <?= $this->fetch('script') ?>
</head>
<body ng-app="login" ng-controller="MainCtrl as mainctrl" class="" style="background:url('/img/chartkit/back_dots.png');">

    <?= $this->fetch('content') ?>
    <!-- Load angular app here -->


    <?= $this->Html->script('jquery.min') ?>
    
    <?= $this->Html->script('../node_modules/angular/angular.min') ?>
    <?= $this->Html->script('../node_modules/toastr/build/toastr.min') ?>
     <?= $this->Html->script('../node_modules/ng-file-upload/dist/ng-file-upload-all.min') ?>

    <?= $this->Html->script('auth/login') ?>
    <script>
       toastr.options = {
        progressBar: true,
        preventDuplicates: true,
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        closeMethod:'slideUp',
        newestOnTop: true,
        closeButton :true,
        // timeOut:0,
        // extendedTimeOut:0
       };
    </script>
</body>
</html>
