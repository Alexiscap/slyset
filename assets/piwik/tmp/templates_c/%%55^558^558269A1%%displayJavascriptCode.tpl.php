<?php /* Smarty version 2.6.26, created on 2013-09-10 08:44:33
         compiled from Installation/templates/displayJavascriptCode.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'Installation/templates/displayJavascriptCode.tpl', 3, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['displayfirstWebsiteSetupSuccess'] )): ?>
    <span id="toFade" class="success">
	<?php echo ((is_array($_tmp='Installation_SetupWebsiteSetupSuccess')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['displaySiteName']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['displaySiteName'])); ?>

        <img src="themes/default/images/success_medium.png"/>
</span>
<?php endif; ?>

<?php echo $this->_tpl_vars['trackingHelp']; ?>

<br/><br/>
<h2><?php echo ((is_array($_tmp='Installation_LargePiwikInstances')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
<?php echo ((is_array($_tmp='Installation_JsTagArchivingHelp1')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a target="_blank" href="http://piwik.org/docs/setup-auto-archiving/">', '</a>') : smarty_modifier_translate($_tmp, '<a target="_blank" href="http://piwik.org/docs/setup-auto-archiving/">', '</a>')); ?>
 <?php echo ((is_array($_tmp='General_ReadThisToLearnMore')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a target="_blank" href="http://piwik.org/docs/optimize/">', '</a>') : smarty_modifier_translate($_tmp, '<a target="_blank" href="http://piwik.org/docs/optimize/">', '</a>')); ?>


<?php echo '
    <style type="text/css">
        code {
            font-size: 80%;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(\'code\').click(function () { $(this).select(); });
        });
    </script>
'; ?>
