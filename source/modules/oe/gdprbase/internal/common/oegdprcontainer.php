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
class oeGdprContainer
{
    /**
     * @var oeGdprContainer
     */
    private static $instance;

    /**
     * @var oeGdprReviewServiceFactory
     */
    private $reviewServiceFactory;

    /**
     * oeGdprContainer constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @return oeGdprContainer
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return oeGdprUserReviewAndRatingBridge
     */
    public function getUserReviewAndRatingBridge()
    {
        return $this
            ->getReviewServiceFactory()
            ->getUserReviewAndRatingBridge();
    }

    /**
     * @return oeGdprProductRatingBridgeInterface
     */
    public function getProductRatingBridge()
    {
        return $this
            ->getReviewServiceFactory()
            ->getProductRatingBridge();
    }

    /**
     * @return oeGdprUserRatingBridge
     */
    public function getUserRatingBridge()
    {
        return $this
            ->getReviewServiceFactory()
            ->getUserRatingBridge();
    }

    /**
     * @return oeGdprUserReviewBridge
     */
    public function getUserReviewBridge()
    {
        return $this
            ->getReviewServiceFactory()
            ->getUserReviewBridge();
    }

    /**
     * @return oeGdprReviewServiceFactory
     */
    private function getReviewServiceFactory()
    {
        if (!$this->reviewServiceFactory) {
            $this->reviewServiceFactory = new oeGdprReviewServiceFactory();
        }

        return $this->reviewServiceFactory;
    }
}
