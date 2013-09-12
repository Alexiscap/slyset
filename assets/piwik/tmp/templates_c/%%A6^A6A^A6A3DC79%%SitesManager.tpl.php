<?php /* Smarty version 2.6.26, created on 2013-09-10 09:01:13
         compiled from SitesManager/templates/SitesManager.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadJavascriptTranslations', 'SitesManager/templates/SitesManager.tpl', 2, false),array('function', 'ajaxErrorDiv', 'SitesManager/templates/SitesManager.tpl', 157, false),array('function', 'ajaxLoadingDiv', 'SitesManager/templates/SitesManager.tpl', 158, false),array('function', 'url', 'SitesManager/templates/SitesManager.tpl', 233, false),array('modifier', 'translate', 'SitesManager/templates/SitesManager.tpl', 5, false),array('modifier', 'inlineHelp', 'SitesManager/templates/SitesManager.tpl', 9, false),array('modifier', 'escape', 'SitesManager/templates/SitesManager.tpl', 63, false),array('modifier', 'count', 'SitesManager/templates/SitesManager.tpl', 164, false),array('modifier', 'replace', 'SitesManager/templates/SitesManager.tpl', 183, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'SitesManager'), $this);?>


<?php ob_start(); ?>
    <?php echo ((is_array($_tmp='SitesManager_HelpExcludedIps')) ? $this->_run_mod_handler('translate', true, $_tmp, "1.2.3.*", "1.2.*.*") : smarty_modifier_translate($_tmp, "1.2.3.*", "1.2.*.*")); ?>

<br/><br/>
    <?php echo ((is_array($_tmp='SitesManager_YourCurrentIpAddressIs')) ? $this->_run_mod_handler('translate', true, $_tmp, "<i>".($this->_tpl_vars['currentIpAddress'])."</i>") : smarty_modifier_translate($_tmp, "<i>".($this->_tpl_vars['currentIpAddress'])."</i>")); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('excludedIpHelpPlain', ob_get_contents());ob_end_clean(); ?>
<?php $this->assign('excludedIpHelp', ((is_array($_tmp=$this->_tpl_vars['excludedIpHelpPlain'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>

<?php ob_start(); ?>
    <?php if ($this->_tpl_vars['timezoneSupported']): ?>
        <?php echo ((is_array($_tmp='SitesManager_ChooseCityInSameTimezoneAsYou')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

        <?php else: ?>
        <?php echo ((is_array($_tmp='SitesManager_AdvancedTimezoneSupportNotFound')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

    <?php endif; ?>
<br/><br/>
    <?php echo ((is_array($_tmp='SitesManager_UTCTimeIs')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['utcTime']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['utcTime'])); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('defaultTimezoneHelpPlain', ob_get_contents());ob_end_clean(); ?>

<?php ob_start(); ?>
    <?php echo $this->_tpl_vars['defaultTimezoneHelpPlain']; ?>

<br/><br/><?php echo ((is_array($_tmp='SitesManager_ChangingYourTimezoneWillOnlyAffectDataForward')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('timezoneHelpPlain', ob_get_contents());ob_end_clean(); ?>

<?php ob_start(); ?>
    <?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_CurrencySymbolWillBeUsedForGoals')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('currencyHelpPlain', ob_get_contents());ob_end_clean(); ?>

<?php ob_start(); ?>
    <?php echo ((is_array($_tmp='SitesManager_EcommerceHelp')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<br/>
    <?php echo ((is_array($_tmp='SitesManager_PiwikOffersEcommerceAnalytics')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='http://piwik.org/docs/ecommerce-analytics/' target='_blank'>", "</a>") : smarty_modifier_translate($_tmp, "<a href='http://piwik.org/docs/ecommerce-analytics/' target='_blank'>", "</a>")); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ecommerceHelpPlain', ob_get_contents());ob_end_clean(); ?>

<?php ob_start(); ?>
    <?php echo ((is_array($_tmp='SitesManager_ListOfQueryParametersToExclude')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<br/><br/>
    <?php echo ((is_array($_tmp='SitesManager_PiwikWillAutomaticallyExcludeCommonSessionParameters')) ? $this->_run_mod_handler('translate', true, $_tmp, "phpsessid, sessionid, ...") : smarty_modifier_translate($_tmp, "phpsessid, sessionid, ...")); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('excludedQueryParametersHelp', ob_get_contents());ob_end_clean(); ?>
<?php $this->assign('excludedQueryParametersHelp', ((is_array($_tmp=$this->_tpl_vars['excludedQueryParametersHelp'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>

<?php ob_start(); ?>
    <?php echo ((is_array($_tmp='SitesManager_GlobalExcludedUserAgentHelp1')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<br/><br/>
    <?php echo ((is_array($_tmp='SitesManager_GlobalListExcludedUserAgents_Desc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='SitesManager_GlobalExcludedUserAgentHelp2')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('excludedUserAgentsHelp', ob_get_contents());ob_end_clean(); ?>
<?php $this->assign('excludedUserAgentsHelp', ((is_array($_tmp=$this->_tpl_vars['excludedUserAgentsHelp'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>

<?php ob_start(); ?>
<h4 style="display:inline-block;"><?php echo ((is_array($_tmp='SitesManager_KeepURLFragmentsLong')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h4>

<select id="keepURLFragmentSelect">
    <option value="0"> <?php if ($this->_tpl_vars['globalKeepURLFragments']): ?><?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php endif; ?>
        (<?php echo ((is_array($_tmp='General_Default')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
)
    </option>
    <option value="1"><?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
    <option value="2"><?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
</select>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('keepURLFragmentSelectHTML', ob_get_contents());ob_end_clean(); ?>

<script type="text/javascript">
var excludedIpHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['excludedIpHelp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var aliasUrlsHelp = '<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='SitesManager_AliasUrlHelp')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var excludedQueryParametersHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['excludedQueryParametersHelp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var excludedUserAgentsHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['excludedUserAgentsHelp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var timezoneHelp = '<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['timezoneHelpPlain'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var currencyHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['currencyHelpPlain'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var ecommerceHelp = '<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['ecommerceHelpPlain'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var ecommerceEnabled = '<?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_EnableEcommerce')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var ecommerceDisabled = '<?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_NotAnEcommerceSite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
<?php $this->assign('defaultTimezoneHelp', ((is_array($_tmp=$this->_tpl_vars['defaultTimezoneHelpPlain'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>
<?php $this->assign('searchKeywordHelp', ((is_array($_tmp=((is_array($_tmp='SitesManager_SearchKeywordParametersDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>
<?php ob_start(); ?><?php echo ((is_array($_tmp='Goals_Optional')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='SitesManager_SearchCategoryParametersDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('searchCategoryHelpText', ob_get_contents());ob_end_clean(); ?>
<?php $this->assign('searchCategoryHelp', ((is_array($_tmp=$this->_tpl_vars['searchCategoryHelpText'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp))); ?>
var sitesearchEnabled = '<?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_EnableSiteSearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var sitesearchDisabled = '<?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_DisableSiteSearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var searchKeywordHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['searchKeywordHelp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var searchCategoryHelp = '<?php echo ((is_array($_tmp=$this->_tpl_vars['searchCategoryHelp'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var sitesearchDesc = '<?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_TrackingSiteSearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var keepURLFragmentSelectHTML = '<?php echo ((is_array($_tmp=$this->_tpl_vars['keepURLFragmentSelectHTML'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';

var sitesManager = new SitesManager(<?php echo $this->_tpl_vars['timezones']; ?>
, <?php echo $this->_tpl_vars['currencies']; ?>
, '<?php echo $this->_tpl_vars['defaultTimezone']; ?>
', '<?php echo $this->_tpl_vars['defaultCurrency']; ?>
');
<?php $this->assign('searchKeywordLabel', ((is_array($_tmp='SitesManager_SearchKeywordLabel')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp))); ?>
<?php $this->assign('searchCategoryLabel', ((is_array($_tmp='SitesManager_SearchCategoryLabel')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp))); ?>
var searchKeywordLabel = '<?php echo ((is_array($_tmp=$this->_tpl_vars['searchKeywordLabel'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var searchCategoryLabel = '<?php echo ((is_array($_tmp=$this->_tpl_vars['searchCategoryLabel'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
<?php $this->assign('sitesearchIntro', ((is_array($_tmp='SitesManager_SiteSearchUse')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp))); ?>
var sitesearchIntro = '<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['sitesearchIntro'])) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
var sitesearchUseDefault = '<?php if ($this->_tpl_vars['isSuperUser']): ?><?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_SearchUseDefault')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="#globalSiteSearch">', '</a>') : smarty_modifier_translate($_tmp, '<a href="#globalSiteSearch">', '</a>')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_SearchUseDefault')) ? $this->_run_mod_handler('translate', true, $_tmp, '', '') : smarty_modifier_translate($_tmp, '', '')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
<?php endif; ?>';
var strDefault = '<?php echo ((is_array($_tmp='General_Default')) ? $this->_run_mod_handler('translate', true, $_tmp, 'escape', 'javascript') : smarty_modifier_translate($_tmp, 'escape', 'javascript')); ?>
';
<?php echo '
$(document).ready(function () {
    sitesManager.init();
});
</script>

<style type="text/css">
    .entityTable tr td {
        vertical-align: top;
        padding-top: 7px;
    }

    .addRowSite:hover, .editableSite:hover, .addsite:hover, .cancel:hover, .deleteSite:hover, .editSite:hover, .updateSite:hover {
        cursor: pointer;
    }

    .addRowSite a {
        text-decoration: none;
    }

    .addRowSite {
        padding: 1em;
        font-weight: bold;
    }

    #editSites {
        vertical-align: top;
    }

    option, select {
        font-size: 11px;
    }

    textarea {
        font-size: 9pt;
    }

    .admin thead th {
        vertical-align: middle;
    }

    .ecommerceInactive, .sitesearchInactive {
        color: #666666;
    }

    #searchSiteParameters {
        display: none;
    }

    #editSites h4 {
        font-size: .8em;
        margin: 1em 0 1em 0;
        font-weight: bold;
    }
</style>
'; ?>


<h2><?php echo ((is_array($_tmp='SitesManager_WebsitesManagement')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
<p><?php echo ((is_array($_tmp='SitesManager_MainDescription')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

<?php echo ((is_array($_tmp='SitesManager_YouCurrentlyHaveAccessToNWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp, "<b>".($this->_tpl_vars['adminSitesCount'])."</b>") : smarty_modifier_translate($_tmp, "<b>".($this->_tpl_vars['adminSitesCount'])."</b>")); ?>

<?php if ($this->_tpl_vars['isSuperUser']): ?>
    <br/>
    <?php echo ((is_array($_tmp='SitesManager_SuperUserCan')) ? $this->_run_mod_handler('translate', true, $_tmp, "<a href='#globalSettings'>", "</a>") : smarty_modifier_translate($_tmp, "<a href='#globalSettings'>", "</a>")); ?>

<?php endif; ?>
</p>
<?php echo smarty_function_ajaxErrorDiv(array(), $this);?>

<?php echo smarty_function_ajaxLoadingDiv(array(), $this);?>


<?php ob_start(); ?>
<div class="addRowSite"><img src='plugins/UsersManager/images/add.png' alt=""/> <?php echo ((is_array($_tmp='SitesManager_AddSite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('createNewWebsite', ob_get_contents());ob_end_clean(); ?>

<?php if (count($this->_tpl_vars['adminSites']) == 0): ?>
    <?php echo ((is_array($_tmp='SitesManager_NoWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

    <?php else: ?>
<div class="ui-confirm" id="confirm">
    <h2></h2>
    <input role="yes" type="button" value="<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
    <input role="no" type="button" value="<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
</div>
<div class="entityContainer">
    <?php if ($this->_tpl_vars['isSuperUser']): ?>
        <?php echo $this->_tpl_vars['createNewWebsite']; ?>

    <?php endif; ?>
    <table class="entityTable dataTable" id="editSites">
        <thead>
        <tr>
            <th><?php echo ((is_array($_tmp='General_Id')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='General_Name')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='SitesManager_Urls')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='SitesManager_ExcludedIps')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_ExcludedParameters')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', "<br />") : smarty_modifier_replace($_tmp, ' ', "<br />")); ?>
</th>
            <th id='exclude-user-agent-header'
                <?php if (! $this->_tpl_vars['allowSiteSpecificUserAgentExclude']): ?>style="display:none"<?php endif; ?>><?php echo ((is_array($_tmp='SitesManager_ExcludedUserAgents')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='Actions_SubmenuSitesearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='SitesManager_Timezone')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='SitesManager_Currency')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='Goals_Ecommerce')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th></th>
            <th></th>
            <th> <?php echo ((is_array($_tmp='SitesManager_JsTrackingTag')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </th>
        </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['adminSites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['site']):
?>
            <tr id="row<?php echo $this->_tpl_vars['site']['idsite']; ?>
" data-keep-url-fragments="<?php echo $this->_tpl_vars['site']['keep_url_fragment']; ?>
">
                <td id="idSite"><?php echo $this->_tpl_vars['site']['idsite']; ?>
</td>
                <td id="siteName" class="editableSite"><?php echo $this->_tpl_vars['site']['name']; ?>
</td>
                <td id="urls" class="editableSite"><?php $_from = $this->_tpl_vars['site']['alias_urls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['url']):
?><?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('replace', true, $_tmp, "http://", "") : smarty_modifier_replace($_tmp, "http://", "")); ?>

                    <br/><?php endforeach; endif; unset($_from); ?></td>
                <td id="excludedIps" class="editableSite"><?php $_from = $this->_tpl_vars['site']['excluded_ips']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ip']):
?><?php echo $this->_tpl_vars['ip']; ?>
<br/><?php endforeach; endif; unset($_from); ?>
                </td>
                <td id="excludedQueryParameters"
                    class="editableSite"><?php $_from = $this->_tpl_vars['site']['excluded_parameters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['parameter']):
?><?php echo $this->_tpl_vars['parameter']; ?>

                    <br/><?php endforeach; endif; unset($_from); ?>
                </td>
                <td id="excludedUserAgents" class="editableSite"
                    <?php if (! $this->_tpl_vars['allowSiteSpecificUserAgentExclude']): ?>style="display:none"<?php endif; ?>><?php $_from = $this->_tpl_vars['site']['excluded_user_agents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ua']):
?><?php echo $this->_tpl_vars['ua']; ?>

                    <br/><?php endforeach; endif; unset($_from); ?>
                </td>
                <td id="sitesearch" class="editableSite"><?php if ($this->_tpl_vars['site']['sitesearch']): ?><span
                        class='sitesearchActive'><?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span><?php else: ?><span
                        class='sitesearchInactive'>-</span><?php endif; ?><span class='sskp'
                                                                      sitesearch_keyword_parameters="<?php echo ((is_array($_tmp=$this->_tpl_vars['site']['sitesearch_keyword_parameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                                                      sitesearch_category_parameters="<?php echo ((is_array($_tmp=$this->_tpl_vars['site']['sitesearch_category_parameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                                                      id="sitesearch_parameters"></span></td>
                <td id="timezone" class="editableSite"><?php echo $this->_tpl_vars['site']['timezone']; ?>
</td>
                <td id="currency" class="editableSite"><?php echo $this->_tpl_vars['site']['currency']; ?>
</td>
                <td id="ecommerce" class="editableSite"><?php if ($this->_tpl_vars['site']['ecommerce']): ?><span
                        class='ecommerceActive'><?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span><?php else: ?>
                    <span class='ecommerceInactive'>-</span>
                <?php endif; ?></td>
                <td><span id="row<?php echo $this->_tpl_vars['site']['idsite']; ?>
" class='editSite link_but'><img src='themes/default/images/ico_edit.png'
                                                                                title="<?php echo ((is_array($_tmp='General_Edit')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"
                                                                                border="0"/> <?php echo ((is_array($_tmp='General_Edit')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
                </td>
                <td><span id="row<?php echo $this->_tpl_vars['site']['idsite']; ?>
" class="deleteSite link_but"><img
                        src='themes/default/images/ico_delete.png'
                        title="<?php echo ((is_array($_tmp='General_Delete')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"
                        border="0"/> <?php echo ((is_array($_tmp='General_Delete')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span></td>
                <td>
                    <a href='<?php echo smarty_function_url(array('module' => 'CoreAdminHome','action' => 'trackingCodeGenerator','idSite' => $this->_tpl_vars['site']['idsite'],'updated' => false), $this);?>
'><?php echo ((is_array($_tmp='SitesManager_ShowTrackingTag')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
    <?php if ($this->_tpl_vars['isSuperUser']): ?>
        <?php echo $this->_tpl_vars['createNewWebsite']; ?>

    <?php endif; ?>
</div>
<?php endif; ?>


<?php if (! $this->_tpl_vars['isSuperUser']): ?>
<input type="hidden" size="15" id="globalSearchKeywordParameters"
       value="<?php echo ((is_array($_tmp=$this->_tpl_vars['globalSearchKeywordParameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
<input type="hidden" size="15" id="globalSearchCategoryParameters"
       value="<?php echo ((is_array($_tmp=$this->_tpl_vars['globalSearchCategoryParameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
<?php endif; ?>

<?php if ($this->_tpl_vars['isSuperUser']): ?>
<br/>
<a name='globalSettings'></a>
<h2><?php echo ((is_array($_tmp='SitesManager_GlobalWebsitesSettings')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
<br/>
<table style='width:600px' class="adminTable">

    <tr>
        <td colspan="2">
            <b><?php echo ((is_array($_tmp='SitesManager_GlobalListExcludedIps')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo ((is_array($_tmp='SitesManager_ListOfIpsToBeExcludedOnAllWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </p>
        </td>
    </tr>
    <tr>
        <td>
            <textarea cols="30" rows="3" id="globalExcludedIps"><?php echo $this->_tpl_vars['globalExcludedIps']; ?>

            </textarea>
        </td>
        <td>
            <label for="globalExcludedIps"><?php echo $this->_tpl_vars['excludedIpHelp']; ?>
</label>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <b><?php echo ((is_array($_tmp='SitesManager_GlobalListExcludedQueryParameters')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo ((is_array($_tmp='SitesManager_ListOfQueryParametersToBeExcludedOnAllWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </p>
        </td>
    </tr>

    <tr>
        <td>
            <textarea cols="30" rows="3" id="globalExcludedQueryParameters"><?php echo $this->_tpl_vars['globalExcludedQueryParameters']; ?>

            </textarea>
        </td>
        <td><label for="globalExcludedQueryParameters"><?php echo $this->_tpl_vars['excludedQueryParametersHelp']; ?>
</label>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <b><?php echo ((is_array($_tmp='SitesManager_GlobalListExcludedUserAgents')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo ((is_array($_tmp='SitesManager_GlobalListExcludedUserAgents_Desc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</p>
        </td>
    </tr>

    <tr>
        <td>
            <textarea cols="30" rows="3" id="globalExcludedUserAgents"><?php echo $this->_tpl_vars['globalExcludedUserAgents']; ?>
</textarea>
        </td>
        <td><label for="globalExcludedUserAgents"><?php echo $this->_tpl_vars['excludedUserAgentsHelp']; ?>
</label>
        </td>
    </tr>

    <tr>
        <td>
            <input type="checkbox" id="enableSiteUserAgentExclude" name="enableSiteUserAgentExclude"
                   <?php if ($this->_tpl_vars['allowSiteSpecificUserAgentExclude']): ?>checked="checked"<?php endif; ?>/><label
                for="enableSiteUserAgentExclude"><?php echo ((is_array($_tmp='SitesManager_EnableSiteSpecificUserAgentExclude')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
                <span id='enableSiteUserAgentExclude-loading' class='loadingPiwik' style='display:none'><img
                        src='./themes/default/images/loading-blue.gif'/></span>
        </td>
        <td><?php echo ((is_array($_tmp=((is_array($_tmp='SitesManager_EnableSiteSpecificUserAgentExclude_Help')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="#editSites">', '</a>') : smarty_modifier_translate($_tmp, '<a href="#editSites">', '</a>')))) ? $this->_run_mod_handler('inlineHelp', true, $_tmp) : smarty_modifier_inlineHelp($_tmp)); ?>

        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong><?php echo ((is_array($_tmp='SitesManager_KeepURLFragments')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong>

            <p><?php echo ((is_array($_tmp='SitesManager_KeepURLFragmentsHelp')) ? $this->_run_mod_handler('translate', true, $_tmp, "<em>#</em>", "<em>example.org/index.html#first_section</em>", "<em>example.org/index.html</em>") : smarty_modifier_translate($_tmp, "<em>#</em>", "<em>example.org/index.html#first_section</em>", "<em>example.org/index.html</em>")); ?>

            </p>
            <input type="checkbox" id="globalKeepURLFragments" name="globalKeepURLFragments"
                   <?php if ($this->_tpl_vars['globalKeepURLFragments']): ?>checked="checked"<?php endif; ?>/>
            <label for="globalKeepURLFragments"><?php echo ((is_array($_tmp='SitesManager_KeepURLFragmentsLong')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

            <p><?php echo ((is_array($_tmp='SitesManager_KeepURLFragmentsHelp2')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</p>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <a name='globalSiteSearch'></a><b><?php echo ((is_array($_tmp='SitesManager_TrackingSiteSearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo $this->_tpl_vars['sitesearchIntro']; ?>
</p>
                <span class="form-description"
                      style='font-size:8pt'><?php echo ((is_array($_tmp='SitesManager_SearchParametersNote')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='SitesManager_SearchParametersNote2')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <label><?php echo $this->_tpl_vars['searchKeywordLabel']; ?>
 &nbsp;<input type="text" size="15" id="globalSearchKeywordParameters"
                                                      value="<?php echo ((is_array($_tmp=$this->_tpl_vars['globalSearchKeywordParameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>

                <div style='width: 200px;float:right;'><?php echo $this->_tpl_vars['searchKeywordHelp']; ?>
</div>
            </label>
        </td>
    </tr>

<tr>
<td colspan="2">
    <?php if (! $this->_tpl_vars['isSearchCategoryTrackingEnabled']): ?>
        <input value='globalSearchCategoryParametersIsDisabled' id="globalSearchCategoryParameters" type='hidden'/>
        <span class='form-description'>Note: you could also track your Internal Search Engine Categories, but the plugin Custom Variables is required. Please enable the plugin CustomVariables (or ask your Piwik admin).</span>
        <?php else: ?>
        <?php echo ((is_array($_tmp='Goals_Optional')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='SitesManager_SearchCategoryDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <br/>
    </td>
    </tr>
    <tr>
    <td colspan="2">
        <label><?php echo $this->_tpl_vars['searchCategoryLabel']; ?>
  &nbsp;<input type="text" size="15" id="globalSearchCategoryParameters"
                                                    value="<?php echo ((is_array($_tmp=$this->_tpl_vars['globalSearchCategoryParameters'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>

            <div style='width: 200px;float:right;'><?php echo $this->_tpl_vars['searchCategoryHelp']; ?>
</div>
        </label>
    <?php endif; ?>
</td>
</tr>

    <tr>
        <td colspan="2">
            <b><?php echo ((is_array($_tmp='SitesManager_DefaultTimezoneForNewWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo ((is_array($_tmp='SitesManager_SelectDefaultTimezone')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </p>
        </td>
    </tr>
    <tr>
        <td>
            <div id='defaultTimezone'></div>
        </td>
        <td>
            <?php echo $this->_tpl_vars['defaultTimezoneHelp']; ?>

        </td>
    </tr>

    <tr>
        <td colspan="2">
            <b><?php echo ((is_array($_tmp='SitesManager_DefaultCurrencyForNewWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</b>

            <p><?php echo ((is_array($_tmp='SitesManager_SelectDefaultCurrency')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </p>
        </td>
    </tr>
    <tr>
        <td>
            <div id='defaultCurrency'></div>
        </td>
        <td>
            <?php echo $this->_tpl_vars['currencyHelpPlain']; ?>

        </td>
    </tr>
</table>
<span style="margin-left:20px">
    <input type="submit" class="submit" id='globalSettingsSubmit' value="<?php echo ((is_array($_tmp='General_Save')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
</span>
    <?php echo smarty_function_ajaxErrorDiv(array('id' => 'ajaxErrorGlobalSettings'), $this);?>

    <?php echo smarty_function_ajaxLoadingDiv(array('id' => 'ajaxLoadingGlobalSettings'), $this);?>

<?php endif; ?>
<?php if ($this->_tpl_vars['showAddSite']): ?>
<script type="text/javascript"><?php echo '
$(document).ready(function () {
    $(\'.addRowSite:first\').trigger(\'click\');
});
'; ?>
</script>
<?php endif; ?>

<br/><br/><br/><br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>