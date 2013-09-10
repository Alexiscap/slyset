{include file="CoreAdminHome/templates/header.tpl"}
{loadJavascriptTranslations plugins='UsersManager'}
<h2>{'UsersManager_MenuUserSettings'|translate}</h2>

<br/>

<div class="ui-confirm" id="confirmPasswordChange">
    <h2>{'UsersManager_ChangePasswordConfirm'|translate}</h2>
    <input role="yes" type="button" value="{'General_Yes'|translate}"/>
    <input role="no" type="button" value="{'General_No'|translate}"/>
</div>

<table id='userSettingsTable' class="adminTable" style='width:1050px'>
    <tr>
        <td><label for="username">{'General_Username'|translate} </label></td>
        <td>
            <input size="25" value="{$userLogin}" id="username" disabled="disabled"/>
            <span class='form-description'>{'UsersManager_YourUsernameCannotBeChanged'|translate}</span>
        </td>
    </tr>

    <tr>
        <td><label for="alias">{'UsersManager_Alias'|translate} </label></td>
        <td><input size="25" value="{$userAlias}" id="alias"{if $isSuperUser} disabled="disabled"{/if} />
            {if $isSuperUser}
                <span class='form-description'>
				{'UsersManager_TheSuperUserAliasCannotBeChanged'|translate}
			</span>
            {/if}
        </td>
    </tr>
    <tr>
        <td><label for="email">{'UsersManager_Email'|translate} </label></td>
        <td><input size="25" value="{$userEmail}" id="email"/></td>
    </tr>
    <tr>
        <td>{'UsersManager_ReportToLoadByDefault'|translate}</td>
        <td>
            <fieldset>
                <label><input type="radio" value="MultiSites"
                              name="defaultReport"{if $defaultReport=='MultiSites'} checked="checked"{/if} /> {'General_AllWebsitesDashboard'|translate}</label><br/>
                <label style="padding-right:12px;"><input type="radio" value="1"
                                                          name="defaultReport"{if $defaultReport!='MultiSites'} checked="checked"{/if} /> {'General_DashboardForASpecificWebsite'|translate}
                </label>
                {if $defaultReport=='MultiSites'}{assign var=defaultReportIdSite value=1}{else}{assign var=defaultReportIdSite value=$defaultReport}{/if}
                {include file="CoreHome/templates/sites_selection.tpl"
                siteName=$defaultReportSiteName idSite=$defaultReportIdSite switchSiteOnSelect=false showAllSitesItem=false
                showSelectedSite=true siteSelectorId='defaultReportSiteSelector'}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td>{'UsersManager_ReportDateToLoadByDefault'|translate}</td>
        <td>
            <fieldset>
                {foreach from=$availableDefaultDates key=value item=description}
                    <label><input type="radio"{if $defaultDate==$value} checked="checked"{/if} value="{$value}" name="defaultDate"/> {$description}</label>
                    <br/>
                {/foreach}
            </fieldset>
        </td>
    </tr>

    {if isset($isValidHost) && $isValidHost}
        <tr>
            <td><label for="email">{'UsersManager_ChangePassword'|translate} </label></td>
            <td><input size="25" value="" autocomplete="off" id="password" type="password"/>
                <span class='form-description'>{'UsersManager_IfYouWouldLikeToChangeThePasswordTypeANewOne'|translate}</span>
                <br/><br/><input size="25" value="" autocomplete="off" id="passwordBis" type="password"/>
                <span class='form-description'> {'UsersManager_TypeYourPasswordAgain'|translate}</span>
            </td>
        </tr>
    {/if}
</table>
{if !isset($isValidHost) || !$isValidHost}
    <div class="ajaxSuccess">
        {'UsersManager_InjectedHostCannotChangePwd'|translate:$invalidHost}
        &nbsp;{if !$isSuperUser}{'UsersManager_EmailYourAdministrator'|translate:$invalidHostMailLinkStart:'</a>'}{/if}
    </div>
    <br/>
{/if}

{ajaxErrorDiv id=ajaxErrorUserSettings}
{ajaxLoadingDiv id=ajaxLoadingUserSettings}
<input type="submit" value="{'General_Save'|translate}" id="userSettingsSubmit" class="submit"/>

<br/><br/>
<a name='excludeCookie'></a><h2>{'UsersManager_ExcludeVisitsViaCookie'|translate}</h2>
<p>{if $ignoreCookieSet}{'UsersManager_YourVisitsAreIgnoredOnDomain'|translate:"<strong>":$piwikHost:"</strong>"}
    {else}{'UsersManager_YourVisitsAreNotIgnored'|translate:"<strong>":"</strong>"}{/if}</p>
<span style='margin-left:20px'>
<a href='{url token_auth=$token_auth action=setIgnoreCookie}#excludeCookie'>&rsaquo; {if $ignoreCookieSet}{'UsersManager_ClickHereToDeleteTheCookie'|translate}
    {else}{'UsersManager_ClickHereToSetTheCookieOnDomain'|translate:$piwikHost}{/if}
    <br/>
</a></span>

<br/><br/>
{if $isSuperUser}
    <h2>{'UsersManager_MenuAnonymousUserSettings'|translate}</h2>
    {if count($anonymousSites) == 0}
        <h3 class='form-description'><b>{'UsersManager_NoteNoAnonymousUserAccessSettingsWontBeUsed2'|translate}</b></h3>
        <br/>
    {else}
        <br/>
        {ajaxErrorDiv id=ajaxErrorAnonymousUserSettings}
        {ajaxLoadingDiv id=ajaxLoadingAnonymousUserSettings}
        <table id='anonymousUserSettingsTable' class="adminTable" style='width:850px;'>
            <tr>
                <td style='width:400px'>{'UsersManager_WhenUsersAreNotLoggedInAndVisitPiwikTheyShouldAccess'|translate}</td>
                <td>
                    <fieldset>
                        <label><input type="radio" value="Login"
                                      name="anonymousDefaultReport"{if $anonymousDefaultReport==$loginModule} checked="checked"{/if} /> {'UsersManager_TheLoginScreen'|translate}
                        </label><br/>
                        <label><input {if empty($anonymousSites)}disabled="disabled" {/if}type="radio" value="MultiSites"
                                      name="anonymousDefaultReport"{if $anonymousDefaultReport=='MultiSites'} checked="checked"{/if} /> {'General_AllWebsitesDashboard'|translate}
                        </label><br/>

                        <label><input {if empty($anonymousSites)}disabled="disabled" {/if}type="radio" value="1"
                                      name="anonymousDefaultReport"{if $anonymousDefaultReport>0} checked="checked"{/if} /> {'General_DashboardForASpecificWebsite'|translate}
                        </label>
                        {if !empty($anonymousSites)}
                            <select id="anonymousDefaultReportWebsite">
                                {foreach from=$anonymousSites item=info}
                                    <option value="{$info.idsite}" {if $anonymousDefaultReport==$info.idsite} selected="selected"{/if}>{$info.name}</option>
                                {/foreach}
                            </select>
                        {/if}
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td>{'UsersManager_ForAnonymousUsersReportDateToLoadByDefault'|translate}</td>
                <td>
                    <fieldset>
                        {foreach from=$availableDefaultDates key=value item=description}
                            <label><input type="radio" {if $anonymousDefaultDate==$value}checked="checked" {/if}value="{$value}"
                                          name="anonymousDefaultDate"/> {$description}</label>
                            <br/>
                        {/foreach}
                    </fieldset>
                </td>
            </tr>

        </table>
        <input type="submit" value="{'General_Save'|translate}" id="anonymousUserSettingsSubmit" class="submit"/>
    {/if}
{/if}


{include file="CoreAdminHome/templates/footer.tpl"}
