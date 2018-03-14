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
    protected function oeGdprBaseDeleteRecommendationLists(DatabaseInterface $database)
    {
        $recommendationList = $this->getUserRecommLists($this->getId());
        /** @var oxRecommList $recommendation */
        foreach ($recommendationList as $recommendation) {
            $recommendation->delete();
        }
    }

    /**
     * Deletes User reviews.
     *
     * @param DatabaseInterface $database
     */
    private function oeGdprBaseDeleteReviews(DatabaseInterface $database)
    {
        $reviews = $database->getAll('select * from oxreviews where oxuserid = ?', array($this->getId()));
        foreach ($reviews as $reviewId) {
            $review = oxNew('oxReview');
            $review->load($reviewId[0]);
            $review->delete();
        }
        $database->setFetchMode(DatabaseInterface::FETCH_MODE_NUM);
    }

    /**
     * Deletes User ratings.
     *
     * @param DatabaseInterface $database
     */
    private function oeGdprBaseDeleteRatings(DatabaseInterface $database)
    {
        $ratings = $database->getAll('select * from oxratings where oxuserid = ?', array($this->getId()));
        foreach ($ratings as $ratingId) {
            $rating = oxNew('oxRating');
            $rating->load($ratingId[0]);
            $rating->delete();
        }
        $database->setFetchMode(DatabaseInterface::FETCH_MODE_NUM);
    }
}
