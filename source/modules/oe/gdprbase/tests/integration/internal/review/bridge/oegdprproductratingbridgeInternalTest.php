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

class oeGdprProductRatingBridgeTest extends OxidTestCase
{
    public function testUpdateProductRating()
    {
        $this->createTestProduct();

        $productRatingDao = $this->getProductRatingDao();
        $productRatingBridge = $this->getProductRatingBridge();

        $productRatingBridge->updateProductRating('testId');

        $productRating = $productRatingDao->getProductRatingById('testId');

        $this->assertEquals(
            4,
            $productRating->getRatingAverage()
        );

        $this->assertEquals(
            3,
            $productRating->getRatingCount()
        );
    }

    private function createTestProduct()
    {
        $product = oxNew('oxArticle');
        $product->setId('testId');
        $product->save();
    }

    private function getProductRatingBridge()
    {
        return new oeGdprProductRatingBridge(
            $this->getProductRatingService()
        );
    }

    private function getProductRatingService()
    {
        return new oeGdprProductRatingService(
            $this->getRatingDaoMock(),
            $this->getProductRatingDao(),
            new oeGdprRatingCalculatorService()
        );
    }

    private function getProductRatingDao()
    {
        $database = oxDb::getDb();

        return new oeGdprProductRatingDao($database);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RatingDaoInterface
     */
    private function getRatingDaoMock()
    {
        $rating1 = new oeGdprRating();
        $rating1->setRating(5);

        $rating2 = new oeGdprRating();
        $rating2->setRating(4);

        $rating3 = new oeGdprRating();
        $rating3->setRating(3);

        $ratingDaoMock = $this
            ->getMockBuilder('oeGdprRatingDao')
            ->disableOriginalConstructor()
            ->getMock();

        $ratingDaoMock
            ->method('getRatingsByProductId')
            ->willReturn(
                array(
                    $rating1,
                    $rating2,
                    $rating3,
                )
            );

        return $ratingDaoMock;
    }
}