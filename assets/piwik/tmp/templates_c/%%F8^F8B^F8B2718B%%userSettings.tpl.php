<?php /* Smarty version 2.6.26, created on 2013-09-10 09:00:45
         compiled from UsersManager/templates/userSettings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJavascriptTranslations', 'UsersManager/templates/userSettings.tpl', 2, false),array('function', 'ajaxErrorDiv', 'UsersManager/templates/userSettings.tpl', 83, false),array('function', 'ajaxLoadingDiv', 'UsersManager/templates/userSettings.tpl', 84, false),array('function', 'url', 'UsersManager/templates/userSettings.tpl', 92, false),array('modifier', 'translate', 'UsersManager/templates/userSettings.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'UsersManager'), $this);?>

<h2><?php echo ((is_array($_tmp='UsersManager_MenuUserSettings')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

<br/>

<div class="ui-confirm" id="confirmPasswordChange">
    <h2><?php echo ((is_array($_tmp='UsersManager_ChangePasswordConfirm')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <input role="yes" type="button" value="<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
    <input role="no" type="button" value="<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
</div>

<table id='userSettingsTable' class="adminTable" style='width:1050px'>
    <tr>
        <td><label for="username"><?php echo ((is_array($_tmp='General_Username')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </label></td>
        <td>
            <input size="25" value="<?php echo $this->_tpl_vars['userLogin']; ?>
" id="username" disabled="disabled"/>
            <span class='form-description'><?php echo ((is_array($_tmp='UsersManager_YourUsernameCannotBeChanged')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
        </td>
    </tr>

    <tr>
        <td><label for="alias"><?php echo ((is_array($_tmp='UsersManager_Alias')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </label></td>
        <td><input size="25" value="<?php echo $this->_tpl_vars['userAlias']; ?>
" id="alias"<?php if ($this->_tpl_vars['isSuperUser']): ?> disabled="disabled"<?php endif; ?> />
            <?php if ($this->_tpl_vars['isSuperUser']): ?>
                <span class='form-description'>
				<?php echo ((is_array($_tmp='UsersManager_TheSuperUserAliasCannotBeChanged')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

			</span>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td><label for="email"><?php echo ((is_array($_tmp='UsersManager_Email')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </label></td>
        <td><input size="25" value="<?php echo $this->_tpl_vars['userEmail']; ?>
" id="email"/></td>
    </tr>
    <tr>
        <td><?php echo ((is_array($_tmp='UsersManager_ReportToLoadByDefault')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
        <td>
            <fieldset>
                <label><input type="radio" value="MultiSites"
                              name="defaultReport"<?php if ($this->_tpl_vars['defaultReport'] == 'MultiSites'): ?> checked="checked"<?php endif; ?> /> <?php echo ((is_array($_tmp='General_AllWebsitesDashboard')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label><br/>
                <label style="padding-right:12px;"><input type="radio" value="1"
                                                          name="defaultReport"<?php if ($this->_tpl_vars['defaultReport'] != 'MultiSites'): ?> checked="checked"<?php endif; ?> /> <?php echo ((is_array($_tmp='General_DashboardForASpecificWebsite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                </label>
                <?php if ($this->_tpl_vars['defaultReport'] == 'MultiSites'): ?><?php $this->assign('defaultReportIdSite', 1); ?><?php else: ?><?php $this->assign('defaultReportIdSite', $this->_tpl_vars['defaultReport']); ?><?php endif; ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/sites_selection.tpl", 'smarty_include_vars' => array('siteName' => $this->_tpl_vars['defaultReportSiteName'],'idSite' => $this->_tpl_vars['defaultReportIdSite'],'switchSiteOnSelect' => false,'showAllSitesItem' => false,'showSelectedSite' => true,'siteSelectorId' => 'defaultReportSiteSelector')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td><?php echo ((is_array($_tmp='UsersManager_ReportDateToLoadByDefault')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
        <td>
            <fieldset>
                <?php $_from = $this->_tpl_vars['availableDefaultDates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['description']):
?>
                    <label><input type="radio"<?php if ($this->_tpl_vars['defaultDate'] == $this->_tpl_vars['value']): ?> checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['value']; ?>
" name="defaultDate"/> <?php echo $this->_tpl_vars['description']; ?>
</label>
                    <br/>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        </td>
    </tr>

    <?php if (isset ( $this->_tpl_vars['isValidHost'] ) && $this->_tpl_vars['isValidHost']): ?>
        <tr>
            <td><label for="email"><?php echo ((is_array($_tmp='UsersManager_ChangePassword')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </label></td>
            <td><input size="25" value="" autocomplete="off" id="password" type="password"/>
                <span class='form-description'><?php echo ((is_array($_tmp='UsersManager_IfYouWouldLikeToChangeThePasswordTypeANewOne')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
                <br/><br/><input size="25" value="" autocomplete="off" id="passwordBis" type="password"/>
                <span class='form-description'> <?php echo ((is_array($_tmp='UsersManager_TypeYourPasswordAgain')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
            </td>
        </tr>
    <?php endif; ?>
</table>
<?php if (! isset ( $this->_tpl_vars['isValidHost'] ) || ! $this->_tpl_vars['isValidHost']): ?>
    <div class="ajaxSuccess">
        <?php echo ((is_array($_tmp='UsersManager_InjectedHostCannotChangePwd')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['invalidHost']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['invalidHost'])); ?>

        &nbsp;<?php if (! $this->_tpl_vars['isSuperUser']): ?><?php echo ((is_array($_tmp='UsersManager_EmailYourAdministrator')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['invalidHostMailLinkStart'], '</a>') : smarty_modifier_translate($_tmp, $this->_tpl_vars['invalidHostMailLinkStart'], '</a>')); ?>
<?php endif; ?>
    </div>
    <br/>
<?php endif; ?>

<?php echo smarty_function_ajaxErrorDiv(array('id' => 'ajaxErrorUserSettings'), $this);?>

<?php echo smarty_function_ajaxLoadingDiv(array('id' => 'ajaxLoadingUserSettings'), $this);?>

<input type="submit" value="<?php echo ((is_array($_tmp='General_Save')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" id="userSettingsSubmit" class="submit"/>

<br/><br/>
<a name='excludeCookie'></a><h2><?php echo ((is_array($_tmp='UsersManager_ExcludeVisitsViaCookie')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
<p><?php if ($this->_tpl_vars['ignoreCookieSet']): ?><?php echo ((is_array($_tmp='UsersManager_YourVisitsAreIgnoredOnDomain')) ? $this->_run_mod_handler('translate', true, $_tmp, "<strong>", $this->_tpl_vars['piwikHost'], "</strong>") : smarty_modifier_translate($_tmp, "<strong>", $this->_tpl_vars['piwikHost'], "</strong>")); ?>

    <?php else: ?><?php echo ((is_array($_tmp='UsersManager_YourVisitsAreNotIgnored')) ? $this->_run_mod_handler('translate', true, $_tmp, "<strong>", "</strong>") : smarty_modifier_translate($_tmp, "<strong>", "</strong>")); ?>
<?php endif; ?></p>
<span style='margin-left:20px'>
<a href='<?php echo smarty_function_url(array('token_auth' => $this->_tpl_vars['token_auth'],'action' => 'setIgnoreCookie'), $this);?>
#excludeCookie'>&rsaquo; <?php if ($this->_tpl_vars['ignoreCookieSet']): ?><?php echo ((is_array($_tmp='UsersManager_ClickHereToDeleteTheCookie')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

    <?php else: ?><?php echo ((is_array($_tmp='UsersManager_ClickHereToSetTheCookieOnDomain')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['piwikHost']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['piwikHost'])); ?>
<?php endif; ?>
    <br/>
</a></span>

<br/><br/>
<?php if ($this->_tpl_vars['isSuperUser']): ?>
    <h2><?php echo ((is_array($_tmp='UsersManager_MenuAnonymousUserSettings')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <?php if (count ( $this->_tpl_vars['anonymousSites'] ) == 0): ?>
        <h3 class='form-description'><b><?php echo ((is_array($_tmp='UsersManager_NoteNoAnonymousUserAccessSettingsWontBeUsed2')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b></h3>
        <br/>
    <?php else: ?>
        <br/>
        <?php echo smarty_function_ajaxErrorDiv(array('id' => 'ajaxErrorAnonymousUserSettings'), $this);?>

        <?php echo smarty_function_ajaxLoadingDiv(array('id' => 'ajaxLoadingAnonymousUserSettings'), $this);?>

        <table id='anonymousUserSettingsTable' class="adminTable" style='width:850px;'>
            <tr>
                <td style='width:400px'><?php echo ((is_array($_tmp='UsersManager_WhenUsersAreNotLoggedInAndVisitPiwikTheyShouldAccess')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
                <td>
                    <fieldset>
                        <label><input type="radio" value="Login"
                                      name="anonymousDefaultReport"<?php if ($this->_tpl_vars['anonymousDefaultReport'] == $this->_tpl_vars['loginModule']): ?> checked="checked"<?php endif; ?> /> <?php echo ((is_array($_tmp='UsersManager_TheLoginScreen')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        </label><br/>
                        <label><input <?php if (empty ( $this->_tpl_vars['anonymousSites'] )): ?>disabled="disabled" <?php endif; ?>type="radio" value="MultiSites"
                                      name="anonymousDefaultReport"<?php if ($this->_tpl_vars['anonymousDefaultReport'] == 'MultiSites'): ?> checked="checked"<?php endif; ?> /> <?php echo ((is_array($_tmp='General_AllWebsitesDashboard')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        </label><br/>

                        <label><input <?php if (empty ( $this->_tpl_vars['anonymousSites'] )): ?>disabled="disabled" <?php endif; ?>type="radio" value="1"
                                      name="anonymousDefaultReport"<?php if ($this->_tpl_vars['anonymousDefaultReport'] > 0): ?> checked="checked"<?php endif; ?> /> <?php echo ((is_array($_tmp='General_DashboardForASpecificWebsite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        </label>
                        <?php if (! empty ( $this->_tpl_vars['anonymousSites'] )): ?>
                            <select id="anonymousDefaultReportWebsite">
                                <?php $_from = $this->_tpl_vars['anonymousSites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['info']):
?>
                                    <option value="<?php echo $this->_tpl_vars['info']['idsite']; ?>
" <?php if ($this->_tpl_vars['anonymousDefaultReport'] == $this->_tpl_vars['info']['idsite']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['info']['name']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        <?php endif; ?>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td><?php echo ((is_array($_tmp='UsersManager_ForAnonymousUsersReportDateToLoadByDefault')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</td>
                <td>
                    <fieldset>
                        <?php $_from = $this->_tpl_vars['availableDefaultDates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['value'] => $this->_tpl_vars['description']):
?>
                            <label><input type="radio" <?php if ($this->_tpl_vars['anonymousDefaultDate'] == $this->_tpl_vars['value']): ?>checked="checked" <?php endif; ?>value="<?php echo $this->_tpl_vars['value']; ?>
"
                                          name="anonymousDefaultDate"/> <?php echo $this->_tpl_vars['description']; ?>
</label>
                            <br/>
                        <?php endforeach; endif; unset($_from); ?>
                    </fieldset>
                </td>
            </tr>

        </table>
        <input type="submit" value="<?php echo ((is_array($_tmp='General_Save')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" id="anonymousUserSettingsSubmit" class="submit"/>
    <?php endif; ?>
<?php endif; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>