<?php /* Smarty version 2.6.26, created on 2013-09-10 09:00:47
         compiled from CoreAdminHome/templates/jsTrackingGenerator.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'CoreAdminHome/templates/jsTrackingGenerator.tpl', 6, false),array('modifier', 'escape', 'CoreAdminHome/templates/jsTrackingGenerator.tpl', 6, false),array('modifier', 'translate', 'CoreAdminHome/templates/jsTrackingGenerator.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link rel="stylesheet" href="plugins/CoreAdminHome/templates/jsTrackingGenerator.css" />
<script type="text/javascript" src="plugins/CoreAdminHome/templates/jsTrackingGenerator.js"></script>

<div id="js-tracking-generator-data"
     data-currencies="<?php echo ((is_array($_tmp=json_encode($this->_tpl_vars['currencySymbols']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>

<h2><?php echo ((is_array($_tmp='CoreAdminHome_JavaScriptTracking')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

<div id="js-code-options" class="adminTable">

    <p>
        <?php echo ((is_array($_tmp='CoreAdminHome_JSTrackingIntro1')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

        <br/><br/>
        <?php echo ((is_array($_tmp='CoreAdminHome_JSTrackingIntro2')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='CoreAdminHome_JSTrackingIntro3')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="http://piwik.org/integrate/" target="_blank">', '</a>') : smarty_modifier_translate($_tmp, '<a href="http://piwik.org/integrate/" target="_blank">', '</a>')); ?>

        <br/><br/>
        <?php echo ((is_array($_tmp='CoreAdminHome_JSTrackingIntro4')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="#image-tracking">', '</a>') : smarty_modifier_translate($_tmp, '<a href="#image-tracking">', '</a>')); ?>

        <br/><br/>
        <?php echo ((is_array($_tmp='CoreAdminHome_JSTrackingIntro5')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a target="_blank" href="http://piwik.org/docs/javascript-tracking/">', '</a>') : smarty_modifier_translate($_tmp, '<a target="_blank" href="http://piwik.org/docs/javascript-tracking/">', '</a>')); ?>

    </p>

    <div>
                <label class="website-label"><strong><?php echo ((is_array($_tmp='General_Website')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></label>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/sites_selection.tpl", 'smarty_include_vars' => array('siteName' => $this->_tpl_vars['defaultReportSiteName'],'idSite' => $this->_tpl_vars['idSite'],'showAllSitesItem' => false,'switchSiteOnSelect' => false,'siteSelectorId' => "js-tracker-website",'showSelectedSite' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <br/><br/><br/>
    </div>

    <table id="optional-js-tracking-options" class="adminTable" style='width:1024px'>
        <tr>
            <th><?php echo ((is_array($_tmp='General_Options')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='Mobile_Advanced')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <a href="#" class="section-toggler-link"
                                                 data-section-id="javascript-advanced-options">(<?php echo ((is_array($_tmp='General_Show_js')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
)</a></th>
        </tr>
        <tr>
            <td>
                                <div class="tracking-option-section">
                    <input type="checkbox" id="javascript-tracking-all-subdomains"/>
                    <label for="javascript-tracking-all-subdomains"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_MergeSubdomains')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span
                                class='current-site-name'><?php echo $this->_tpl_vars['defaultReportSiteName']; ?>
</span></label>

                    <div class="small-form-description">
                        <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_MergeSubdomainsDesc')) ? $this->_run_mod_handler('translate', true, $_tmp, "x.<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>", "y.<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>") : smarty_modifier_translate($_tmp, "x.<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>", "y.<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>")); ?>

                    </div>
                </div>

                                <div class="tracking-option-section">
                    <input type="checkbox" id="javascript-tracking-group-by-domain"/>
                    <label for="javascript-tracking-group-by-domain"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_GroupPageTitlesByDomain')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                    <div class="small-form-description">
                        <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_GroupPageTitlesByDomainDesc1')) ? $this->_run_mod_handler('translate', true, $_tmp, "<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>") : smarty_modifier_translate($_tmp, "<span class='current-site-host'>".($this->_tpl_vars['defaultReportSiteDomain'])."</span>")); ?>

                    </div>
                </div>

                                <div class="tracking-option-section">
                    <input type="checkbox" id="javascript-tracking-all-aliases"/>
                    <label for="javascript-tracking-all-aliases"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_MergeAliases')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span
                                class='current-site-name'><?php echo $this->_tpl_vars['defaultReportSiteName']; ?>
</span></label>

                    <div class="small-form-description">
                        <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_MergeAliasesDesc')) ? $this->_run_mod_handler('translate', true, $_tmp, "<span class='current-site-alias'>".($this->_tpl_vars['defaultReportSiteAlias'])."</span>") : smarty_modifier_translate($_tmp, "<span class='current-site-alias'>".($this->_tpl_vars['defaultReportSiteAlias'])."</span>")); ?>

                    </div>
                </div>

            </td>
            <td>
                <div id="javascript-advanced-options" style="display:none">
                                        <div class="custom-variable tracking-option-section" id="javascript-tracking-visitor-cv">
                        <input class="section-toggler-link" type="checkbox" id="javascript-tracking-visitor-cv-check" data-section-id="js-visitor-cv-extra"/>
                        <label for="javascript-tracking-visitor-cv-check"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_VisitorCustomVars')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                        <div class="small-form-description">
                            <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_VisitorCustomVarsDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        </div>

                        <table style="display:none" id="js-visitor-cv-extra">
                            <tr>
                                <td><strong><?php echo ((is_array($_tmp='General_Name')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="textbox" class="custom-variable-name" placeholder="e.g. Type"/></td>
                                <td><strong><?php echo ((is_array($_tmp='General_Value')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="textbox" class="custom-variable-value" placeholder="e.g. Customer"/></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right">
                                    <a href="#" class="add-custom-variable"><?php echo ((is_array($_tmp='General_Add')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                                        <div class="custom-variable tracking-option-section" id="javascript-tracking-page-cv">
                        <input class="section-toggler-link" type="checkbox" id="javascript-tracking-page-cv-check" data-section-id="js-page-cv-extra"/>
                        <label for="javascript-tracking-page-cv-check"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_PageCustomVars')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                        <div class="small-form-description">
                            <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_PageCustomVarsDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                        </div>

                        <table style="display:none" id="js-page-cv-extra">
                            <tr>
                                <td><strong><?php echo ((is_array($_tmp='General_Name')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="textbox" class="custom-variable-name" placeholder="e.g. Category"/></td>
                                <td><strong><?php echo ((is_array($_tmp='General_Value')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="textbox" class="custom-variable-value" placeholder="e.g. White Papers"/></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right">
                                    <a href="#" class="add-custom-variable"><?php echo ((is_array($_tmp='General_Add')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                                        <div class="tracking-option-section">
                        <input type="checkbox" id="javascript-tracking-do-not-track"/>
                        <label for="javascript-tracking-do-not-track"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_EnableDoNotTrack')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                        <div class="small-form-description">
                            <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_EnableDoNotTrackDesc')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                            <?php if ($this->_tpl_vars['serverSideDoNotTrackEnabled']): ?>
                                <br/>
                                <br/>
                                <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_EnableDoNotTrack_AlreadyEnabled')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                            <?php endif; ?>
                        </div>
                    </div>

                                        <div class="tracking-option-section">
                        <input class="section-toggler-link" type="checkbox" id="custom-campaign-query-params-check"
                               data-section-id="js-campaign-query-param-extra"/>
                        <label for="custom-campaign-query-params-check"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_CustomCampaignQueryParam')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                        <div class="small-form-description">
                            <?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_CustomCampaignQueryParamDesc')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="http://piwik.org/faq/general/#faq_119" target="_blank">', '</a>') : smarty_modifier_translate($_tmp, '<a href="http://piwik.org/faq/general/#faq_119" target="_blank">', '</a>')); ?>

                        </div>

                        <table style="display:none" id="js-campaign-query-param-extra">
                            <tr>
                                <td><strong><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_CampaignNameParam')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="text" id="custom-campaign-name-query-param"/></td>
                            </tr>
                            <tr>
                                <td><strong><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_CampaignKwdParam')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></td>
                                <td><input type="text" id="custom-campaign-keyword-query-param"/></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>

</div>

<div id="javascript-output-section">
    <h3><?php echo ((is_array($_tmp='Installation_JsTag')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h3>

    <p class="form-description"><?php echo ((is_array($_tmp='CoreAdminHome_JSTracking_CodeNote')) ? $this->_run_mod_handler('translate', true, $_tmp, "&lt;/body&gt;") : smarty_modifier_translate($_tmp, "&lt;/body&gt;")); ?>
</p>

    <div id="javascript-text">
        <textarea> </textarea>
    </div>
    <br/>
</div>

<h2 id="image-tracking"><?php echo ((is_array($_tmp='CoreAdminHome_ImageTracking')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

<div id="image-tracking-code-options" class="adminTable">

    <p>
        <?php echo ((is_array($_tmp='CoreAdminHome_ImageTrackingIntro1')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='CoreAdminHome_ImageTrackingIntro2')) ? $this->_run_mod_handler('translate', true, $_tmp, "<em>&lt;noscript&gt;&lt;/noscript&gt;</em>") : smarty_modifier_translate($_tmp, "<em>&lt;noscript&gt;&lt;/noscript&gt;</em>")); ?>

        <br/><br/>
        <?php echo ((is_array($_tmp='CoreAdminHome_ImageTrackingIntro3')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="http://piwik.org/docs/tracking-api/reference/" target="_blank">', '</a>') : smarty_modifier_translate($_tmp, '<a href="http://piwik.org/docs/tracking-api/reference/" target="_blank">', '</a>')); ?>

    </p>

    <div>
                <label class="website-label"><strong><?php echo ((is_array($_tmp='General_Website')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</strong></label>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreHome/templates/sites_selection.tpl", 'smarty_include_vars' => array('siteName' => $this->_tpl_vars['defaultReportSiteName'],'idSite' => $this->_tpl_vars['idSite'],'showAllSitesItem' => false,'switchSiteOnSelect' => false,'showSelectedSite' => true,'siteSelectorId' => "image-tracker-website")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

        <br/><br/><br/>
    </div>

    <table id="image-tracking-section" class="adminTable" style='width:1024px;'>
        <tr>
            <th><?php echo ((is_array($_tmp='General_Options')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</th>
            <th><?php echo ((is_array($_tmp='Mobile_Advanced')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <a href="#" class="section-toggler-link"
                                                 data-section-id="image-tracker-advanced-options">(<?php echo ((is_array($_tmp='General_Show_js')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
)</a></th>
        </tr>
        <tr>
            <td>
                                <div class="tracking-option-section">
                    <label for="image-tracker-action-name"><?php echo ((is_array($_tmp='Actions_ColumnPageName')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>
                    <input type="text" id="image-tracker-action-name"/>
                </div>
            </td>
            <td>
                <div id="image-tracker-advanced-options" style="display:none">
                                        <div class="goal-picker tracking-option-section">
                        <input class="section-toggler-link" type="checkbox" id="image-tracking-goal-check" data-section-id="image-goal-picker-extra"/>
                        <label for="image-tracking-goal-check"><?php echo ((is_array($_tmp='CoreAdminHome_TrackAGoal')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</label>

                        <div style="display:none" id="image-goal-picker-extra">
                            <select id="image-tracker-goal">
                                <option value=""><?php echo ((is_array($_tmp='UserCountryMap_None')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                            </select>
                            <span><?php echo ((is_array($_tmp='CoreAdminHome_WithOptionalRevenue')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
                            <span class="currency"><?php echo ((is_array($_tmp=$this->_tpl_vars['defaultSiteRevenue'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
                            <input type="text" class="revenue" value=""/>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div id="image-link-output-section" width="560px">
        <h3><?php echo ((is_array($_tmp='CoreAdminHome_ImageTrackingLink')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h3><br/><br/>

        <div id="image-tracking-link">
            <textarea> </textarea>
        </div>
        <br/>
    </div>

</div>

<h2><?php echo ((is_array($_tmp='CoreAdminHome_ImportingServerLogs')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>

<p>
    <?php echo ((is_array($_tmp='CoreAdminHome_ImportingServerLogsDesc')) ? $this->_run_mod_handler('translate', true, $_tmp, '<a href="http://piwik.org/log-analytics/" target="_blank">', '</a>') : smarty_modifier_translate($_tmp, '<a href="http://piwik.org/log-analytics/" target="_blank">', '</a>')); ?>

</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreAdminHome/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
