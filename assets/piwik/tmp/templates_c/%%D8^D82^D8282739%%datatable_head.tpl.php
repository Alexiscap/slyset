<?php /* Smarty version 2.6.26, created on 2013-09-10 08:46:30
         compiled from CoreHome/templates/datatable_head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'CoreHome/templates/datatable_head.tpl', 8, false),array('modifier', 'replace', 'CoreHome/templates/datatable_head.tpl', 8, false),)), $this); ?>
<thead>
   <tr>
       <?php $_from = $this->_tpl_vars['dataTableColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['head'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['head']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column']):
        $this->_foreach['head']['iteration']++;
?>
           <th class="sortable <?php if (($this->_foreach['head']['iteration'] <= 1)): ?>first<?php elseif (($this->_foreach['head']['iteration'] == $this->_foreach['head']['total'])): ?>last<?php endif; ?>" id="<?php echo $this->_tpl_vars['column']; ?>
">
               <?php if (! empty ( $this->_tpl_vars['columnDocumentation'][$this->_tpl_vars['column']] )): ?>
                   <div class="columnDocumentation">
                       <div class="columnDocumentationTitle">
                           <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['columnTranslations'][$this->_tpl_vars['column']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('replace', true, $_tmp, "&amp;nbsp;", "&nbsp;") : smarty_modifier_replace($_tmp, "&amp;nbsp;", "&nbsp;")); ?>

                       </div>
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['columnDocumentation'][$this->_tpl_vars['column']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                   </div>
               <?php endif; ?>
               <div id="thDIV"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['columnTranslations'][$this->_tpl_vars['column']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('replace', true, $_tmp, "&amp;nbsp;", "&nbsp;") : smarty_modifier_replace($_tmp, "&amp;nbsp;", "&nbsp;")); ?>
</div>
           </th>
       <?php endforeach; endif; unset($_from); ?>
   </tr>
</thead>