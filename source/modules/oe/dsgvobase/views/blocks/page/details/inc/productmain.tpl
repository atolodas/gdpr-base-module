[{$smarty.block.parent}]

[{if !$oViewConf->oeGdprIsRecommendationsEnabled()}]
    <style>
        #suggest {
            display: none;
        }
    </style>
[{/if}]
