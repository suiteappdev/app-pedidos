<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($this->title)) ? $this->title : 'APP'; ?></title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/boostrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/boostrap/css/bootstrap-dialog.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/animate.css" />
    <link href="<?php echo URL; ?>public/flatui/css/flat-ui.css" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/favicon.ico">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="public/js/Component/General.js"></script>
    <script src="public/js/jquery-ui.js"></script>
    <script src="public/js/fixheader.js"></script>
    <script src="public/js/table.js"></script>
    
    <?php 

    if (isset($this->css)){
        foreach ($this->css as $css){
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'" />';
        }
    }
    
    ?>
</head>
<body>
<?php Session::init(); ?>
<header id="header">
    <?php if(isset($this->empresa[0]['Empresa'])) :?>
        <span class="icon-bookmarks" style="float: left;display: inline-table;font-size: 22px;color: #A9C513;margin-right: 5px;"></span><h3 style="display:inline-block; float:left;margin:0px;" class="light animated fadeInLeft"><?php echo (isset($this->empresa[0]['Empresa'])) ? $this->empresa[0]['Empresa'] : ''; ?></h3>
    <?php endif; ?>
    <div id="logo">
    </div>
    <nav class="nav animated bounceInDown">
        <?php if (Session::get('loggedIn') == false):?>
            <a class="menu-item" href="<?php echo URL; ?>index">Inicio</a>
            <a class="menu-item" id="cmdLogin" class="flat-btn light regular" href="<?php echo URL; ?>index">Iniciar Sesion</a>

        <?php endif; ?>    
        <?php if (Session::get('loggedIn') == true):?>
            <a class="menu-item username-area" href="#"><div style="display:inline-block;margin-right:3px;box-sizing:border-box;font-size: 15px;" class="icon-user4"></div><?php echo Session::get('username')?></a>
            <a class="menu-item" href="<?php echo URL; ?>dashboard">Administraci&oacute;n</a>
            <?php if (Session::get('role') == 'owner'):?>
            <a class="menu-item" href="<?php echo URL; ?>user">Usuarios</a>
            <?php endif; ?>
            <a class="menu-item" href="<?php echo URL; ?>dashboard/logout"><div style="display:inline-block;margin-right:3px;box-sizing:border-box;font-size: 15px;" class="icon-lock"></div>Cerrar Sesi&oacute;n</a> 
        <?php else: ?>
        <?php endif; ?>
    </nav>
</header>
<div id="content">
    
    