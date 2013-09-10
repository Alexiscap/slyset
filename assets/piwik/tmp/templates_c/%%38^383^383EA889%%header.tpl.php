<?php /* Smarty version 2.6.26, created on 2013-09-10 09:00:45
         compiled from CoreAdminHome/templates/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreAdminHome/templates/header.tpl', 7, false),array('function', 'loadJavascriptTranslations', 'CoreAdminHome/templates/header.tpl', 12, false),array('function', 'ajaxRequestErrorDiv', 'CoreAdminHome/templates/header.tpl', 37, false),)), $this); ?>
<!DOCTYPE html>
<!--[if lt IE 9 ]>
<html class="old-ie"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html><!--<![endif]-->
<head>
    <title><?php if (! $this->_tpl_vars['isCustomLogo']): ?>Piwik &rsaquo; <?php endif; ?><?php echo ((is_array($_tmp='CoreAdminHome_Administration')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="generator" content="Piwik - Open Source Web Analytics"/>
    <link rel="shortcut icon" href="plugins/CoreHome/templates/images/favicon.ico"/>

    <?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'CoreAdminHome CoreHome'), $this);?>


    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/js_global_variables.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/js_css_includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="themes/default/ieonly.css"/>
    <![endif]-->
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/iframe_buster_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/iframe_buster_body.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="root">
    <?php if (! isset ( $this->_tpl_vars['showTopMenu'] ) || $this->_tpl_vars['showTopMenu']): ?>
        <?php $this->assign('showSitesSelection', false); ?>
        <?php $this->assign('showPeriodSelection', false); ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/top_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>

    <div id="header">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/logo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php if ($this->_tpl_vars['showPeriodSelection']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/period_select.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/js_disabled_notice.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <?php echo smarty_function_ajaxRequestErrorDiv(array(), $this);?>

    <div id="container">
        <?php if (! isset ( $this->_tpl_vars['showMenu'] ) || $this->_tpl_vars['showMenu']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>

        <div id="content" class="admin">

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/header_message.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            <?php if (! empty ( $this->_tpl_vars['configFileNotWritable'] )): ?>
                <div class="ajaxSuccess" style="display:inline-block">
                    <?php echo ((is_array($_tmp='General_ConfigFileIsNotWritable')) ? $this->_run_mod_handler('translate', true, $_tmp, "(config/config.ini.php)", "<br/>") : smarty_modifier_translate($_tmp, "(config/config.ini.php)", "<br/>")); ?>

                </div>
            <?php elseif (preg_match ( '/updated=[1-9]/' , $this->_tpl_vars['url'] )): ?>
                <div class="ajaxSuccess" style="display:inline-block">
                    <?php echo ((is_array($_tmp='General_YourChangesHaveBeenSaved')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                </div>
            <?php endif; ?>

            <?php if (! empty ( $this->_tpl_vars['statisticsNotRecorded'] )): ?>
                <div class="ajaxSuccess" style="display:inline-block">
                    <?php echo ((is_array($_tmp='General_StatisticsAreNotRecorded')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                </div>
            <?php endif; ?>

            <div class="ui-confirm" id="alert">
                <h2></h2>
                <input role="no" type="button" value="<?php echo ((is_array($_tmp='General_Ok')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
            </div>

            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/warning_invalid_host.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            
                        <?php if (empty ( $this->_tpl_vars['phpIsNewEnough'] )): ?>
                <div class="ajaxSuccess">
                    <strong><em><?php echo ((is_array($_tmp='CoreAdminHome_YouAreCurrentlyUsingPHP')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['phpVersion']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['phpVersion'])); ?>
</em></strong>
                    <br/><br/>
                    <?php echo ((is_array($_tmp='CoreAdminHome_OldPHPVersionWarning_Part1')) ? $this->_run_mod_handler('translate', true, $_tmp, '<strong><em>', '</em></strong>') : smarty_modifier_translate($_tmp, '<strong><em>', '</em></strong>')); ?>

                    <br/><br/>
                    <?php echo ((is_array($_tmp='CoreAdminHome_OldPHPVersionWarning_Part2')) ? $this->_run_mod_handler('translate', true, $_tmp, '<strong><em>', '</em></strong>') : smarty_modifier_translate($_tmp, '<strong><em>', '</em></strong>')); ?>

                </div>
            <?php endif; ?>

                        <?php if ($this->_tpl_vars['isSuperUser'] && ! empty ( $this->_tpl_vars['missingPluginsWarning'] )): ?>
                <div class="ajaxSuccess">
                    <strong><?php echo ((is_array($_tmp='General_Warning')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:&nbsp;</strong><?php echo $this->_tpl_vars['missingPluginsWarning']; ?>

                </div>
            <?php endif; ?>

                        <?php if ($this->_tpl_vars['isSuperUser'] && ! empty ( $this->_tpl_vars['usingOldGeoIPPlugin'] )): ?>
                <div class="ajaxSuccess">
                    <strong><?php echo ((is_array($_tmp='General_Warning')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        :&nbsp;</strong><?php echo ((is_array($_tmp='UserCountry_OldGeoIPWarning')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="index.php?module=CorePluginsAdmin&action=index&idSite=1&period=day&date=yesterday">', '</a>', '<a href="index.php?module=UserCountry&action=adminIndex&idSite=1&period=day&date=yesterday#location-providers">', '</a>', '<a href="http://piwik.org/faq/how-to/#faq_167">', '</a>', '<a href="http://piwik.org/faq/how-to/#faq_59">', '</a>') : smarty_modifier_translate($_tmp, '<a href="index.php?module=CorePluginsAdmin&action=index&idSite=1&period=day&date=yesterday">', '</a>', '<a href="index.php?module=UserCountry&action=adminIndex&idSite=1&period=day&date=yesterday#location-providers">', '</a>', '<a href="http://piwik.org/faq/how-to/#faq_167">', '</a>', '<a href="http://piwik.org/faq/how-to/#faq_59">', '</a>')); ?>

                </div>
            <?php endif; ?>