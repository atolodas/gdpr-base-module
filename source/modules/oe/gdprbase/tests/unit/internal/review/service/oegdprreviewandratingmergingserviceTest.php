<?php

class oeGdprReviewAndRatingMergingServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testMergingReviewWithRatingAndRatingWithReview()
    {
        $reviewAndRatingMergingService = new oeGdprReviewAndRatingMergingService();

        $reviews = array(
            $this->getReviewWithRating(),
        );

        $ratings = array(
            $this->getRatingWithReview(),
        );

        $reviewAndRatingList = $reviewAndRatingMergingService->mergeReviewAndRating(
            $reviews,
            $ratings
        );

        $expectedReviewAndRatingList = array(
            $this->getReviewAndRatingViewObjectWithReviewAndWithRating(),
        );

        $this->assertEquals(
            $expectedReviewAndRatingList,
            $reviewAndRatingList
        );
    }

    public function testMergingReviewWithoutRatingAndRatingWithoutReview()
    {
        $reviewAndRatingMergingService = new oeGdprReviewAndRatingMergingService();

        $reviews = array(
            $this->getReviewWithoutRating(),
        );

        $ratings = array(
            $this->getRatingWithoutReview(),
        );

        $reviewAndRatingList = $reviewAndRatingMergingService->mergeReviewAndRating(
            $reviews,
            $ratings
        );

        $expectedReviewAndRatingList = array(
            $this->getReviewAndRatingViewObjectWithReviewAndWithoutRating(),
            $this->getReviewAndRatingViewObjectWithoutReviewAndWithRating(),
        );

        $this->assertEquals(
            $expectedReviewAndRatingList,
            $reviewAndRatingList
        );
    }

    private function getReviewWithRating()
    {
        $review = new oeGdprReview();
        $review
            ->setId('reviewId1')
            ->setRating(5)
            ->setObjectId('1')
            ->setUserId('firstUserId')
            ->setText('With');

        return $review;
    }

    private function getReviewWithoutRating()
    {
        $review = new oeGdprReview();

        $review
            ->setId('reviewId2')
            ->setRating(0)
            ->setObjectId('1')
            ->setUserId('firstUserId')
            ->setText('Without');

        return $review;
    }

    private function getRatingWithReview()
    {
        $rating = new oeGdprRating();

        $rating
            ->setId('ratingId1')
            ->setRating(5)
            ->setUserId('firstUserId')
            ->setObjectId('1');

        return $rating;
    }

    private function getRatingWithoutReview()
    {
        $rating = new oeGdprRating();

        $rating
            ->setId('ratingId2')
            ->setRating(5)
            ->setUserId('secondUserId')
            ->setObjectId('1');

        return $rating;
    }

    private function getReviewAndRatingViewObjectWithReviewAndWithRating()
    {
        $reviewAndRating = new oeGdprReviewAndRating();
        $reviewAndRating
            ->setReviewId('reviewId1')
            ->setRatingId('ratingId1')
            ->setRating(5)
            ->setObjectId('1')
            ->setReviewText('With');

        return $reviewAndRating;
    }

    private function getReviewAndRatingViewObjectWithReviewAndWithoutRating()
    {
        $reviewAndRating = new oeGdprReviewAndRating();
        $reviewAndRating
            ->setReviewId('reviewId2')
            ->setRatingId(false)
            ->setRating(false)
            ->setObjectId('1')
            ->setReviewText('Without');

        return $reviewAndRating;
    }

    private function getReviewAndRatingViewObjectWithoutReviewAndWithRating()
    {
        $reviewAndRating = new oeGdprReviewAndRating();
        $reviewAndRating
            ->setReviewId(false)
            ->setRatingId('ratingId2')
            ->setRating(5)
            ->setObjectId('1')
            ->setReviewText(false);

        return $reviewAndRating;
    }
}
