<!DOCTYPE html>
<html lang="en_EN" class="no-js">

    <head>
        <title><?php echo $title;?></title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="<?php echo $title;?>">
        <link href="<?php echo base_url('favicon.ico');?>" rel="shortcut icon">
        <style type="text/css">
            * { margin: 0px; padding: 0px; }

            body { height: 100%; text-align: center; }

            h1 {
                color: #38D;
                display: block;
                font-family: monospace;
                font-size: 2.6em;
                font-weight: normal;
                letter-spacing: 2px;
                margin: -58px auto 0px auto;
                top: 50%;
                text-shadow: 1px 1px 1px rgba(0,0,0, .2);
            }

            body, h1 { position: absolute; width: 100%; }
        </style>
    </head>

    <body>
        <h1 align="center"><?php echo $greeting;?></h1>
    </body>

</html>

