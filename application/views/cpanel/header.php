<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo ( empty( $page_title ) ? $this->config->item('site_title') : $page_title ) . ' | Dove' ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url') ?>public/admin/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url') ?>public/admin/css/style.css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url') ?>public/admin/css/jquery-ui.css">

</head>
<body>

<div id="container">
    <div id="header">
        <h2>Admin Cpanel</h2>
        <div id="topmenu">
            <ul>
                <li class="current"><a href="<?php echo $this->config->item('admin_url').'/index'; ?>">Home</a></li>
                <li class="fixed"><a href="<?php echo $this->config->item('admin_url').'/logout'; ?>">Logout</a></li>
            </ul>
        </div>
    </div>

    <div id="wrapper">

        <div id="content">
            <div id="box">