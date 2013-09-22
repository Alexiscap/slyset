<?php /* Smarty version 2.6.26, created on 2013-09-22 10:36:37
         compiled from SegmentEditor/templates/selector.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'SegmentEditor/templates/selector.tpl', 6, false),array('modifier', 'strtolower', 'SegmentEditor/templates/selector.tpl', 128, false),)), $this); ?>
<div id="SegmentEditor" style="display:none;">
    <div class="segmentationContainer listHtml">
        <span class="segmentationTitle"></span>

        <ul class="submenu">
            <li><?php echo ((is_array($_tmp='SegmentEditor_SelectSegmentOfVisitors')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                <div class="segmentList">
                    <ul>
                    </ul>
                </div>
            </li>
        </ul>
        <?php if ($this->_tpl_vars['authorizedToCreateSegments']): ?>
            <a class="add_new_segment"><?php echo ((is_array($_tmp='SegmentEditor_AddNewSegment')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
        <?php else: ?>
            <ul class="submenu">
            <li> <span class='youMustBeLoggedIn'><?php echo ((is_array($_tmp='SegmentEditor_YouMustBeLoggedInToCreateSegments')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

                <br/>&rsaquo; <a href='index.php?module=<?php echo $this->_tpl_vars['loginModule']; ?>
'><?php echo ((is_array($_tmp='Login_LogIn')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a> </span></strong>
            </li>
            </ul>
        <?php endif; ?>
    </div>

    <div class="initial-state-rows"><div class="segment-add-row initial"><div>
        <span>+ <?php echo ((is_array($_tmp='SegmentEditor_DragDropCondition')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
    </div></div>
    <div class="segment-and"><?php echo ((is_array($_tmp='SegmentEditor_OperatorAND')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
    <div class="segment-add-row initial"><div>
        <span>+ <?php echo ((is_array($_tmp='SegmentEditor_DragDropCondition')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
    </div></div>
    </div>

    <div class="segment-row-inputs">
        <div class="segment-input metricListBlock">
            <select title="<?php echo ((is_array($_tmp='SegmentEditor_ChooseASegment')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" class="metricList">
                <?php $_from = $this->_tpl_vars['segmentsByCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category'] => $this->_tpl_vars['segmentsInCategory']):
?>
                <optgroup label="<?php echo $this->_tpl_vars['category']; ?>
">
                    <?php $_from = $this->_tpl_vars['segmentsInCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['segmentInCategory']):
?>
                        <option data-type="<?php echo $this->_tpl_vars['segmentInCategory']['type']; ?>
" value="<?php echo $this->_tpl_vars['segmentInCategory']['segment']; ?>
"><?php echo $this->_tpl_vars['segmentInCategory']['name']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </optgroup>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </div>
        <div class="segment-input metricMatchBlock">
            <select title="<?php echo ((is_array($_tmp='General_Matches')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
">
                <option value="=="><?php echo ((is_array($_tmp='General_OperationEquals')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value="!="><?php echo ((is_array($_tmp='General_OperationNotEquals')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value="<="><?php echo ((is_array($_tmp='General_OperationAtMost')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value=">="><?php echo ((is_array($_tmp='General_OperationAtLeast')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value="<"><?php echo ((is_array($_tmp='General_OperationLessThan')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value=">"><?php echo ((is_array($_tmp='General_OperationGreaterThan')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value="=@"><?php echo ((is_array($_tmp='General_OperationContains')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                <option value="!@"><?php echo ((is_array($_tmp='General_OperationDoesNotContain')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
            </select>
        </div>
        <div class="segment-input metricValueBlock">
            <input type="text" title="<?php echo ((is_array($_tmp='General_Value')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
">
        </div>
        <div class="clear"></div>
    </div>
    <div class="segment-rows">
        <div class="segment-row">
            <a href="#" class="segment-close"></a>
            <a href="#" class="segment-loading"></a>
        </div>
    </div>
    <div class="segment-or"><?php echo ((is_array($_tmp='SegmentEditor_OperatorOR')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
    <div class="segment-add-or"><div>
            <?php ob_start(); ?><span><?php echo ((is_array($_tmp='SegmentEditor_OperatorOR')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('orCondition', ob_get_contents());ob_end_clean(); ?>
            <a href="#"> + <?php echo ((is_array($_tmp='SegmentEditor_AddANDorORCondition')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['orCondition']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['orCondition'])); ?>
 </a>
        </div>
    </div>
    <div class="segment-and"><?php echo ((is_array($_tmp='SegmentEditor_OperatorAND')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</div>
    <div class="segment-add-row"><div>
            <?php ob_start(); ?><span><?php echo ((is_array($_tmp='SegmentEditor_OperatorAND')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('andCondition', ob_get_contents());ob_end_clean(); ?>
            <a href="#">+ <?php echo ((is_array($_tmp='SegmentEditor_AddANDorORCondition')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_tpl_vars['andCondition']) : smarty_modifier_translate($_tmp, $this->_tpl_vars['andCondition'])); ?>
</a>
        </div>
    </div>
    <div style="position: absolute; z-index:999; width:1040px;" class="segment-element">
        <div class="segment-nav">
            <h4 class="visits"><span id="available_segments"><strong>
                <select id="available_segments_select"></select>
            </strong></span></h4>
            <div class="scrollable">
            <ul>
            <?php $_from = $this->_tpl_vars['segmentsByCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category'] => $this->_tpl_vars['segmentsInCategory']):
?>
                <li data="visit"><a class="metric_category" href="#"><?php echo $this->_tpl_vars['category']; ?>
</a>
                    <ul style="display:none">
                        <?php $_from = $this->_tpl_vars['segmentsInCategory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['segmentInCategory']):
?>
                        <li data-metric="<?php echo $this->_tpl_vars['segmentInCategory']['segment']; ?>
"><a class="ddmetric" href="#"><?php echo $this->_tpl_vars['segmentInCategory']['name']; ?>
</a></li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </li>
            <?php endforeach; endif; unset($_from); ?>
            </ul>
            </div>
            <div class="custom_select_search">
                <a href="#"></a>
                <input type="text" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="inp ui-autocomplete-input" id="segmentSearch" value="<?php echo ((is_array($_tmp='General_Search')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" length="15">
            </div>
        </div>
        <div class="segment-content">
            <?php if ($this->_tpl_vars['isSuperUser']): ?>
            <div class="segment-top">
                <?php echo ((is_array($_tmp='SegmentEditor_ThisSegmentIsVisibleTo')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span id="enable_all_users"><strong>
                        <select id="enable_all_users_select">
                            <option selected="1" value="0"><?php echo ((is_array($_tmp='SegmentEditor_VisibleToMe')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                            <option value="1"><?php echo ((is_array($_tmp='SegmentEditor_VisibleToAllUsers')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                        </select>
                    </strong></span>

                <?php echo ((is_array($_tmp='SegmentEditor_SegmentIsDisplayedForWebsite')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
<span id="visible_to_website"><strong>
                        <select id="visible_to_website_select">
                            <option selected="" value="<?php echo $this->_tpl_vars['idSite']; ?>
"><?php echo ((is_array($_tmp='SegmentEditor_SegmentDisplayedThisWebsiteOnly')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                            <option value="0"><?php echo ((is_array($_tmp='SegmentEditor_SegmentDisplayedAllWebsites')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                        </select>
                    </strong></span>
                <?php echo ((is_array($_tmp='General_And')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span id="auto_archive"><strong>
                        <select id="auto_archive_select">
                            <option selected="1" value="0"><?php echo ((is_array($_tmp='SegmentEditor_AutoArchiveRealTime')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <?php echo ((is_array($_tmp='General_DefaultAppended')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</option>
                            <option value="1"><?php echo ((is_array($_tmp='SegmentEditor_AutoArchivePreProcessed')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 </option>
                        </select>
                    </strong></span>

            </div>
            <?php endif; ?>
            <h3><?php echo ((is_array($_tmp='General_Name')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
: <span  class="segmentName"></span> <a class="editSegmentName" href="#"><?php echo ((is_array($_tmp=((is_array($_tmp='General_Edit')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)); ?>
</a></h3>
        </div>
        <div class="segment-footer">
            <span class="segmentFooterNote">The Segment Editor was <a class='crowdfundingLink' href='http://crowdfunding.piwik.org/custom-segments-editor/' target='_blank'>crowdfunded</a> with the awesome support of 80 companies and Piwik users worldwide!</span>
            <a class="delete" href="#"><?php echo ((is_array($_tmp='General_Delete')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
            <a class="close" href="#"><?php echo ((is_array($_tmp='General_Close')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
            <button class="saveAndApply"><?php echo ((is_array($_tmp='SegmentEditor_SaveAndApply')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</button>
        </div>
    </div>
</div>

<span id="segmentEditorPanel">
    <div id="segmentList"></div>
</span>

<div class="ui-confirm" id="confirm">
    <h2><?php echo ((is_array($_tmp='SegmentEditor_AreYouSureDeleteSegment')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
    <input role="yes" type="button" value="<?php echo ((is_array($_tmp='General_Yes')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
    <input role="no" type="button" value="<?php echo ((is_array($_tmp='General_No')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
"/>
</div>

<script type="text/javascript">
var availableSegments = <?php echo $this->_tpl_vars['savedSegmentsJson']; ?>
;
var segmentTranslations = <?php echo $this->_tpl_vars['segmentTranslations']; ?>
;
</script>