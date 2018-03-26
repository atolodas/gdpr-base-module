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

class oeGdprReviewServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetUserReviewAndRatingBridge()
    {
        $reviewServiceFactory = new oeGdprReviewServiceFactory();
        $userReviewAndRatingBridge = $reviewServiceFactory->getUserReviewAndRatingBridge();

        $this->assertInstanceOf(
            'oeGdprUserReviewAndRatingBridge',
            $userReviewAndRatingBridge
        );
    }

    public function testGetProductRatingBridge()
    {
        $reviewServiceFactory = new oeGdprReviewServiceFactory();
        $productRatingBridge = $reviewServiceFactory->getProductRatingBridge();

        $this->assertInstanceOf(
            'oeGdprProductRatingBridge',
            $productRatingBridge
        );
    }

    public function testGetUserRatingBridge()
    {
        $reviewServiceFactory = new oeGdprReviewServiceFactory();

        $this->assertInstanceOf(
            'oeGdprUserRatingBridge',
            $reviewServiceFactory->getUserRatingBridge()
        );
    }

    public function testGetUserReviewBridge()
    {
        $reviewServiceFactory = new oeGdprReviewServiceFactory();

        $this->assertInstanceOf(
            'oeGdprUserReviewBridge',
            $reviewServiceFactory->getUserReviewBridge()
        );
    }
}
