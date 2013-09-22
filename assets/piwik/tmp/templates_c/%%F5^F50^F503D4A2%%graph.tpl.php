<?php /* Smarty version 2.6.26, created on 2013-09-22 10:36:48
         compiled from CoreHome/templates/graph.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'CoreHome/templates/graph.tpl', 1, false),array('modifier', 'escape', 'CoreHome/templates/graph.tpl', 1, false),array('modifier', 'translate', 'CoreHome/templates/graph.tpl', 26, false),)), $this); ?>
<div class="dataTable" data-report="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
" data-params="<?php echo ((is_array($_tmp=json_encode($this->_tpl_vars['javascriptVariablesToSet']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">

    <div class="reportDocumentation">
        <?php if (! empty ( $this->_tpl_vars['reportDocumentation'] )): ?><p><?php echo $this->_tpl_vars['reportDocumentation']; ?>
</p><?php endif; ?>
        <?php if (isset ( $this->_tpl_vars['properties']['metadata']['archived_date'] )): ?><p><?php echo $this->_tpl_vars['properties']['metadata']['archived_date']; ?>
</p><?php endif; ?>
    </div>

    <div class="<?php if ($this->_tpl_vars['graphType'] == 'evolution'): ?>dataTableGraphEvolutionWrapper<?php else: ?>dataTableGraphWrapper<?php endif; ?>">

        <?php if ($this->_tpl_vars['isDataAvailable']): ?>
            <div class="jqplot-<?php echo $this->_tpl_vars['graphType']; ?>
" style="padding-left: 6px;">
                <div class="piwik-graph"
                     style="position: relative; width: <?php echo $this->_tpl_vars['width']; ?>
<?php if (substr ( $this->_tpl_vars['width'] , -1 ) != '%'): ?>px<?php endif; ?>; height: <?php echo $this->_tpl_vars['height']; ?>
<?php if (substr ( $this->_tpl_vars['height'] , -1 ) != '%'): ?>px<?php endif; ?>;"
                     data-data="<?php echo ((is_array($_tmp=$this->_tpl_vars['data'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                     data-graph-type="<?php echo ((is_array($_tmp=$this->_tpl_vars['graphType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                        <?php if (isset ( $this->_tpl_vars['properties']['externalSeriesToggle'] ) && $this->_tpl_vars['properties']['externalSeriesToggle']): ?>
                    data-external-series-toggle="<?php echo ((is_array($_tmp=$this->_tpl_vars['properties']['externalSeriesToggle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                    data-external-series-show-all="<?php if ($this->_tpl_vars['properties']['externalSeriesToggleShowAll']): ?>1<?php else: ?>0<?php endif; ?>"
                        <?php endif; ?>>
                </div>
            </div>
        <?php else: ?>
            <div>
                <div class="pk-emptyGraph">
                    <?php if ($this->_tpl_vars['showReportDataWasPurgedMessage']): ?>
                        <?php echo ((is_array($_tmp='General_DataForThisGraphHasBeenPurged')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['deleteReportsOlderThan']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['deleteReportsOlderThan'])); ?>

                    <?php else: ?>
                        <?php echo ((is_array($_tmp='General_NoDataForGraph_js')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->_tpl_vars['properties']['show_footer']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/datatable_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/datatable_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>

    </div>
</div>