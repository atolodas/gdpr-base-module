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
 * @link      http://www.oxid-esales.com
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
        'suggest' => 'oe/dsgvobase/controllers/oedsgvobasesuggest',
        'account' => 'oe/dsgvobase/controllers/oedsgvobaseaccount',
        'oxcmp_user' => 'oe/dsgvobase/components/oedsgvobaseoxcmp_user',
            ),
    'files'       => array(
        'oedsgvobasemodule' => 'oe/dsgvobase/core/oedsgvobasemodule.php',
        'oedsgvobaseaccountreviewcontroller' => 'oe/dsgvobase/controllers/oedsgvobaseaccountreviewcontroller.php',
    ),
    'templates' => array(
        'oedsgvobasedashboard_azure.tpl'                   => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedashboard_azure.tpl',
        'oedsgvobasedashboard_flow.tpl'                    => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedashboard_flow.tpl',
        'oedsgvobasedeletemyaccountconfirmation_azure.tpl' => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedeletemyaccountconfirmation_azure.tpl',
        'oedsgvobasedeletemyaccountconfirmation_flow.tpl'  => 'oe/dsgvobase/views/blocks/page/account/oedsgvobasedeletemyaccountconfirmation_flow.tpl',
    ),
    'blocks'      => array(),
    'settings'    => array(),
    'events'      => array(
        'onActivate'   => 'oeDsgvoBaseModule::onActivate',
        'onDeactivate' => 'oeDsgvoBaseModule::onDeactivate',
    ),
);
