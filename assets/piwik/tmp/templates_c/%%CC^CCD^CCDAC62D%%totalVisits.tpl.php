<?php /* Smarty version 2.6.26, created on 2013-09-22 10:36:49
         compiled from Live/templates/totalVisits.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'Live/templates/totalVisits.tpl', 6, false),)), $this); ?>
<div id="visitsTotal">
    <table class="dataTable" cellspacing="0">
        <thead>
        <tr>
            <th id="label" class="sortable label" style="cursor: auto;">
                <div id="thDIV"><?php echo ((is_array($_tmp='General_Date')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
            </th>
            <th id="label" class="sortable label" style="cursor: auto;">
                <div id="thDIV"><?php echo ((is_array($_tmp='General_ColumnNbVisits')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
            </th>
            <th id="label" class="sortable label" style="cursor: auto;">
                <div id="thDIV"><?php echo ((is_array($_tmp='General_ColumnPageviews')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="">
            <td class="columnodd"><?php echo ((is_array($_tmp='Live_LastHours')) ? $this->_run_mod_handler('translate', true, $_tmp, 24) : smarty_modifier_translate($_tmp, 24)); ?>
</td>
            <td class="columnodd"><?php echo $this->_tpl_vars['visitorsCountToday']; ?>
</td>
            <td class="columnodd"><?php echo $this->_tpl_vars['pisToday']; ?>
</td>
        </tr>
        <tr class="">
            <td class="columnodd"><?php echo ((is_array($_tmp='Live_LastMinutes')) ? $this->_run_mod_handler('translate', true, $_tmp, 30) : smarty_modifier_translate($_tmp, 30)); ?>
</td>
            <td class="columnodd"><?php echo $this->_tpl_vars['visitorsCountHalfHour']; ?>
</td>
            <td class="columnodd"><?php echo $this->_tpl_vars['pisHalfhour']; ?>
</td>
        </tr>
        </tbody>
    </table>
</div>