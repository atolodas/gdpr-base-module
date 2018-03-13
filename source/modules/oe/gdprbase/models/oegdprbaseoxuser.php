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
 * @see oxUser
 */
class oeGdprBaseOxuser extends oeGdprBaseOxuser_parent
{
    /**
     * Returns true if User is mall admin.
     *
     * @return bool
     */
    public function oeGdprBaseIsMallAdmin()
    {
        return 'malladmin' === $this->oxuser__oxrights->value;
    }

    /**
     * Additionally deletes recommendations and reviews when user is deleted.
     *
     * @param string $id
     * @return bool
     */
    public function delete($id = null)
    {
        $isDeleted = parent::delete($id);
        if ($isDeleted) {
            $database = oxDb::getDb();
            $this->oeGdprBaseDeleteRecommendationLists($database);
            $this->oeGdprBaseDeleteReviews($database);
            $this->oeGdprBaseDeleteRatings($database);
        }
        return $isDeleted;
    }

    /**
     * Deletes recommendation lists.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBaseDeleteRecommendationLists($database)
    {
        $database->execute(
            'delete 
                    oxobject2list
            
                from
                    oxobject2list
                
                inner join oxrecommlists 
                    on oxobject2list.oxlistid = oxrecommlists.oxid 
                
                where 
                    oxrecommlists.oxuserid = ?
            ',
            array($this->getId())
        );

        $database->execute(
            'delete from oxrecommlists where oxuserid = ?',
            array($this->getId())
        );
    }

    /**
     * Deletes User reviews.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBaseDeleteReviews($database)
    {
        $database->execute(
            'delete from oxreviews where oxuserid = ?',
            array($this->getId())
        );
    }

    /**
     * Deletes User ratings.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBaseDeleteRatings($database)
    {
        $database->execute(
            'delete from oxratings where oxuserid = ?',
            array($this->getId())
        );
    }
}
