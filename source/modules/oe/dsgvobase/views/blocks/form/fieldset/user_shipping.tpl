[{$smarty.block.parent}]

[{if $oViewConf->getActiveTheme() == 'azure'}]
    <a id="oedsgvobase-delete-shipping-address-button" class="submitButton largeButton oedsgvobase-delete-shipping-address-button" title="[{oxmultilang ident="OESDGVOBASE_DELETE"}]">[{oxmultilang ident="OESDGVOBASE_DELETE"}]</a>
    [{oxscript include="js/widgets/oxmodalpopup.js" priority=10}]
    [{oxscript add='
        var selectAddressDropDown = $("#addressId");
        var activeAddressId = selectAddressDropDown.val();
        var deleteButton = $("#oedsgvobase-delete-shipping-address-button");

        deleteButton.click(function(){
            $("body").oxModalPopup({target: "#delete_shipping_address_"+activeAddressId, openDialog: true, width: "310px"});
            $("#delete_shipping_address_"+activeAddressId).dialog("open");
        });

        if ($("#addressId").val() != "-1") {
            deleteButton.show();
        }
        selectAddressDropDown.on("change", function() {
          if (this.value == "-1") {
            deleteButton.hide();
          } else {
            deleteButton.show();
          }
        })
    '}]
[{else}]
    [{foreach from=$aUserAddresses item=address name="shippingAdresses"}]
        <button id="oedsgvobase-delete-shipping-address-button-[{$address->oxaddress__oxid->value}]" class="btn btn-danger btn-xs hasTooltip pull-right dd-action oedsgvobase-delete-shipping-address-button"
                title="[{oxmultilang ident="OESDGVOBASE_DELETE"}]"
                data-toggle="modal"
                data-target="#delete_shipping_address_[{$address->oxaddress__oxid->value}]">
            <i class="fa fa-trash"></i>
        </button>
    [{/foreach}]

    [{oxscript add='
        var activeButton = $("#shippingAddress .active");
        var editButton = activeButton.parent().parent().find(".dd-edit-shipping-address");
        var activeAddressId = activeButton.find("input[name=oxaddressid]").val();
        var deleteButton = $("#oedsgvobase-delete-shipping-address-button-"+activeAddressId+"");
        deleteButton.show();
        editButton.after(deleteButton);
        $( ".dd-add-delivery-address" ).click( function() {  $(".oedsgvobase-delete-shipping-address-button").hide(); } );
    '}]
[{/if}]
