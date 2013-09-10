<div id='leftcolumn'>
    <div class="sparkline">
        {sparkline src=$urlSparklineNbVisits}
        {'VisitsSummary_NbVisits'|translate:"<strong>$nbVisits</strong>"}{if $displayUniqueVisitors},
            {'VisitsSummary_NbUniqueVisitors'|translate:"<strong>$nbUniqVisitors</strong>"}{/if}
    </div>
    <div class="sparkline">
        {sparkline src=$urlSparklineAvgVisitDuration}
        {assign var=averageVisitDuration value=$averageVisitDuration|sumtime}
        {'VisitsSummary_AverageVisitDuration'|translate:"<strong>$averageVisitDuration</strong>"}
    </div>
    <div class="sparkline">
        {sparkline src=$urlSparklineBounceRate}
        {'VisitsSummary_NbVisitsBounced'|translate:"<strong>$bounceRate%</strong>"}
    </div>
    <div class="sparkline">
        {sparkline src=$urlSparklineActionsPerVisit}
        {'VisitsSummary_NbActionsPerVisit'|translate:"<strong>$nbActionsPerVisit</strong>"}
    </div>
	<div class="sparkline">
		{sparkline src=$urlSparklineAvgGenerationTime}
		{assign var=averageGenerationTime value=$averageGenerationTime|sumtime}
		{'VisitsSummary_AverageGenerationTime'|translate:"<strong>$averageGenerationTime</strong>"}
	</div>
</div>

<div id='rightcolumn'>
    {if $showOnlyActions}
        <div class="sparkline">
            {sparkline src=$urlSparklineNbActions}
            {'VisitsSummary_NbActionsDescription'|translate:"<strong>$nbActions</strong>"}
        </div>
    {else}
        <div class="sparkline">
            {sparkline src=$urlSparklineNbPageviews}
            {'VisitsSummary_NbPageviewsDescription'|translate:"<strong>$nbPageviews</strong>"|trim},
            {'VisitsSummary_NbUniquePageviewsDescription'|translate:"<strong>$nbUniquePageviews</strong>"}
        </div>
        {if $displaySiteSearch}
            <div class="sparkline">
                {sparkline src=$urlSparklineNbSearches}
                {'VisitsSummary_NbSearchesDescription'|translate:"<strong>$nbSearches</strong>"|trim},
                {'VisitsSummary_NbKeywordsDescription'|translate:"<strong>$nbKeywords</strong>"}
            </div>
        {/if}
        <div class="sparkline">
            {sparkline src=$urlSparklineNbDownloads}
            {'VisitsSummary_NbDownloadsDescription'|translate:"<strong>$nbDownloads</strong>"|trim},
            {'VisitsSummary_NbUniqueDownloadsDescription'|translate:"<strong>$nbUniqueDownloads</strong>"}
        </div>
        <div class="sparkline">
            {sparkline src=$urlSparklineNbOutlinks}
            {'VisitsSummary_NbOutlinksDescription'|translate:"<strong>$nbOutlinks</strong>"|trim},
            {'VisitsSummary_NbUniqueOutlinksDescription'|translate:"<strong>$nbUniqueOutlinks</strong>"}
        </div>
    {/if}
    <div class="sparkline">
        {sparkline src=$urlSparklineMaxActions}
        {'VisitsSummary_MaxNbActions'|translate:"<strong>$maxActions</strong>"}
    </div>
</div>
<div style="clear:both;"></div>

{include file="CoreHome/templates/sparkline_footer.tpl"}

