<?php

namespace backend\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@backend/modules/admin/web';
    public $baseUrl = '@web/admin_web/';
    
    public $css = [
        'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css',
        //'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        'plugins/fontawesome-free/css/all.min.css',
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        // //'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        // //'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        // //'plugins/jqvmap/jqvmap.min.css',
        //'dist/css/adminlte.min.css',
        //'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        // //'plugins/daterangepicker/daterangepicker.css',
        // //'plugins/summernote/summernote-bs4.min.css',        

    ];
    public $js = [
        //'plugins/jquery/jquery.min.js',
        'https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js',
        // 'plugins/jquery/jquery.min.js',
        // 'plugins/jquery-ui/jquery-ui.min.js',
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        // 'plugins/chart.js/Chart.min.js',
        // 'plugins/sparklines/sparkline.js',
        // 'plugins/jqvmap/jquery.vmap.min.js',
        // 'plugins/jqvmap/maps/jquery.vmap.usa.js',
        // 'plugins/jquery-knob/jquery.knob.min.js',
        // 'plugins/moment/moment.min.js',
        // 'plugins/daterangepicker/daterangepicker.js',
        // 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        // 'plugins/summernote/summernote-bs4.min.js',
        // 'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        // 'dist/js/adminlte.js',
        // 'dist/js/pages/dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',

    ];
}
