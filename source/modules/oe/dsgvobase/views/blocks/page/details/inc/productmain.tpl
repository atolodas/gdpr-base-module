[{$smarty.block.parent}]

[{if !$oViewConf->oeDsgvoIsRecommendationsEnabled()}]
    <style>
        #suggest {
            display: none;
        }
    </style>
[{/if}]
