[{block name="oedsgvobase_account_delete_my_account_confirmation"}]
[{oxscript include="js/widgets/oxmodalpopup.js" priority=10}]
<div class="oedsgvobase-modal modal fade popupBox corners FXgradGreyLight glowShadow"
     id="oedsgvobase_delete_my_account_confirmation"
     tabindex="-1"
     role="dialog"
     aria-labelledby="oedsgvobase_delete_my_account_confirmation"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                [{block name="oedsgvobase_delete_my_account_confirmation_modal_header"}]
                    <h3>[{oxmultilang ident="OEDSGVOBASE_DELETE_MY_ACCOUNT_CONFIRMATION_QUESTION"}]</h3>
                [{/block}]
                <img src="[{$oViewConf->getImageUrl('x.png')}]" alt="" class="oedsgvobase-close closePop">
            </div>
            <div class="modal-body">
                [{oxmultilang ident="OEDSGVOBASE_DELETE_MY_ACCOUNT_WARNING"}]
                [{block name="oedsgvobase_account_delete_my_account_confirmation_form"}]
                <form id="delete_my_account"
                      name="delete_my_account"
                      action="[{$oViewConf->getSelfActionLink()}]"
                      method="post">
                    <div class="hidden">
                        [{$oViewConf->getHiddenSid()}]
                        <input type="hidden" name="cl" value="account">
                        <input type="hidden" name="fnc" value="oeDsgvoBaseDeleteAccount">
                    </div>
                </form>
                [{/block}]
            </div>
            <div class="modal-footer ui-dialog-buttonset">
                [{block name="oedsgvobase_account_delete_my_account_confirmation_form_button_set"}]
                <button type="reset"
                        class="textButton closePop"
                >
                    [{oxmultilang ident="OESDGVOBASE_CANCEL_DELETE_ACCOUNT"}]
                </button>
                <button class="submitButton largeButton removeButton"
                   onclick="$('#delete_my_account').submit();"
                >
                    <span>[{oxmultilang ident="OESDGVOBASE_DELETE_ACCOUNT_CONFIRMATION"}]</span>
                </button>
                [{/block}]
            </div>
        </div>
    </div>
</div>
[{/block}]