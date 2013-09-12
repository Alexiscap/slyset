<?php /* Smarty version 2.6.26, created on 2013-09-10 09:04:39
         compiled from Live/templates/visitorLog.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'Live/templates/visitorLog.tpl', 1, false),array('modifier', 'escape', 'Live/templates/visitorLog.tpl', 1, false),array('modifier', 'translate', 'Live/templates/visitorLog.tpl', 4, false),array('modifier', 'capitalize', 'Live/templates/visitorLog.tpl', 90, false),array('modifier', 'truncate', 'Live/templates/visitorLog.tpl', 124, false),array('modifier', 'count', 'Live/templates/visitorLog.tpl', 177, false),array('modifier', 'trim', 'Live/templates/visitorLog.tpl', 203, false),array('modifier', 'money', 'Live/templates/visitorLog.tpl', 225, false),array('modifier', 'unescape', 'Live/templates/visitorLog.tpl', 255, false),array('modifier', 'urldecode', 'Live/templates/visitorLog.tpl', 255, false),array('function', 'cycle', 'Live/templates/visitorLog.tpl', 97, false),)), $this); ?>
<div class="visitorLog dataTable" data-report="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
" data-params="<?php echo ((is_array($_tmp=json_encode($this->_tpl_vars['javascriptVariablesToSet']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">

<?php if (! $this->_tpl_vars['isWidget']): ?>
    <h2><?php if ($this->_tpl_vars['javascriptVariablesToSet']['filterEcommerce']): ?><?php echo ((is_array($_tmp='Goals_EcommerceLog')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='Live_VisitorLog')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php endif; ?></h2>
    <?php if (! empty ( $this->_tpl_vars['reportDocumentation'] )): ?>
        <div class="reportDocumentation"><p><?php echo $this->_tpl_vars['reportDocumentation']; ?>
</p></div>
    <?php endif; ?>
<?php endif; ?>
<?php ob_start(); ?><?php if ($this->_tpl_vars['isWidget']): ?>0<?php else: ?>1<?php endif; ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('displayVisitorsInOwnColumn', ob_get_contents());ob_end_clean(); ?>

<a graphid="VisitsSummarygetEvolutionGraph" name="evolutionGraph"></a>

<?php if (isset ( $this->_tpl_vars['arrayDataTable']['result'] ) && $this->_tpl_vars['arrayDataTable']['result'] == 'error'): ?>
    <?php echo $this->_tpl_vars['arrayDataTable']['message']; ?>

<?php else: ?>
<?php if (count ( $this->_tpl_vars['arrayDataTable'] ) == 0): ?>
    <a name="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
"></a>
    <div class="pk-emptyDataTable"><?php echo ((is_array($_tmp='CoreHome_ThereIsNoDataForThisReport')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
<?php else: ?>
    <a name="<?php echo $this->_tpl_vars['properties']['uniqueId']; ?>
"></a>
    <table class="dataTable" cellspacing="0" width="100%" style="width:100%;">
    <thead>
    <tr>
        <th style="display:none"></th>
        <th id="label" class="sortable label" style="cursor: auto;width:12%" width="12%">
            <div id="thDIV"><?php echo ((is_array($_tmp='General_Date')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                <div>
        </th>
        <?php if ($this->_tpl_vars['displayVisitorsInOwnColumn']): ?>
            <th id="label" class="sortable label" style="cursor: auto;width:13%" width="13%">
                <div id="thDIV"><?php echo ((is_array($_tmp='General_Visitors')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                    <div>
            </th>
        <?php endif; ?>
        <th id="label" class="sortable label" style="cursor: auto;width:15%" width="15%">
            <div id="thDIV"><?php echo ((is_array($_tmp='Live_Referrer_URL')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                <div>
        </th>
        <th id="label" class="sortable label" style="cursor: auto;width:62%" width="62%">
            <div id="thDIV"><?php echo ((is_array($_tmp='General_ColumnNbActions')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                <div>
        </th>
    </tr>
    </thead>
    <tbody>

    <?php $_from = $this->_tpl_vars['arrayDataTable']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['visitor']):
?>

        <?php ob_start(); ?>
            &nbsp;
            <img src="<?php echo $this->_tpl_vars['visitor']['columns']['countryFlag']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['location'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
, Provider <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['providerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            &nbsp;
            <?php if ($this->_tpl_vars['visitor']['columns']['plugins']): ?>
            <img src="<?php echo $this->_tpl_vars['visitor']['columns']['browserIcon']; ?>
" title="<?php echo ((is_array($_tmp='UserSettings_BrowserWithPluginsEnabled')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['visitor']['columns']['browserName'], $this->_tpl_vars['visitor']['columns']['plugins']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['visitor']['columns']['browserName'], $this->_tpl_vars['visitor']['columns']['plugins'])); ?>
"/>
            <?php else: ?>
            <img src="<?php echo $this->_tpl_vars['visitor']['columns']['browserIcon']; ?>
" title="<?php echo ((is_array($_tmp='UserSettings_BrowserWithNoPluginsEnabled')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['visitor']['columns']['browserName']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['visitor']['columns']['browserName'])); ?>
"/>
            <?php endif; ?>
            &nbsp;
            <img src="<?php echo $this->_tpl_vars['visitor']['columns']['operatingSystemIcon']; ?>
"
                 title="<?php echo $this->_tpl_vars['visitor']['columns']['operatingSystem']; ?>
, <?php echo $this->_tpl_vars['visitor']['columns']['resolution']; ?>
 (<?php echo $this->_tpl_vars['visitor']['columns']['screenType']; ?>
)"/>
            <?php if ($this->_tpl_vars['visitor']['columns']['visitorTypeIcon']): ?>
                <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['visitorId'] )): ?>
                    <a class="rightLink" href="javascript:Piwik_Live_LoadVisitorPopover('<?php echo $this->_tpl_vars['visitor']['columns']['visitorId']; ?>
')">
                <?php endif; ?>
                &nbsp;-
                <img src="<?php echo $this->_tpl_vars['visitor']['columns']['visitorTypeIcon']; ?>
"
                     title="<?php echo ((is_array($_tmp='General_ReturningVisitor')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php if (! empty ( $this->_tpl_vars['visitor']['columns']['visitorId'] )): ?> - <?php echo ((is_array($_tmp='General_ReturningVisitorAllVisits')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php endif; ?>"/>
                <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['visitorId'] )): ?></a><?php endif; ?>
            <?php endif; ?>

            <?php if (! $this->_tpl_vars['displayVisitorsInOwnColumn']): ?><br/><br/><?php endif; ?>

            &nbsp;<?php if ($this->_tpl_vars['visitor']['columns']['visitConverted']): ?>
        <span title="<?php echo ((is_array($_tmp='General_VisitConvertedNGoals')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['visitor']['columns']['goalConversions']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['visitor']['columns']['goalConversions'])); ?>
" class='visitorRank'
              <?php if (! $this->_tpl_vars['displayVisitorsInOwnColumn']): ?>style='margin-left:0'<?php endif; ?>>
            <img src="<?php echo $this->_tpl_vars['visitor']['columns']['visitConvertedIcon']; ?>
"/>
            <span class='hash'>#</span>
            <?php echo $this->_tpl_vars['visitor']['columns']['goalConversions']; ?>

            <?php if ($this->_tpl_vars['visitor']['columns']['visitEcommerceStatusIcon']): ?>
                &nbsp;-
                <img src="<?php echo $this->_tpl_vars['visitor']['columns']['visitEcommerceStatusIcon']; ?>
" title="<?php echo $this->_tpl_vars['visitor']['columns']['visitEcommerceStatus']; ?>
"/>
            <?php endif; ?>
            </span><?php endif; ?>
            <br/>
            <?php if ($this->_tpl_vars['displayVisitorsInOwnColumn']): ?>
                <?php if (count ( $this->_tpl_vars['visitor']['columns']['pluginsIcons'] ) > 0): ?>
                    <hr/>
                    <?php echo ((is_array($_tmp='UserSettings_Plugins')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                    <?php $_from = $this->_tpl_vars['visitor']['columns']['pluginsIcons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['plugins'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['plugins']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pluginIcon']):
        $this->_foreach['plugins']['iteration']++;
?>
                        <img src="<?php echo $this->_tpl_vars['pluginIcon']['pluginIcon']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['pluginIcon']['pluginName'])) ? $this->_run_mod_handler('capitalize', true, $_tmp, true) : smarty_modifier_capitalize($_tmp, true)); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['pluginIcon']['pluginName'])) ? $this->_run_mod_handler('capitalize', true, $_tmp, true) : smarty_modifier_capitalize($_tmp, true)); ?>
"/>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('visitorColumnContent', ob_get_contents());ob_end_clean(); ?>

        <?php ob_start(); ?>
            <tr class="label<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
                <td style="display:none;"></td>
                <td class="label" style="width:12%" width="12%">
                    <strong title="<?php if ($this->_tpl_vars['visitor']['columns']['visitorType'] == 'new'): ?><?php echo ((is_array($_tmp='General_NewVisitor')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp='Live_VisitorsLastVisit')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['visitor']['columns']['daysSinceLastVisit']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['visitor']['columns']['daysSinceLastVisit'])); ?>
<?php endif; ?>">
                        <?php echo $this->_tpl_vars['visitor']['columns']['serverDatePrettyFirstAction']; ?>

                        <?php if ($this->_tpl_vars['isWidget']): ?><br/><?php else: ?>-<?php endif; ?> <?php echo $this->_tpl_vars['visitor']['columns']['serverTimePrettyFirstAction']; ?>
</strong>
                    <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['visitIp'] )): ?>
                        <br/>
                    <span title="<?php if (! empty ( $this->_tpl_vars['visitor']['columns']['visitorId'] )): ?><?php echo ((is_array($_tmp='General_VisitorID')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo $this->_tpl_vars['visitor']['columns']['visitorId']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['visitor']['columns']['latitude'] || $this->_tpl_vars['visitor']['columns']['longitude']): ?>

			GPS (lat/long): <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['latitude'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
,<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['longitude'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>">
                        IP: <?php echo $this->_tpl_vars['visitor']['columns']['visitIp']; ?>
</span><?php endif; ?>

                    <?php if (( isset ( $this->_tpl_vars['visitor']['columns']['providerName'] ) && $this->_tpl_vars['visitor']['columns']['providerName'] != 'IP' )): ?>
                        <br/>
                        <?php echo ((is_array($_tmp='Provider_ColumnProvider')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                        <a href="<?php echo $this->_tpl_vars['visitor']['columns']['providerUrl']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['visitor']['columns']['providerUrl']; ?>
" style="text-decoration:underline;">
                            <?php echo $this->_tpl_vars['visitor']['columns']['providerName']; ?>

                        </a>
                    <?php endif; ?>
                    <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['customVariables'] )): ?>
                        <br/>
                        <?php $_from = $this->_tpl_vars['visitor']['columns']['customVariables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['customVariable']):
?>
                            <?php ob_start(); ?>customVariableName<?php echo $this->_tpl_vars['id']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('name', ob_get_contents());ob_end_clean(); ?>
                            <?php ob_start(); ?>customVariableValue<?php echo $this->_tpl_vars['id']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('value', ob_get_contents());ob_end_clean(); ?>
                            <br/>
                            <acronym
                            title="<?php echo ((is_array($_tmp='CustomVariables_CustomVariables')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 (index <?php echo $this->_tpl_vars['id']; ?>
)"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customVariable'][$this->_tpl_vars['name']])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</acronym><?php if (strlen ( $this->_tpl_vars['customVariable'][$this->_tpl_vars['value']] ) > 0): ?>: <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customVariable'][$this->_tpl_vars['value']])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...", true) : smarty_modifier_truncate($_tmp, 50, "...", true)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    <?php endif; ?>
                    <?php if (! $this->_tpl_vars['displayVisitorsInOwnColumn']): ?>
                        <br/>
                        <?php echo $this->_tpl_vars['visitorColumnContent']; ?>

                    <?php endif; ?>
                </td>

                <?php if ($this->_tpl_vars['displayVisitorsInOwnColumn']): ?>
                    <td class="label" style="width:13%" width="13%">
                        <?php echo $this->_tpl_vars['visitorColumnContent']; ?>

                    </td>
                <?php endif; ?>

                <td class="column" style="width:20%" width="20%">
                    <div class="referer">
                        <?php if ($this->_tpl_vars['visitor']['columns']['referrerType'] == 'website'): ?>
                            <?php echo ((is_array($_tmp='Referers_ColumnWebsite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" target="_blank" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                               style="text-decoration:underline;">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                            </a>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['visitor']['columns']['referrerType'] == 'campaign'): ?>
                            <?php echo ((is_array($_tmp='Referers_ColumnCampaign')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                            <br/>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                            <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['referrerKeyword'] )): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerKeyword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['visitor']['columns']['referrerType'] == 'search'): ?>
                            <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['searchEngineIcon'] )): ?>
                                <img src="<?php echo $this->_tpl_vars['visitor']['columns']['searchEngineIcon']; ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
                            <?php endif; ?>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                            <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['referrerKeyword'] )): ?><?php echo ((is_array($_tmp='Referers_Keywords')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                                <br/>
                                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" target="_blank" style="text-decoration:underline;">
                                    "<?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerKeyword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"</a>
                            <?php endif; ?>
                            <?php ob_start(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerKeyword'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('keyword', ob_get_contents());ob_end_clean(); ?>
                            <?php ob_start(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['visitor']['columns']['referrerName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('searchName', ob_get_contents());ob_end_clean(); ?>
                            <?php ob_start(); ?>#<?php echo $this->_tpl_vars['visitor']['columns']['referrerKeywordPosition']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('position', ob_get_contents());ob_end_clean(); ?>
                            <?php if (! empty ( $this->_tpl_vars['visitor']['columns']['referrerKeywordPosition'] )): ?><span
                                title='<?php echo ((is_array($_tmp='Live_KeywordRankedOnSearchResultForThisVisitor')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['keyword'], $this->_tpl_vars['position'], $this->_tpl_vars['searchName']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['keyword'], $this->_tpl_vars['position'], $this->_tpl_vars['searchName'])); ?>
' class='visitorRank'>
                                <span class='hash'>#</span>
                                <?php echo $this->_tpl_vars['visitor']['columns']['referrerKeywordPosition']; ?>
</span><?php endif; ?>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['visitor']['columns']['referrerType'] == 'direct'): ?><?php echo ((is_array($_tmp='Referers_DirectEntry')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php endif; ?>
                    </div>
                </td>
                <td class="column <?php if ($this->_tpl_vars['visitor']['columns']['visitConverted'] && ! $this->_tpl_vars['isWidget']): ?>highlightField<?php endif; ?>" style="width:55%" width="55%">
                    <strong>
                        <?php echo count($this->_tpl_vars['visitor']['columns']['actionDetails']); ?>

                        <?php if (count($this->_tpl_vars['visitor']['columns']['actionDetails']) <= 1): ?>
                            <?php echo ((is_array($_tmp='Live_Action')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        <?php else: ?>
                            <?php echo ((is_array($_tmp='Live_Actions')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['visitor']['columns']['visitDuration'] > 0): ?>- <?php echo $this->_tpl_vars['visitor']['columns']['visitDurationPretty']; ?>
<?php endif; ?>
                    </strong>
                    <br/>
                    <ol class='visitorLog'>
                        <?php ob_start(); ?>0<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('visitorHasSomeEcommerceActivity', ob_get_contents());ob_end_clean(); ?>
                        <?php $_from = $this->_tpl_vars['visitor']['columns']['actionDetails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['action']):
?>
                            <?php ob_start(); ?><?php if (! empty ( $this->_tpl_vars['action']['customVariables'] )): ?><?php echo ((is_array($_tmp='CustomVariables_CustomVariables')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                                <?php $_from = $this->_tpl_vars['action']['customVariables']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['customVariable']):
?><?php ob_start(); ?>customVariablePageName<?php echo $this->_tpl_vars['id']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('name', ob_get_contents());ob_end_clean(); ?><?php ob_start(); ?>customVariablePageValue<?php echo $this->_tpl_vars['id']; ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('value', ob_get_contents());ob_end_clean(); ?>

                                    - <?php echo ((is_array($_tmp=$this->_tpl_vars['customVariable'][$this->_tpl_vars['name']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
 <?php if (strlen ( $this->_tpl_vars['customVariable'][$this->_tpl_vars['value']] ) > 0): ?> = <?php echo ((is_array($_tmp=$this->_tpl_vars['customVariable'][$this->_tpl_vars['value']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?><?php endif; ?>
                            <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('customVariablesTooltip', ob_get_contents());ob_end_clean(); ?>
                            <?php if (! $this->_tpl_vars['javascriptVariablesToSet']['filterEcommerce'] || $this->_tpl_vars['action']['type'] == 'ecommerceOrder' || $this->_tpl_vars['action']['type'] == 'ecommerceAbandonedCart'): ?>
                                <li class="<?php if (! empty ( $this->_tpl_vars['action']['goalName'] )): ?>goal<?php else: ?>action<?php endif; ?>"
                                    title="<?php echo ((is_array($_tmp=$this->_tpl_vars['action']['serverTimePretty'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php if (! empty ( $this->_tpl_vars['action']['url'] ) && strlen ( trim ( $this->_tpl_vars['action']['url'] ) )): ?>
                                    
<?php echo ((is_array($_tmp=$this->_tpl_vars['action']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?> <?php if (strlen ( trim ( $this->_tpl_vars['customVariablesTooltip'] ) )): ?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['customVariablesTooltip'])) ? $this->_run_mod_handler('trim', true, $_tmp) : trim($_tmp)); ?>
<?php endif; ?><?php if (isset ( $this->_tpl_vars['action']['timeSpentPretty'] )): ?>

<?php echo ((is_array($_tmp='General_TimeOnPage')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo $this->_tpl_vars['action']['timeSpentPretty']; ?>
<?php endif; ?><?php if (isset ( $this->_tpl_vars['action']['generationTime'] )): ?>

<?php echo ((is_array($_tmp='General_ColumnGenerationTime')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo $this->_tpl_vars['action']['generationTime']; ?>
<?php endif; ?>">
                                    <?php if ($this->_tpl_vars['action']['type'] == 'ecommerceOrder' || $this->_tpl_vars['action']['type'] == 'ecommerceAbandonedCart'): ?>
                                                                            <img src="<?php echo $this->_tpl_vars['action']['icon']; ?>
"/>
                                        <?php if ($this->_tpl_vars['action']['type'] == 'ecommerceOrder'): ?>
                                            <?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('visitorHasSomeEcommerceActivity', ob_get_contents());ob_end_clean(); ?>
                                            <strong><?php echo ((is_array($_tmp='Goals_EcommerceOrder')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong>
                                            <span style='color:#666666'>(<?php echo $this->_tpl_vars['action']['orderId']; ?>
)</span>
                                        <?php else: ?><strong><?php echo ((is_array($_tmp='Goals_AbandonedCart')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong>

                                                                                    <?php if ($this->_tpl_vars['javascriptVariablesToSet']['filterEcommerce'] == 2): ?><?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('visitorHasSomeEcommerceActivity', ob_get_contents());ob_end_clean(); ?><?php endif; ?>

                                        <?php endif; ?>
                                        <br/>
                                        <span <?php if (! $this->_tpl_vars['isWidget']): ?>style='margin-left:20px'<?php endif; ?>>
					<?php if ($this->_tpl_vars['action']['type'] == 'ecommerceOrder'): ?>
                                            <abbr title="
						<?php echo ((is_array($_tmp='Live_GoalRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenue'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
 
						<?php if (! empty ( $this->_tpl_vars['action']['revenueSubTotal'] )): ?> - <?php echo ((is_array($_tmp='General_Subtotal')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenueSubTotal'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
<?php endif; ?> 
						<?php if (! empty ( $this->_tpl_vars['action']['revenueTax'] )): ?> - <?php echo ((is_array($_tmp='General_Tax')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenueTax'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
<?php endif; ?> 
						<?php if (! empty ( $this->_tpl_vars['action']['revenueShipping'] )): ?> - <?php echo ((is_array($_tmp='General_Shipping')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenueShipping'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
<?php endif; ?> 
						<?php if (! empty ( $this->_tpl_vars['action']['revenueDiscount'] )): ?> - <?php echo ((is_array($_tmp='General_Discount')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenueDiscount'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
<?php endif; ?> 
						"><?php echo ((is_array($_tmp='Live_GoalRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                                                <?php else: ?>
                                                <?php ob_start(); ?><?php echo ((is_array($_tmp='Live_GoalRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('revenueLeft', ob_get_contents());ob_end_clean(); ?><?php echo ((is_array($_tmp='Goals_LeftInCart')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['revenueLeft']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['revenueLeft'])); ?>

                                                :
                                                <?php endif; ?>
                                                <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenue'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
</strong><?php if ($this->_tpl_vars['action']['type'] == 'ecommerceOrder'): ?>
                                            </abbr><?php endif; ?>,
                                            <?php echo ((is_array($_tmp='General_Quantity')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo $this->_tpl_vars['action']['items']; ?>


                                                                                        <?php if (! empty ( $this->_tpl_vars['action']['itemDetails'] )): ?>
                                                <ul style='list-style:square;margin-left:<?php if ($this->_tpl_vars['isWidget']): ?>15<?php else: ?>50<?php endif; ?>px'>
                                                    <?php $_from = $this->_tpl_vars['action']['itemDetails']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                                                        <li><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['itemSKU'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php if (! empty ( $this->_tpl_vars['product']['itemName'] )): ?>: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['itemName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?><?php if (! empty ( $this->_tpl_vars['product']['itemCategory'] )): ?> (<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['itemCategory'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)<?php endif; ?>
                                                            ,
                                                            <?php echo ((is_array($_tmp='General_Quantity')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo $this->_tpl_vars['product']['quantity']; ?>
,
                                                            <?php echo ((is_array($_tmp='General_Price')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['price'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>

                                                        </li>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </ul>
                                            <?php endif; ?>
					</span>
                                    <?php elseif (empty ( $this->_tpl_vars['action']['goalName'] )): ?>
                                                                            <?php if (! empty ( $this->_tpl_vars['action']['pageTitle'] )): ?>
                                            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action']['pageTitle'])) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)))) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...", true) : smarty_modifier_truncate($_tmp, 80, "...", true)); ?>

                                        <?php endif; ?>
                                        <?php if (! empty ( $this->_tpl_vars['action']['siteSearchKeyword'] )): ?>
                                            <?php if ($this->_tpl_vars['action']['type'] == 'search'): ?><img src='<?php echo $this->_tpl_vars['action']['icon']; ?>
'
                                                                              title='<?php echo ((is_array($_tmp=((is_array($_tmp='Actions_SubmenuSitesearch')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
'><?php endif; ?>
                                            <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action']['siteSearchKeyword'])) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)))) ? $this->_run_mod_handler('urldecode', true, $_tmp) : urldecode($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...", true) : smarty_modifier_truncate($_tmp, 80, "...", true)); ?>

                                        <?php endif; ?>
                                        <?php if (! empty ( $this->_tpl_vars['action']['url'] )): ?>
                                            <?php if ($this->_tpl_vars['action']['type'] == 'action' && ! empty ( $this->_tpl_vars['action']['pageTitle'] )): ?><br/><?php endif; ?>
                                            <?php if ($this->_tpl_vars['action']['type'] == 'download' || $this->_tpl_vars['action']['type'] == 'outlink'): ?>
                                                <img src='<?php echo $this->_tpl_vars['action']['icon']; ?>
'>
                                            <?php endif; ?>
                                            <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['action']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" target="_blank"
                                               style="<?php if ($this->_tpl_vars['action']['type'] == 'action' && ! empty ( $this->_tpl_vars['action']['pageTitle'] )): ?>margin-left: 25px;<?php endif; ?>text-decoration:underline;"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "...", true) : smarty_modifier_truncate($_tmp, 80, "...", true)); ?>
</a>
                                        <?php elseif ($this->_tpl_vars['action']['type'] != 'search'): ?>
                                            <br/>
                                            <span style="margin-left: 25px;"><?php echo $this->_tpl_vars['javascriptVariablesToSet']['pageUrlNotDefined']; ?>
</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                                                            <img src="<?php echo $this->_tpl_vars['action']['icon']; ?>
"/>
                                        <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['action']['goalName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</strong>
                                        <?php if ($this->_tpl_vars['action']['revenue'] > 0): ?>, <?php echo ((is_array($_tmp='Live_GoalRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
:
                                            <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['action']['revenue'])) ? $this->_run_mod_handler('money', true, $_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite']) : smarty_modifier_money($_tmp, $this->_tpl_vars['javascriptVariablesToSet']['idSite'])); ?>
</strong><?php endif; ?>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </ol>
                </td>
            </tr>
        <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('visitorRow', ob_get_contents());ob_end_clean(); ?>

        <?php if (! $this->_tpl_vars['javascriptVariablesToSet']['filterEcommerce'] || ! empty ( $this->_tpl_vars['visitorHasSomeEcommerceActivity'] )): ?>
            <?php echo $this->_tpl_vars['visitorRow']; ?>

        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>

    </tbody>
    </table>
<?php endif; ?>

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
    <script type="text/javascript" defer="defer">

        var visitorLogTitle = '<?php echo ((is_array($_tmp=((is_array($_tmp='Live_VisitorLog')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
';
        function Piwik_Live_LoadVisitorPopover(visitorId) {
            var startingDate = piwik.minDateYear + '-01-01';
            var url = 'module=Live&action=getVisitorLog&period=range&date=' + startingDate + ',today&show_footer=0&segment=visitorId' + encodeURIComponent('==') + visitorId;
            return Piwik_Popover.createPopupAndLoadUrl(url, visitorLogTitle);
            }

        $(document).ready(function () {
            <?php echo '
            // Replace duplicated page views by a NX count instead of using too much vertical space
            $("ol.visitorLog").each(function () {
                var prevelement;
                var prevhtml;
                var counter = 0;
                $(this).find("li").each(function () {
                    counter++;
                    $(this).val(counter);
                    var current = $(this).html();
                    if (current == prevhtml) {
                        var repeat = prevelement.find(".repeat")
                        if (repeat.length) {
                            repeat.html((parseInt(repeat.html()) + 1) + "x");
                        } else {
                            prevelement.append($("<em title=\''; ?>
<?php echo ((is_array($_tmp=((is_array($_tmp='Live_PageRefreshed')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'js') : smarty_modifier_escape($_tmp, 'js')); ?>
<?php echo '\' class=\'repeat\'>2x</em>"));
                        }
                        $(this).hide();
                    } else {
                        prevhtml = current;
                        prevelement = $(this);
                    }
                    
                    $(this).tooltip({
                        track: true,
                        show: false,
                        hide: false,
                        content: function() {
                            var title = $(this).attr(\'title\');
                            return $(\'<a>\').text( title ).html().replace(/\\n/g, \'<br />\');
                        },
                        tooltipClass: \'small\'
                    });
                });
            });
        });
        '; ?>

    </script>
<?php endif; ?>

</div>