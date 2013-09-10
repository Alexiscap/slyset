<?php /* Smarty version 2.6.26, created on 2013-09-10 08:49:19
         compiled from CoreHome/templates/popover_rowevolution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreHome/templates/popover_rowevolution.tpl', 10, false),array('modifier', 'escape', 'CoreHome/templates/popover_rowevolution.tpl', 19, false),)), $this); ?>
<div class="rowevolution">
    <div class="popover-title"><?php echo $this->_tpl_vars['popoverTitle']; ?>
</div>
    <div class="graph">
        <?php echo $this->_tpl_vars['graph']; ?>

    </div>
    <div class="metrics-container">
        <h2><?php echo $this->_tpl_vars['availableMetricsText']; ?>
</h2>

        <div class="rowevolution-documentation">
            <?php echo ((is_array($_tmp='RowEvolution_Documentation')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

        </div>
        <table class="metrics" border="0" cellpadding="0" cellspacing="0">
            <?php $_from = $this->_tpl_vars['metrics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['metric']):
?>
                <tr>
                    <td class="sparkline">
                        <?php echo $this->_tpl_vars['metric']['sparkline']; ?>

                    </td>
                    <td class="text">
                        <span style="color:<?php echo $this->_tpl_vars['metric']['color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['metric']['label'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span><?php if ($this->_tpl_vars['metric']['details']): ?>:
                        <span class="details"><?php echo $this->_tpl_vars['metric']['details']; ?>
</span><?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </div>
    <div class="compare-container">
        <h2><?php echo ((is_array($_tmp='RowEvolution_CompareRows')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

        <div class="rowevolution-documentation">
            <?php echo ((is_array($_tmp='RowEvolution_CompareDocumentation')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

        </div>
        <a href="#" class="rowevolution-startmulti">&raquo; <?php echo ((is_array($_tmp='RowEvolution_PickARow')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
    </div>
</div>