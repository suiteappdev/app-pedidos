<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 

    if (isset($this->css)){
        foreach ($this->css as $css){
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'" />';
        }
    }
    
    ?>
</head>
<body>

