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
class oeGdprUserReviewAndRatingBridge
{
    /**
     * @var oeGdprUserReviewAndRatingService
     */
    private $userReviewAndRatingService;

    /**
     * oeGdprUserReviewAndRatingBridge constructor.
     *
     * @param oeGdprUserReviewAndRatingService $userReviewAndRatingService
     */
    public function __construct(oeGdprUserReviewAndRatingService $userReviewAndRatingService)
    {
        $this->userReviewAndRatingService = $userReviewAndRatingService;
    }

    /**
     * Get number of reviews by given user.
     *
     * @param string $userId
     *
     * @return int
     */
    public function getReviewAndRatingListCount($userId)
    {
        return $this
            ->userReviewAndRatingService
            ->getReviewAndRatingListCount($userId);
    }

    /**
     * Returns array of User Ratings and Reviews.
     *
     * @param string $userId
     *
     * @return array
     */
    public function getReviewAndRatingList($userId)
    {
        $reviewAndRatingList = $this
            ->userReviewAndRatingService
            ->getReviewAndRatingList($userId);

        $this->prepareRatingAndReviewPropertiesData($reviewAndRatingList);

        return $reviewAndRatingList;
    }

    /**
     * Prepare RatingAndReview properties data.
     *
     * @param array $reviewAndRatingList
     */
    private function prepareRatingAndReviewPropertiesData($reviewAndRatingList)
    {
        foreach ($reviewAndRatingList as $reviewAndRating) {
            $this->setObjectTitleToReviewAndRating($reviewAndRating);
            $this->formatReviewText($reviewAndRating);
            $this->formatReviewAndRatingDate($reviewAndRating);
        }
    }

    /**
     * Formats Review text.
     *
     * @param oeGdprReviewAndRating $reviewAndRating
     */
    private function formatReviewText(oeGdprReviewAndRating $reviewAndRating)
    {
        $preparedText = htmlspecialchars($reviewAndRating->getReviewText());

        $reviewAndRating->setReviewText($preparedText);
    }

    /**
     * Formats oeGdprReviewAndRating date.
     *
     * @param oeGdprReviewAndRating $reviewAndRating
     */
    private function formatReviewAndRatingDate(oeGdprReviewAndRating $reviewAndRating)
    {
        $formattedDate = Registry::getUtilsDate()->formatDBDate($reviewAndRating->getCreatedAt());

        $reviewAndRating->setCreatedAt($formattedDate);
    }

    /**
     * Sets object title to oeGdprReviewAndRating.
     *
     * @param oeGdprReviewAndRating $reviewAndRating
     */
    private function setObjectTitleToReviewAndRating(oeGdprReviewAndRating $reviewAndRating)
    {
        $title = $this->getObjectTitle(
            $reviewAndRating->getObjectType(),
            $reviewAndRating->getObjectId()
        );

        $reviewAndRating->setObjectTitle($title);
    }

    /**
     * Returns object title.
     *
     * @param string $type
     * @param string $objectId
     *
     * @return string
     */
    private function getObjectTitle($type, $objectId)
    {
        $objectModel = $this->getObjectModel($type);
        $objectModel->load($objectId);

        $fieldName = $this->getObjectTitleFieldName($type);
        $field = $objectModel->$fieldName;

        return $field->value;
    }

    /**
     * Returns object model.
     *
     * @param string $type
     *
     * @return oxArticle|oxRecommendationList
     * @throws oeGdprReviewAndRatingObjectTypeException
     */
    private function getObjectModel($type)
    {
        if ($type === 'oxarticle') {
            $model = oxNew('oxArticle');
        }

        if ($type === 'oxrecommlist') {
            $model = oxNew('oxRecommendationList');
        }

        if (!isset($model)) {
            throw new oeGdprReviewAndRatingObjectTypeException();
        }

        return $model;
    }

    /**
     * Returns field name of the object title.
     *
     * @param string $type
     *
     * @return string
     * @throws oeGdprReviewAndRatingObjectTypeException
     */
    private function getObjectTitleFieldName($type)
    {
        if ($type === 'oxarticle') {
            $fieldName = 'oxarticles__oxtitle';
        }

        if ($type === 'oxrecommlist') {
            $fieldName = 'oxrecommlists__oxtitle';
        }

        if (!isset($fieldName)) {
            throw new oeGdprReviewAndRatingObjectTypeException();
        }

        return $fieldName;
    }
}
