<?php /* Smarty version 2.6.26, created on 2013-09-10 09:04:38
         compiled from UserCountryMap/templates/realtime-map.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'UserCountryMap/templates/realtime-map.tpl', 6, false),array('modifier', 'escape', 'UserCountryMap/templates/realtime-map.tpl', 30, false),)), $this); ?>
<div id="RealTimeMap" style="position:relative; overflow:hidden;">

    <div id="RealTimeMap_container">
        <div id="RealTimeMap_map" style="overflow:hidden"></div>
        <div class="realTimeMap_overlay">
            <span class="showing_visits_of" style="display:none"><?php echo ((is_array($_tmp='UserCountryMap_ShowingVisits')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 <span class="realTimeMap_timeSpan"
                                                                                                                  style="font-weight:bold"></span></span>
            <span class="no_data" style="display:none"><?php echo ((is_array($_tmp='CoreHome_ThereIsNoDataForThisReport')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span>
            <span class="loading_data"><?php echo ((is_array($_tmp='General_LoadingData')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
...</span>
            <img src="<?php echo $this->_tpl_vars['piwikUrl']; ?>
plugins/UserCountryMap/img/realtimemap-loading.gif" style="vertical-align:baseline;position:relative;left:-2px;">
        </div>
        <div class="realTimeMap_overlay realTimeMap_datetime"></div>
    </div>
    <div id="RealTimeMap_meta">
        <span class="loadingPiwik">
            <img src="<?php echo $this->_tpl_vars['piwikUrl']; ?>
themes/default/images/loading-blue.gif"> <?php echo ((is_array($_tmp='General_LoadingData')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
...
        </span>
    </div>

</div>

<!-- configure some piwik vars -->
<script type="text/javascript">

        <?php if ($this->_tpl_vars['mapIsStandaloneNotWidget']): ?>
    function initStandaloneMap() {
        $('.top_controls').hide();
        $('ul.nav').on('piwikSwitchPage', function (event, item) {
            var clickedMenuIsNotMap = ($(item).text() != "<?php echo ((is_array($_tmp=((is_array($_tmp='UserCountryMap_RealTimeMap')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'js') : smarty_modifier_escape($_tmp, 'js')); ?>
");
            if (clickedMenuIsNotMap) {
                $('.top_controls').show();
                }
            });
        $('.realTimeMap_overlay').css('top', '0px');
        $('.realTimeMap_datetime').css('top', '20px');
        }

    initStandaloneMap();
    <?php endif; ?>

    <?php echo '
    var config = { metrics: {} };
    '; ?>


    config.svgBasePath = "<?php echo $this->_tpl_vars['piwikUrl']; ?>
plugins/UserCountryMap/svg/";
    config.liveRefreshAfterMs = <?php echo $this->_tpl_vars['liveRefreshAfterMs']; ?>
;

    config._ = JSON.parse('<?php echo ((is_array($_tmp=$this->_tpl_vars['localeJSON'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
');
    config.reqParams = JSON.parse('<?php echo ((is_array($_tmp=$this->_tpl_vars['reqParamsJSON'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
');
    config.siteHasGoals = <?php echo $this->_tpl_vars['hasGoals']; ?>
;
    config.maxVisits = <?php echo $this->_tpl_vars['maxVisits']; ?>
;

    var realtimeMap;

    <?php echo '
    if ($(\'#dashboardWidgetsArea\').length) {
        // dashboard mode
        var $widgetContent = $(\'#RealTimeMap\').parents(\'.widgetContent\');

        $widgetContent.on(\'widget:create\',function (evt, widget) {
            realtimeMap = new UserCountryMap.RealtimeMap(config, widget);
        }).on(\'widget:maximise\',function (evt) {
                    realtimeMap.resize();
                }).on(\'widget:minimise\',function (evt) {
                    realtimeMap.resize();
                }).on(\'widget:destroy\', function (evt) {
                    realtimeMap.destroy();
                });
    } else {
        // stand-alone mode
        realtimeMap = new UserCountryMap.RealtimeMap(config);
    }
    '; ?>


</script>