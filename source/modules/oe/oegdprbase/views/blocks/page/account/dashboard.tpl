[{$smarty.block.parent}]
[{block name="oegdprbase_dashboard"}]
    [{if $oViewConf->getActiveTheme() == 'azure'}]
        [{include file="oegdprbasedashboard_azure.tpl"}]
    [{else}]
        [{include file="oegdprbasedashboard_flow.tpl"}]
    [{/if}]
[{/block}]
