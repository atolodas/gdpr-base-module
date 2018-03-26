<?php
/**
 * This file is part of OXID eSales GDPR base module.
 *
 * OXID eSales GDPR base module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales GDPR base module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales GDPR base module.  If not, see <http://www.gnu.org/licenses/>.
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
    'id'          => 'oegdprbase',
    'title'       => array(
        'de' => 'GDPR Base',
        'en' => 'GDPR Base',
    ),
    'description' => array(
        'de' => 'Das Modul stellt Basisfunktionalit&auml;t f&uuml;r die Datenschutz-Grundverordnung (DSVGO) bereit',
        'en' => 'This module provides the basic functionality for the European General Data Protection Regulation (GDPR)',
    ),
    'thumbnail'   => 'out/pictures/logo.png',
    'version'     => '1.0.0',
    'author'      => 'OXID eSales AG',
    'url'         => 'https://www.oxid-esales.com/',
    'email'       => 'info@oxid-esales.com',
    'extend'      => array(
        'suggest'    => 'oe/gdprbase/controllers/oegdprbaserecommend',
        'account'    => 'oe/gdprbase/controllers/oegdprbaseaccount',
        'oxcmp_user' => 'oe/gdprbase/components/oegdprbaseoxcmp_user',
        'oxuser'     => 'oe/gdprbase/models/oegdprbaseoxuser',
        'oxViewConfig' => 'oe/gdprbase/core/oegdprviewconfig',
    ),
    'files'       => array(
        'oegdprbasemodule'                  => 'oe/gdprbase/core/oegdprbasemodule.php',
        'oegdprbaseaccountreviewcontroller' => 'oe/gdprbase/controllers/oegdprbaseaccountreviewcontroller.php',

        //Internal
        'oegdprcontainer'                           => 'oe/gdprbase/internal/common/oegdprcontainer.php',
        'oegdprentrydoesnotexistdaoexception'       => 'oe/gdprbase/internal/common/exception/oegdprentrydoesnotexistdaoexception.php',
        'oegdprinvalidobjectiddaoexception'         => 'oe/gdprbase/internal/common/exception/oegdprinvalidobjectiddaoexception.php',
        'oegdprproductratingbridge'                 => 'oe/gdprbase/internal/review/bridge/oegdprproductratingbridge.php',
        'oegdpruserratingbridge'                    => 'oe/gdprbase/internal/review/bridge/oegdpruserratingbridge.php',
        'oegdpruserreviewandratingbridge'           => 'oe/gdprbase/internal/review/bridge/oegdpruserreviewandratingbridge.php',
        'oegdpruserreviewbridge'                    => 'oe/gdprbase/internal/review/bridge/oegdpruserreviewbridge.php',
        'oegdprproductratingdao'                    => 'oe/gdprbase/internal/review/dao/oegdprproductratingdao.php',
        'oegdprratingdao'                           => 'oe/gdprbase/internal/review/dao/oegdprratingdao.php',
        'oegdprreviewdao'                           => 'oe/gdprbase/internal/review/dao/oegdprreviewdao.php',
        'oegdprproductrating'                       => 'oe/gdprbase/internal/review/dataobject/oegdprproductrating.php',
        'oegdprrating'                              => 'oe/gdprbase/internal/review/dataobject/oegdprrating.php',
        'oegdprreview'                              => 'oe/gdprbase/internal/review/dataobject/oegdprreview.php',
        'oegdprratingpermissionexception'           => 'oe/gdprbase/internal/review/exception/oegdprratingpermissionexception.php',
        'oegdprreviewandratingobjecttypeexception'  => 'oe/gdprbase/internal/review/exception/oegdprreviewandratingobjecttypeexception.php',
        'oegdprreviewpermissionexception'           => 'oe/gdprbase/internal/review/exception/oegdprreviewpermissionexception.php',
        'oegdprproductratingservice'                => 'oe/gdprbase/internal/review/service/oegdprproductratingservice.php',
        'oegdprratingcalculatorservice'             => 'oe/gdprbase/internal/review/service/oegdprratingcalculatorservice.php',
        'oegdprreviewandratingmergingservice'       => 'oe/gdprbase/internal/review/service/oegdprreviewandratingmergingservice.php',
        'oegdpruserratingservice'                   => 'oe/gdprbase/internal/review/service/oegdpruserratingservice.php',
        'oegdpruserreviewandratingservice'          => 'oe/gdprbase/internal/review/service/oegdpruserreviewandratingservice.php',
        'oegdpruserreviewservice'                   => 'oe/gdprbase/internal/review/service/oegdpruserreviewservice.php',
        'oegdprreviewservicefactory'                => 'oe/gdprbase/internal/review/servicefactory/oegdprreviewservicefactory.php',
        'oegdprreviewandrating'                     => 'oe/gdprbase/internal/review/viewdataobject/oegdprreviewandrating.php',
    ),
    'templates' => array(
        'oegdprbasedashboard_azure.tpl'                   => 'oe/gdprbase/views/blocks/page/account/oegdprbasedashboard_azure.tpl',
        'oegdprbasedashboard_flow.tpl'                    => 'oe/gdprbase/views/blocks/page/account/oegdprbasedashboard_flow.tpl',
        'oegdprbasedeletemyaccountconfirmation_azure_modal.tpl' => 'oe/gdprbase/views/blocks/page/account/oegdprbasedeletemyaccountconfirmation_azure_modal.tpl',
        'oegdprbasedeletemyaccountconfirmation_flow_modal.tpl'  => 'oe/gdprbase/views/blocks/page/account/oegdprbasedeletemyaccountconfirmation_flow_modal.tpl',
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
            'group' => 'oegdprbase_account_settings',
            'name'  => 'blOeGdprBaseAllowUsersToDeleteTheirAccount',
            'type'  => 'bool',
            'value' => 'false'
        ),
        array(
            'group' => 'oegdprbase_recommendation_settings',
            'name'  => 'blOeGdprBaseAllowRecommendArticle',
            'type'  => 'bool',
            'value' => 'true'
        ),
    ),
    'events'      => array(
        'onActivate'   => 'oeGdprBaseModule::onActivate',
        'onDeactivate' => 'oeGdprBaseModule::onDeactivate',
    ),
);
