[{block name="oegdprbase_account_delete_my_account"}]

    [{include file="oegdprbasedeletemyaccountconfirmation_azure_modal.tpl"}]
    <a id="oegdprbase_delete_my_account_button" class="submitButton largeButton removeButton nextStep">
        <span>[{oxmultilang ident="OEGDPRBASE_DELETE_MY_ACCOUNT"}]</span>
    </a>
    [{oxscript add='
        $(window).load(function(){
            var logoutLink = $(".accountDashboardView").next("a.submitButton");
            var deleteButton = $("#oegdprbase_delete_my_account_button");
            var confirmationModal = $("#oegdprbase_delete_my_account_confirmation");

            logoutLink.after(deleteButton);
            logoutLink.addClass("prevStep");
            deleteButton.on("click", function() {
                confirmationModal.oxModalPopup({target: "#oegdprbase_delete_my_account_confirmation", openDialog: true, width: "auto"});
                confirmationModal.dialog("open");
            });
        });
     '}]

[{/block}]
