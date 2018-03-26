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
class oeGdprUserReviewBridge
{
    /**
     * @var oeGdprUserReviewService
     */
    private $userReviewService;

    /**
     * UserReviewBridge constructor.
     *
     * @param oeGdprUserReviewService $userReviewService
     */
    public function __construct(
        oeGdprUserReviewService $userReviewService
    ) {
        $this->userReviewService = $userReviewService;
    }

    /**
     * Delete a Review.
     *
     * @param string $userId
     * @param string $reviewId
     *
     * @throws oeGdprReviewPermissionException
     */
    public function deleteReview($userId, $reviewId)
    {
        $review = $this->getReviewById($reviewId);

        $this->validateUserPermissionsToManageReview($review, $userId);

        $review->delete();
    }

    /**
     * @param Review $review
     * @param string $userId
     *
     * @throws oeGdprReviewPermissionException
     */
    private function validateUserPermissionsToManageReview(oxReview $review, $userId)
    {
        if ($review->oxreviews__oxuserid->value !== $userId) {
            throw new oeGdprReviewPermissionException();
        }
    }

    /**
     * @param string $reviewId
     *
     * @return Review
     * @throws oeGdprEntryDoesNotExistDaoException
     */
    private function getReviewById($reviewId)
    {
        $review = oxNew('oxReview');
        $doesReviewExist = $review->load($reviewId);

        if (!$doesReviewExist) {
            throw new oeGdprEntryDoesNotExistDaoException();
        }

        return $review;
    }
}
