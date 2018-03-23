[{block name="oegdprbase_account_delete_my_account"}]
    <button id="oegdprbase_delete_my_account_button"
            class="btn btn-danger pull-left"
            data-toggle="modal"
            data-target="#oegdprbase_delete_my_account_confirmation">
        <i class="fa fa-trash"></i>
        [{oxmultilang ident="OEGDPRBASE_DELETE_MY_ACCOUNT"}]
    </button>
    [{oxscript add='
        $(window).load(function(){
            var logoutLink = $(".accountDashboardView").next(".row").find("a[role=\'getLogoutLink\']");
            var deleteButton = $("#oegdprbase_delete_my_account_button");

            logoutLink.before(deleteButton);
            deleteButton.show();
        });
    '}]
    [{include file="oegdprbasedeletemyaccountconfirmation_flow_modal.tpl"}]
[{/block}]
