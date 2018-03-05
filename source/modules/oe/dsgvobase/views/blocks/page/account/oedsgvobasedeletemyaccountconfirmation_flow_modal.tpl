[{block name="oedsgvobase_account_delete_my_account_confirmation"}]
    <div class="modal fade"
         id="oedsgvobase_delete_my_account_confirmation"
         tabindex="-1"
         role="dialog"
         aria-labelledby="oedsgvobase_delete_my_account_modal_label"
         aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    [{block name="oedsgvobase_account_delete_my_account_confirmation_header_message"}]
                    <span class="h4 modal-title">[{oxmultilang ident="OEDSGVOBASE_DELETE_MY_ACCOUNT_CONFIRMATION_QUESTION"}]</span>
                    [{/block}]
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            [{block name="oedsgvobase_account_delete_my_account_confirmation_warning_message"}]
                            <div class="alert alert-danger text-left">
                                [{oxmultilang ident="OEDSGVOBASE_DELETE_MY_ACCOUNT_WARNING"}]
                            </div>
                            [{/block}]
                            [{block name="oedsgvobase_account_delete_my_account_confirmation_form"}]
                            <form name="delete_my_account"
                                  action="[{$oViewConf->getSelfActionLink()}]"
                                  method="post">
                                <div class="hidden">
                                    [{$oViewConf->getHiddenSid()}]
                                    <input type="hidden" name="cl" value="account">
                                    <input type="hidden" name="fnc" value="oeDsgvoBaseDeleteAccount">
                                </div>
                                [{block name="oedsgvobase_account_delete_my_account_confirmation_form_button_set"}]
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    [{oxmultilang ident="OESDGVOBASE_CANCEL_DELETE_ACCOUNT"}]
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    [{oxmultilang ident="OESDGVOBASE_DELETE_ACCOUNT_CONFIRMATION"}]
                                </button>
                                [{/block}]
                            </form>
                            [{/block}]
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    [{/block}]
