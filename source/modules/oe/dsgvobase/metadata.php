<?php
/**
 * This file is part of OXID eSales DSGVO base module.
 *
 * OXID eSales DSGVO base module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales DSGVO base module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales DSGVO base module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link          http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2018
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = array(
    'id'          => 'oedsgvobase',
    'title'       => array(
        'de' => 'DSGVO Base',
        'en' => 'DSGVO Base',
    ),
    'description' => array(
        'de' => 'Das Modul stellt Basisfunktionalität für die Datenschutz-Grundverordnung (DSVGO) bereit',
        'en' => 'This module provides the basic functionality for the European General Data Protection Regulation (GDPR)',
    ),
    'thumbnail'   => 'out/pictures/logo.png',
    'version'     => '1.0.0',
    'author'      => 'OXID eSales AG',
    'url'         => 'https://www.oxid-esales.com/',
    'email'       => 'info@oxid-esales.com',
    'extend'      => array(
        'suggest'    => 'oe/dsgvobase/controllers/oedsgvobaserecommend',
        'account'    => 'oe/dsgvobase/controllers/oedsgvobaseaccount',
        'oxcmp_user' => 'oe/dsgvobase/components/oedsgvobaseoxcmp_user',
        'oxuser'     => 'oe/dsgvobase/models/oedsgvobaseoxuser',
        'oxViewConfig' => 'oe/dsgvobase/core/oedsgvoviewconfig',
    ),
    'files'       => array(
        'oedsgvobasemodule'                  => 'oe/dsgvobase/core/oedsgvobasemodule.php',
        'oedsgvobaseaccountreviewcontroller' => 'oe/dsgvobase/controllers/oedsgvobaseaccountreviewcontroller.php',
    ),
    'templates' => array(
        'oedsgvobasedashboard_azure.tpl'                   => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedashboard_azure.tpl',
        'oedsgvobasedashboard_flow.tpl'                    => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedashboard_flow.tpl',
        'oedsgvobasedeletemyaccountconfirmation_azure_modal.tpl' => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedeletemyaccountconfirmation_azure_modal.tpl',
        'oedsgvobasedeletemyaccountconfirmation_flow_modal.tpl'  => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedeletemyaccountconfirmation_flow_modal.tpl',
    ),
    'blocks'      => array(
        array('template' => 'layout/base.tpl', 'block'=>'base_style', 'file'=>'/views/blocks/layout/base.tpl'),
        array('template' => 'form/fieldset/user_shipping.tpl', 'block'=>'form_user_shipping_address_select', 'file' => '/views/blocks/form/fieldset/user_shipping.tpl'),
        array('template' => 'form/user.tpl', 'block'=>'user', 'file' => '/views/blocks/form/delete_shipping_address_modal.tpl'),
        array('template' => 'form/user_checkout_change.tpl', 'block'=>'user_checkout_change', 'file' => '/views/blocks/form/delete_shipping_address_modal.tpl'),
        array('template' => 'form/user_checkout_noregistration.tpl', 'block'=>'user_checkout_noregistration', 'file' => '/views/blocks/form/delete_shipping_address_modal.tpl'),
        array('template' => 'form/user_checkout_registration.tpl', 'block'=>'user_checkout_registration', 'file' => '/views/blocks/form/delete_shipping_address_modal.tpl'),
        array('template' => 'page/account/dashboard.tpl', 'block'=>'account_dashboard_col1', 'file' => '/views/blocks/page/account/dashboard.tpl'),
        array('template' => 'page/details/inc/productmain.tpl', 'block'=>'details_productmain_productlinks', 'file' => '/views/blocks/page/details/inc/productmain.tpl'),
    ),
    'settings' => array(
        array(
            'group' => 'oedsgvobase_account_settings',
            'name'  => 'blOeDsgvoBaseAllowUsersToDeleteTheirAccount',
            'type'  => 'bool',
            'value' => 'false'
        ),
        array(
            'group' => 'oedsgvobase_recommendation_settings',
            'name'  => 'blOeDsgvoBaseAllowRecommendArticle',
            'type'  => 'bool',
            'value' => 'true'
        ),
    ),
    'events'      => array(
        'onActivate'   => 'oeDsgvoBaseModule::onActivate',
        'onDeactivate' => 'oeDsgvoBaseModule::onDeactivate',
    ),
);
