<?php /* Smarty version 2.6.26, created on 2013-09-10 09:04:03
         compiled from Actions/templates/indexSiteSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'Actions/templates/indexSiteSearch.tpl', 2, false),)), $this); ?>
<div id='leftcolumn'>
    <h2><?php echo ((is_array($_tmp='Actions_WidgetSearchKeywords')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <?php echo $this->_tpl_vars['keywords']; ?>


    <h2><?php echo ((is_array($_tmp='Actions_WidgetSearchNoResultKeywords')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <?php echo $this->_tpl_vars['noResultKeywords']; ?>


    <?php if (isset ( $this->_tpl_vars['categories'] )): ?>
        <h2><?php echo ((is_array($_tmp='Actions_WidgetSearchCategories')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
        <?php echo $this->_tpl_vars['categories']; ?>

    <?php endif; ?>

</div>

<div id='rightcolumn'>
    <h2><?php echo ((is_array($_tmp='Actions_WidgetPageUrlsFollowingSearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <?php echo $this->_tpl_vars['pagesUrlsFollowingSiteSearch']; ?>


</div>