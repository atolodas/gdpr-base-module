[{$smarty.block.parent}]

[{if !$oViewConf->oeGdprBaseIsRecommendationsEnabled()}]
    <style>
        #suggest {
            display: none;
        }
    </style>
[{/if}]
