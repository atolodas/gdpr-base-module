[{block name="oedsgvobase_account_delete_my_account"}]

    [{include file="oedsgvobasedeletemyaccountconfirmation_azure_modal.tpl"}]
    <a id="oedsgvobase_delete_my_account_button" class="submitButton largeButton removeButton nextStep">
        <span>[{oxmultilang ident="OESDGVOBASE_DELETE_MY_ACCOUNT"}]</span>
    </a>
    [{oxscript add='
        $(window).load(function(){
            var logoutLink = $(".accountDashboardView").next("a.submitButton");
            var deleteButton = $("#oedsgvobase_delete_my_account_button");
            var confirmationModal = $("#oedsgvobase_delete_my_account_confirmation");

            logoutLink.after(deleteButton);
            logoutLink.addClass("prevStep");
            deleteButton.on("click", function() {
                confirmationModal.oxModalPopup({target: "#oedsgvobase_delete_my_account_confirmation", openDialog: true, width: "auto"});
                confirmationModal.dialog("open");
            });
        });
     '}]

[{/block}]
