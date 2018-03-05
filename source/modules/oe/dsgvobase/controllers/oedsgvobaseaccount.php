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
 * Class oeDsgvoBaseAccount.
 * Extends Account.
 *
 * @see Account
 */
class oeDsgvoBaseAccount extends oeDsgvoBaseAccount_parent
{
    private $oeDsgvoBaseIsUserDeleted = false;

    /**
     * Deletes User account.
     */
    public function oeDsgvoBaseDeleteAccount()
    {
        if ($this->oeDsgvoBaseCanBeUserAccountDeleted()) {
            $user = $this->getUser();
            $user->delete();
            $user->logout();
            $session = $this->getSession();
            $session->destroy();
            $this->oeDsgvoBaseIsUserDeleted = true;
        } else {
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('OESDGVOBASE_ERROR_ACCOUNT_NOT_DELETED');
        }
    }

    /**
     * Method used to show message in frontend if user was successfully deleted.
     *
     * @return bool
     */
    public function oeDsgvoBaseIsUserDeleted()
    {
        return $this->oeDsgvoBaseIsUserDeleted;
    }

    /**
     * Returns true if User is allowed to delete own account.
     *
     * @return bool
     */
    public function oeDsgvoBaseIsUserAllowedToDeleteOwnAccount()
    {
        $allowUsersToDeleteTheirAccount = $this
            ->getConfig()
            ->getConfigParam('blOeDsgvoBaseAllowUsersToDeleteTheirAccount');

        $user = $this->getUser();

        return $allowUsersToDeleteTheirAccount && $user && !$user->oeDsgvoBaseIsMallAdmin();
    }

    /**
     * Checks if possible to delete user.
     *
     * @return bool
     */
    protected function oeDsgvoBaseCanBeUserAccountDeleted()
    {
        return $this->getSession()->checkSessionChallenge() && $this->oeDsgvoBaseIsUserAllowedToDeleteOwnAccount();
    }
}
