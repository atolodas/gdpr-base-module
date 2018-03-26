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
class oeGdprReviewServiceFactory
{
    /**
     * @var oeGdprUserReviewAndRatingBridge
     */
    private $userReviewAndRatingBridge;

    /**
     * @var oeGdprProductRatingBridge
     */
    private $productRatingBridge;

    /**
     * @var oeGdprUserReviewBridge
     */
    private $userReviewBridge;

    /**
     * @var oeGdprUserRatingBridge
     */
    private $userRatingBridge;

    /**
     * @var oeGdprUserReviewAndRatingService
     */
    private $userReviewAndRatingService;

    /**
     * @var oeGdprUserReviewService
     */
    private $userReviewService;

    /**
     * @var oeGdprUserRatingService
     */
    private $userRatingService;

    /**
     * @var oeGdprReviewAndRatingMergingService
     */
    private $reviewAndRatingMergingService;

    /**
     * @var oeGdprProductRatingService
     */
    private $productRatingService;

    /**
     * @var oeGdprReviewDao
     */
    private $reviewDao;

    /**
     * @var oeGdprRatingDao
     */
    private $ratingDao;

    /**
     * @var oeGdprProductRatingDao
     */
    private $productRatingDao;

    /**
     * @var oeGdprRatingCalculatorService
     */
    private $ratingCalculator;

    /**
     * @return oeGdprUserReviewAndRatingBridge
     */
    public function getUserReviewAndRatingBridge()
    {
        if (!$this->userReviewAndRatingBridge) {
            $this->userReviewAndRatingBridge = new oeGdprUserReviewAndRatingBridge(
                $this->getUserReviewAndRatingService()
            );
        }

        return $this->userReviewAndRatingBridge;
    }

    /**
     * @return oeGdprProductRatingBridge
     */
    public function getProductRatingBridge()
    {
        if (!$this->productRatingBridge) {
            $this->productRatingBridge = new oeGdprProductRatingBridge(
                $this->getProductRatingService()
            );
        }

        return $this->productRatingBridge;
    }

    /**
     * @return oeGdprUserRatingBridge
     */
    public function getUserRatingBridge()
    {
        if (!$this->userRatingBridge) {
            $this->userRatingBridge = new oeGdprUserRatingBridge(
                $this->getUserRatingService()
            );
        }

        return $this->userRatingBridge;
    }

    /**
     * @return oeGdprUserReviewBridge
     */
    public function getUserReviewBridge()
    {
        if (!$this->userReviewBridge) {
            $this->userReviewBridge = new oeGdprUserReviewBridge(
                $this->getUserReviewService()
            );
        }

        return $this->userReviewBridge;
    }

    /**
     * @return oeGdprProductRatingService
     */
    private function getProductRatingService()
    {
        if (!$this->productRatingService) {
            $this->productRatingService = new oeGdprProductRatingService(
                $this->getRatingDao(),
                $this->getProductRatingDao(),
                $this->getRatingCalculator()
            );
        }

        return $this->productRatingService;
    }

    /**
     * @return oeGdprProductRatingDao
     */
    private function getProductRatingDao()
    {
        if (!$this->productRatingDao) {
            $this->productRatingDao = new oeGdprProductRatingDao($this->getDatabase());
        }

        return $this->productRatingDao;
    }

    /**
     * @return oeGdprRatingCalculatorService
     */
    private function getRatingCalculator()
    {
        if (!$this->ratingCalculator) {
            $this->ratingCalculator = new oeGdprRatingCalculatorService();
        }

        return $this->ratingCalculator;
    }

    /**
     * @return oeGdprUserReviewAndRatingService
     */
    private function getUserReviewAndRatingService()
    {
        if (!$this->userReviewAndRatingService) {
            $this->userReviewAndRatingService = new oeGdprUserReviewAndRatingService(
                $this->getUserReviewService(),
                $this->getUserRatingService(),
                $this->getReviewAndRatingMergingService()
            );
        }

        return $this->userReviewAndRatingService;
    }

    /**
     * @return oeGdprUserReviewService
     */
    private function getUserReviewService()
    {
        if (!$this->userReviewService) {
            $this->userReviewService = new oeGdprUserReviewService(
                $this->getReviewDao()
            );
        }

        return $this->userReviewService;
    }

    /**
     * @return oeGdprReviewDao
     */
    private function getReviewDao()
    {
        if (!$this->reviewDao) {
            $this->reviewDao = new oeGdprReviewDao(
                $this->getDatabase()
            );
        }

        return $this->reviewDao;
    }

    /**
     * @return oeGdprUserRatingService
     */
    private function getUserRatingService()
    {
        if (!$this->userRatingService) {
            $this->userRatingService = new oeGdprUserRatingService(
                $this->getRatingDao()
            );
        }

        return $this->userRatingService;
    }

    /**
     * @return oeGdprRatingDao
     */
    private function getRatingDao()
    {
        if (!$this->ratingDao) {
            $this->ratingDao = new oeGdprRatingDao(
                $this->getDatabase()
            );
        }

        return $this->ratingDao;
    }

    /**
     * @return oeGdprReviewAndRatingMergingService
     */
    private function getReviewAndRatingMergingService()
    {
        if (!$this->reviewAndRatingMergingService) {
            $this->reviewAndRatingMergingService = new oeGdprReviewAndRatingMergingService();
        }

        return $this->reviewAndRatingMergingService;
    }

    /**
     * @return Database
     */
    private function getDatabase()
    {
        return oxDb::getDb();
    }
}
