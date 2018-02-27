[{$smarty.block.parent}]
[{block name="oegdprbase_add_css"}]
    [{*CSS Switch according theme*}]
    [{if $oViewConf->getActiveTheme() == 'azure'}]
        [{oxstyle include=$oViewConf->getModuleUrl('oegdprbase','out/css/oegdprbase-azure.css')}]
    [{else}]
        [{oxstyle include=$oViewConf->getModuleUrl('oegdprbase','out/css/oegdprbase-flow.css')}]
    [{/if}]
[{/block}]
[{block name="oegdprbase_account_deletion_message"}]
    [{*Message after account deletion*}]
    [{if $oViewConf->getActiveClassName() == 'account' && $oView->oeGdprBaseIsUserDeleted()}]
        [{assign var="successMessage" value="OEGDPRBASE_SUCCESS_ACCOUNT_DELETED"|oxmultilangassign}]
        [{assign var="scriptToAddMessage" value='$("#loginAccount").after("<div id=\"oegdprbase-user-account-delete-success\" class=\"status success corners alert alert-success\">'|cat:$successMessage|cat:'</div>");'}]
        [{oxscript add=$scriptToAddMessage}]
    [{/if}]
[{/block}]
