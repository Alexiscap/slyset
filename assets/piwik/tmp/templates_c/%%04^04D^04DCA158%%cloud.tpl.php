<?php /* Smarty version 2.6.26, created on 2013-09-10 08:46:17
         compiled from CoreHome/templates/cloud.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'CoreHome/templates/cloud.tpl', 1, false),array('modifier', 'escape', 'CoreHome/templates/cloud.tpl', 1, false),array('modifier', 'translate', 'CoreHome/templates/cloud.tpl', 8, false),)), $this); ?>
<div class="dataTable" data-report="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
" data-params="<?php echo ((is_array($_tmp=json_encode($this->_tpl_vars['javascriptVariablesToSet']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
    <?php if (! empty ( $this->_tpl_vars['reportDocumentation'] ) && $this->_tpl_vars['javascriptVariablesToSet']['viewDataTable'] != 'tableGoals'): ?>
        <div class="reportDocumentation"><p><?php echo $this->_tpl_vars['reportDocumentation']; ?>
</p></div>
    <?php endif; ?>
    <div class="tagCloud">
        <?php if (count ( $this->_tpl_vars['cloudValues'] ) == 0): ?>
            <?php if ($this->_tpl_vars['showReportDataWasPurgedMessage']): ?>
                <div class="pk-emptyDataTable"><?php echo ((is_array($_tmp='General_DataForThisTagCloudHasBeenPurged')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['deleteReportsOlderThan']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['deleteReportsOlderThan'])); ?>
</div>
            <?php else: ?>
                <div class="pk-emptyDataTable"><?php echo ((is_array($_tmp='General_NoDataForTagCloud')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
            <?php endif; ?>
        <?php else: ?>
            <?php $_from = $this->_tpl_vars['cloudValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['word'] => $this->_tpl_vars['value']):
?>
                <span title="<?php echo $this->_tpl_vars['value']['word']; ?>
 (<?php echo $this->_tpl_vars['value']['value']; ?>
 <?php echo $this->_tpl_vars['columnTranslation']; ?>
)"
                      class="word size<?php echo $this->_tpl_vars['value']['size']; ?>
  <?php if ($this->_tpl_vars['value']['value'] == 0): ?>valueIsZero<?php endif; ?>">
		<?php if (false !== $this->_tpl_vars['labelMetadata'][$this->_tpl_vars['value']['word']]['url']): ?><a href="<?php echo $this->_tpl_vars['labelMetadata'][$this->_tpl_vars['value']['word']]['url']; ?>
" target="_blank"><?php endif; ?>
                        <?php if (false !== $this->_tpl_vars['labelMetadata'][$this->_tpl_vars['value']['word']]['logo']): ?><img src="<?php echo $this->_tpl_vars['labelMetadata'][$this->_tpl_vars['value']['word']]['logo']; ?>
" width="<?php echo $this->_tpl_vars['value']['logoWidth']; ?>
" /><?php else: ?>
                            <?php echo $this->_tpl_vars['value']['wordTruncated']; ?>
<?php endif; ?><?php if (false !== $this->_tpl_vars['labelMetadata'][$this->_tpl_vars['value']['word']]['url']): ?></a><?php endif; ?></span>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
    </div>
    <?php if ($this->_tpl_vars['properties']['show_footer']): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/datatable_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/datatable_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>