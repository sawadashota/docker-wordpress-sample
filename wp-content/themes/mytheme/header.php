<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php bloginfo(‘title’); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/app.css" type="text/css"/>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
