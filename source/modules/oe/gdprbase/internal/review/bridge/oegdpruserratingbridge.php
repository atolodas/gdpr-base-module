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
 * @internal
 */
class oeGdprUserRatingBridge
{
    /**
     * @var oeGdprUserRatingService
     */
    private $userRatingService;

    /**
     * oeGdprUserRatingBridge constructor.
     *
     * @param oeGdprUserRatingService $userRatingService
     */
    public function __construct(
        oeGdprUserRatingService $userRatingService
    ) {
        $this->userRatingService = $userRatingService;
    }

    /**
     * Delete a Rating.
     *
     * @param string $userId
     * @param string $ratingId
     *
     * @throws oeGdprRatingPermissionException
     */
    public function deleteRating($userId, $ratingId)
    {
        $rating = $this->getRatingById($ratingId);

        $this->validateUserPermissionsToManageRating($rating, $userId);

        $rating->delete();
    }

    /**
     * @param oxRating $rating
     * @param string $userId
     *
     * @throws oeGdprRatingPermissionException
     */
    private function validateUserPermissionsToManageRating(oxRating $rating, $userId)
    {
        if ($rating->oxratings__oxuserid->value !== $userId) {
            throw new oeGdprRatingPermissionException();
        }
    }

    /**
     * @param string $ratingId
     *
     * @return oxRating
     * @throws oeGdprEntryDoesNotExistDaoException
     */
    private function getRatingById($ratingId)
    {
        $rating = oxNew('oxRating');
        $doesRatingExist = $rating->load($ratingId);

        if (!$doesRatingExist) {
            throw new oeGdprEntryDoesNotExistDaoException();
        }

        return $rating;
    }
}
