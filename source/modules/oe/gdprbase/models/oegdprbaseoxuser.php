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
 * @link      http://www.oxid-esales.com
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
            $this->oeGdprBaseDeleteRecommendationLists();
            $this->oeGdprBaseDeleteReviews($database);
            $this->oeGdprBaseDeleteRatings($database);
            $this->oeGdprBasedeletePriceAlarms($database);
            $this->oeGdprBasedeleteUserPayments($database);
            $this->oeGdprBasedeleteAcceptedTerms($database);
        }
        return $isDeleted;
    }

    /**
     * Deletes recommendation lists.
     */
    protected function oeGdprBaseDeleteRecommendationLists()
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
    protected function oeGdprBaseDeleteReviews(DatabaseInterface $database)
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
    protected function oeGdprBaseDeleteRatings(DatabaseInterface $database)
    {
        $ratings = $database->getAll('select * from oxratings where oxuserid = ?', array($this->getId()));
        foreach ($ratings as $ratingId) {
            $rating = oxNew('oxRating');
            $rating->load($ratingId[0]);
            $rating->delete();
        }
        $database->setFetchMode(DatabaseInterface::FETCH_MODE_NUM);
    }

    /**
     * Deletes price alarms.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBasedeletePriceAlarms(DatabaseInterface $database)
    {
        $database->execute(
            'delete from oxpricealarm where oxuserid = ?',
            array($this->getId())
        );
    }

    /**
     * Deletes user payments.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBasedeleteUserPayments(DatabaseInterface $database)
    {
        $database->execute(
            'delete from oxuserpayments where oxuserid = ?',
            array($this->getId())
        );
    }

    /**
     * Deletes user accepted terms.
     *
     * @param DatabaseInterface $database
     */
    protected function oeGdprBasedeleteAcceptedTerms(DatabaseInterface $database)
    {
        $database->execute(
            'delete from oxacceptedterms where oxuserid = ?',
            array($this->getId())
        );
    }
}
