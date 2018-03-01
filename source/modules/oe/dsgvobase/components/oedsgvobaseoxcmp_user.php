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
 * Class oeDsgvoBaseOxcmp_user.
 * Extends oxcmp_user.
 *
 * @see oxcmp_user
 */
class oeDsgvoBaseOxcmp_user extends oeDsgvoBaseOxcmp_user_parent
{
    /**
     * Deletes user shipping address.
     */
    public function oeDsgvoDeleteShippingAddress()
    {
        $addressId = oxRegistry::getConfig()->getRequestParameter('oxaddressid');

        $address = oxNew('oxAddress');
        $address->load($addressId);
        if ($this->canUserDeleteShippingAddress($address) && $this->getSession()->checkSessionChallenge()) {
            $address->delete($addressId);
        }
    }

    /**
     * Checks if shipping address is assigned to user.
     *
     * @param oxAddress $address
     * @return bool
     */
    private function canUserDeleteShippingAddress($address)
    {
        $canDelete = false;
        $user = $this->getUser();
        if ($address->oxaddress__oxuserid->value === $user->getId()) {
            $canDelete = true;
        }

        return $canDelete;
    }
}
