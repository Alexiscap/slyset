<?php /* Smarty version 2.6.26, created on 2013-09-10 09:00:45
         compiled from CoreAdminHome/templates/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreAdminHome/templates/menu.tpl', 7, false),array('modifier', 'urlRewriteWithParameters', 'CoreAdminHome/templates/menu.tpl', 11, false),)), $this); ?>
<?php if (count ( $this->_tpl_vars['menu'] ) > 1): ?>
    <div id="menu">
        <ul id="tablist">
            <?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['submenu']):
        $this->_foreach['menu']['iteration']++;
?>
                <?php if ($this->_tpl_vars['submenu']['_hasSubmenu']): ?>
                    <li>
                        <span><?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
                        <ul>
                            <?php $_from = $this->_tpl_vars['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sname'] => $this->_tpl_vars['url']):
        $this->_foreach['submenu']['iteration']++;
?>
                                <?php if (strpos ( $this->_tpl_vars['sname'] , '_' ) !== 0): ?>
                                    <li><a href='index.php<?php echo smarty_modifier_urlRewriteWithParameters($this->_tpl_vars['url']['_url']); ?>
'
                                           <?php if (isset ( $this->_tpl_vars['currentAdminMenuName'] ) && $this->_tpl_vars['sname'] == $this->_tpl_vars['currentAdminMenuName']): ?>class='active'<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['sname'])) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a></li>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>
<?php endif; ?>