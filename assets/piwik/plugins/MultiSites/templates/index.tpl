{assign var=showSitesSelection value=false}
{if !$isWidgetized}
    {include file="CoreHome/templates/header.tpl"}
{/if}

<div id="multisites">
    <div id="main">
        {include file="MultiSites/templates/row.tpl" assign="row"}
        <script type="text/javascript">
            var allSites = [];
            var params = [];
            {foreach from=$sitesData key=i item=site}
            allSites[{$i}] = new setRowData({$site.idsite}, {$site.visits}, {$site.pageviews}, {if empty($site.revenue)}0{else}{$site.revenue}{/if}, '{$site.name|escape:"javascript"}', '{$site.main_url|escape:"javascript"}', '{if isset($site.visits_evolution)}{$site.visits_evolution|replace:",":"."}{/if}', '{if isset($site.pageviews_evolution)}{$site.pageviews_evolution|replace:",":"."}{/if}', '{if isset($site.revenue_evolution)}{$site.revenue_evolution|replace:",":"."}{/if}');
            {/foreach}
            params['period'] = '{$period}';
            params['date'] = '{$date}';
            params['evolutionBy'] = '{$evolutionBy}';
            params['mOrderBy'] = '{$orderBy}';
            params['order'] = '{$order}';
            params['limit'] = '{$limit}';
            params['page'] = 1;
            params['prev'] = "{'General_Previous'|translate|escape:"javascript"}";
            params['next'] = "{'General_Next'|translate|escape:"javascript"}";
            params['row'] = '{$row|escape:"javascript"}';
            params['dateSparkline'] = '{$dateSparkline}';
        </script>

        {postEvent name="template_headerMultiSites"}

        {if !$isWidgetized}
            <div class="top_controls_inner">
                {include file="CoreHome/templates/period_select.tpl"}
                {include file="CoreHome/templates/header_message.tpl"}
            </div>
        {/if}

        <div class="centerLargeDiv">

            <h2>{'General_AllWebsitesDashboard'|translate}
                {capture assign=nVisits}{'General_NVisits'|translate:$totalVisits}{/capture}
                {capture assign=nVisitsLast}{'General_NVisits'|translate:$pastTotalVisits}{/capture}
                <span class='smallTitle'
                      {if $totalVisitsEvolution}title="{'General_EvolutionSummaryGeneric'|translate:$nVisits:$prettyDate:$nVisitsLast:$pastPeriodPretty:$totalVisitsEvolution}"{/if}>
		{'General_TotalVisitsPageviewsRevenue'|translate:"<strong>$totalVisits</strong>":"<strong>$totalPageviews</strong>":"<strong>$totalRevenue</strong>"}
	</span>
            </h2>

            <table id="mt" class="dataTable" cellspacing="0">
                <thead>
                <tr>
                    <th id="names" class="label" onClick="params = setOrderBy(this,allSites, params, 'names');">
                        <span>{'General_Website'|translate}</span>
                        <span class="arrow {if $evolutionBy=='names'}multisites_{$order}{/if}"></span>
                    </th>
                    <th id="visits" class="multisites-column" style="width: 100px" onClick="params = setOrderBy(this,allSites, params, 'visits');">
                        <span>{'General_ColumnNbVisits'|translate}</span>
                        <span class="arrow {if $evolutionBy=='visits'}multisites_{$order}{/if}"></span>
                    </th>
                    <th id="pageviews" class="multisites-column" style="width: 110px" onClick="params = setOrderBy(this,allSites, params, 'pageviews');">
                        <span>{'General_ColumnPageviews'|translate}</span>
                        <span class="arrow {if $evolutionBy=='pageviews'}multisites_{$order}{/if}"></span>
                    </th>
                    {if $displayRevenueColumn}
                        <th id="revenue" class="multisites-column" style="width: 110px" onClick="params = setOrderBy(this,allSites, params, 'revenue');">
                            <span>{'Goals_ColumnRevenue'|translate}</span>
                            <span class="arrow {if $evolutionBy=='revenue'}multisites_{$order}{/if}"></span>
                        </th>
                    {/if}
                    <th id="evolution" style=" width:350px" colspan="{if $show_sparklines}2{else}1{/if}">
                        <span class="arrow "></span>
                        <span class="evolution" style="cursor:pointer;"
                              onClick="params = setOrderBy(this,allSites, params, $('#evolution_selector').val() + 'Summary');"> {'MultiSites_Evolution'|translate}</span>
                        <select class="selector" id="evolution_selector"
                                onchange="params['evolutionBy'] = $('#evolution_selector').val(); switchEvolution(params);">
                            <option value="visits" {if $evolutionBy eq 'visits'} selected {/if}>{'General_ColumnNbVisits'|translate}</option>
                            <option value="pageviews" {if $evolutionBy eq 'pageviews'} selected {/if}>{'General_ColumnPageviews'|translate}</option>
                            {if $displayRevenueColumn}
                                <option value="revenue" {if $evolutionBy eq 'revenue'} selected {/if}>{'Goals_ColumnRevenue'|translate}</option>{/if}
                        </select>
                    </th>
                </tr>
                </thead>

                <tbody id="tb">
                </tbody>

                <tfoot>
                {if $isSuperUser}
                    <tr>
                        <td colspan="8" class="clean" style="text-align: right; padding-top: 15px;padding-right:10px">
                            <a href="{url}&module=SitesManager&action=index&showaddsite=1"><img src='plugins/UsersManager/images/add.png' alt=""
                                                                                                style="margin: 0;"/> {'SitesManager_AddSite'|translate}</a>
                        </td>
                    </tr>
                {/if}
                <tr row_id="last">
                    <td colspan="8" class="clean" style="padding: 20px">
                        <span id="prev" class="pager" style="padding-right: 20px;"></span>
		<span class="dataTablePages">
			<span id="counter">
		</span>
		</span>
                        <span id="next" class="clean" style="padding-left: 20px;"></span>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <script type="text/javascript">
            prepareRows(allSites, params, '{$orderBy}');

            {if $autoRefreshTodayReport}
            piwikHelper.refreshAfter({$autoRefreshTodayReport} * 1000
            )
            ;
            {/if}
        </script>
    </div>
</div>

{include file="CoreHome/templates/footer.tpl"}
