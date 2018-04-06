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

class oeGdprBaseOxUserTest extends OxidTestCase
{
    public function testDelete()
    {
        $oDb = $this->getDb();

        $oUser = $this->createUser();
        $sUserId = $oUser->getId();

        // user address
        $oAddress = oxNew('oxAddress');
        $oAddress->setId("_testAddress");
        $oAddress->oxaddress__oxuserid = new oxField($sUserId);
        $oAddress->save();

        // user groups
        $o2g = oxNew('oxBase');
        $o2g->init("oxobject2group");
        $o2g->setId("_testO2G");
        $o2g->oxobject2group__oxobjectid = new oxField($sUserId);
        $o2g->oxobject2group__oxgroupsid = new oxField($sUserId);
        $o2g->save();

        // notice/wish lists
        $oU2B = oxNew('oxBase');
        $oU2B->init("oxuserbaskets");
        $oU2B->setId("_testU2B");
        $oU2B->oxuserbaskets__oxuserid = new oxField($sUserId);
        $oU2B->save();

        // newsletter subscription
        $oNewsSubs = oxNew('oxBase');
        $oNewsSubs->init("oxnewssubscribed");
        $oNewsSubs->setId("_testNewsSubs");
        $oNewsSubs->oxnewssubscribed__oxemail = new oxField($sUserId);
        $oNewsSubs->oxnewssubscribed__oxuserid = new oxField($sUserId);
        $oNewsSubs->save();

        // delivery and delivery sets
        $o2d = oxNew('oxBase');
        $o2d->init("oxobject2delivery");
        $o2d->setId("_testo2d");
        $o2d->oxobject2delivery__oxobjectid = new oxField($sUserId);
        $o2d->oxobject2delivery__oxdeliveryid = new oxField($sUserId);
        $o2d->save();

        // discounts
        $o2d = oxNew('oxBase');
        $o2d->init("oxobject2discount");
        $o2d->setId("_testo2d");
        $o2d->oxobject2discount__oxobjectid = new oxField($sUserId);
        $o2d->oxobject2discount__oxdiscountid = new oxField($sUserId);
        $o2d->save();

        // order information
        $oRemark = oxNew('oxBase');
        $oRemark->init("oxremark");
        $oRemark->setId("_testRemark");
        $oRemark->oxremark__oxparentid = new oxField($sUserId);
        $oRemark->oxremark__oxtype = new oxField('r');
        $oRemark->save();

        $recommendationList = oxNew('oxrecommlist');
        $recommendationList->setId("_testRecommendationList");
        $recommendationList->oxrecommlists__oxuserid = new oxField($sUserId);
        $recommendationList->oxrecommlists__oxshopid = new oxField($this->getShopId());
        $recommendationList->oxrecommlists__oxtitle = new oxField("Test title");
        $recommendationList->save();

        $rating = oxNew('oxRating');
        $rating->setId("_testRating");
        $rating->oxratings__oxuserid = new oxField($sUserId);
        $rating->oxratings__oxrating = new oxField(5);
        $rating->save();

        $review = oxNew('oxReview');
        $review->setId("_testReview");
        $review->oxreviews__oxuserid = new oxField($sUserId);
        $review->oxreviews__oxtext = new oxField("Supergood");
        $review->save();

        $priceAlarm = oxNew('oxPricealarm');
        $priceAlarm->setId("_testPriceAlarm");
        $priceAlarm->oxpricealarm__oxuserid = new oxField($sUserId);
        $priceAlarm->save();

        $userPayment = oxNew('oxUserPayment');
        $userPayment->setId("_testUserPayment");
        $userPayment->oxuserpayments__oxuserid = new oxField($sUserId);
        $userPayment->save();

        $oDb->execute("INSERT INTO oxacceptedterms (oxuserid) VALUES(?)", array($sUserId));

        $oUser = oxNew('oxUser');
        $oUser->load($sUserId);
        $bSuccess = $oUser->delete();

        $this->assertEquals(true, $bSuccess);

        $aWhat = array('oxuser'            => 'oxid',
            'oxaddress'         => 'oxuserid',
            'oxuserbaskets'     => 'oxuserid',
            'oxnewssubscribed'  => 'oxuserid',
            'oxrecommlists'     => 'oxuserid',
            'oxreviews'         => 'oxuserid',
            'oxratings'         => 'oxuserid',
            'oxpricealarm'      => 'oxuserid',
            'oxuserpayments'    => 'oxuserid',
            'oxacceptedterms'   => 'oxuserid',
            'oxobject2delivery' => 'oxobjectid',
            'oxobject2discount' => 'oxobjectid',
            'oxobject2group'    => 'oxobjectid',
            'oxobject2payment'  => 'oxobjectid',
            // all order information must be preserved
            'oxremark'          => 'oxparentid',
        );

        // now checking if all related records were deleted
        foreach ($aWhat as $sTable => $sField) {
            $sQ = 'select count(*) from ' . $sTable . ' where ' . $sField . ' = "' . $sUserId . '" ';

            if ($sTable == 'oxremark') {
                $sQ .= " AND oxtype ='o'";
            }

            $iCnt = $oDb->getOne($sQ);
            if ($iCnt > 0) {
                $this->fail($iCnt . ' records were not deleted from "' . $sTable . '" table');
            }
        }
    }

    /**
     * Creates user.
     *
     * @param string $sUserName
     * @param int    $iActive
     * @param string $sRights either user or malladmin
     * @param int    $sShopId User shop ID
     *
     * @return oxUser
     */
    protected function createUser($sUserName = null, $iActive = 1, $sRights = 'user', $sShopId = null)
    {
        $oUtils = oxRegistry::getUtils();
        $oDb = $this->getDb();

        $iLastNr = count($this->_aUsers) + 1;

        if (is_null($sShopId)) {
            $sShopId = $this->getConfig()->getShopId();
        }

        $oUser = oxNew('oxUser');
        $oUser->oxuser__oxshopid = new oxField($sShopId, oxField::T_RAW);
        $oUser->oxuser__oxactive = new oxField($iActive, oxField::T_RAW);
        $oUser->oxuser__oxrights = new oxField($sRights, oxField::T_RAW);

        // setting name
        $sUserName = $sUserName ? $sUserName : 'test' . $iLastNr . '@oxid-esales.com';
        $oUser->oxuser__oxusername = new oxField($sUserName, oxField::T_RAW);
        $oUser->oxuser__oxpassword = new oxField(crc32($sUserName), oxField::T_RAW);
        $oUser->oxuser__oxcountryid = new oxField("testCountry", oxField::T_RAW);
        $oUser->save();

        $sUserId = $oUser->getId();
        $sId = oxUtilsObject::getInstance()->generateUID();

        // loading user groups
        $sGroupId = $oDb->getOne('select oxid from oxgroups order by rand() ');
        $sQ = 'REPLACE INTO oxobject2group (oxid,oxshopid,oxobjectid,oxgroupsid) VALUES ( "' . $sUserId . '", "' . $sShopId . '", "' . $sUserId . '", "' . $sGroupId . '" )';
        $oDb->Execute($sQ);

        $sQ = 'insert into oxorder ( oxid, oxshopid, oxuserid, oxorderdate ) values ( "' . $sId . '", "' . $sShopId . '", "' . $sUserId . '", "' . date('Y-m-d  H:i:s', time() + 3600) . '" ) ';
        $oDb->Execute($sQ);

        // adding article to order
        $sArticleID = $oDb->getOne('select oxid from oxarticles order by rand() ');
        $sQ = 'insert into oxorderarticles ( oxid, oxorderid, oxamount, oxartid, oxartnum ) values ( "' . $sId . '", "' . $sId . '", 1, "' . $sArticleID . '", "' . $sArticleID . '" ) ';
        $oDb->Execute($sQ);

        // adding article to basket
        $sQ = 'insert into oxuserbaskets ( oxid, oxuserid, oxtitle ) values ( "' . $sUserId . '", "' . $sUserId . '", "oxtest" ) ';
        $oDb->Execute($sQ);

        $sArticleID = $oDb->getOne('select oxid from oxarticles order by rand() ');
        $sQ = 'insert into oxuserbasketitems ( oxid, oxbasketid, oxartid, oxamount ) values ( "' . $sUserId . '", "' . $sUserId . '", "' . $sArticleID . '", "1" ) ';
        $oDb->Execute($sQ);

        // creating test address
        $sCountryId = $oDb->getOne('select oxid from oxcountry where oxactive = "1"');
        $sQ = 'insert into oxaddress ( oxid, oxuserid, oxaddressuserid, oxcountryid ) values ( "test_user' . $iLastNr . '", "' . $sUserId . '", "' . $sUserId . '", "' . $sCountryId . '" ) ';
        $oDb->Execute($sQ);

        // creating test executed user payment
        $aDynValue = $this->_aDynPaymentFields;
        $oPayment = oxNew('oxPayment');
        $oPayment->load('oxidcreditcard');
        $oPayment->setDynValues($oUtils->assignValuesFromText($oPayment->oxpayments__oxvaldesc->value, true, true, true));

        $aDynValues = $oPayment->getDynValues();
        while (list($key, $oVal) = each($aDynValues)) {
            $oVal = new oxField($aDynValue[$oVal->name], oxField::T_RAW);
            $oPayment->setDynValue($key, $oVal);
            $aDynVal[$oVal->name] = $oVal->value;
        }

        $sDynValues = '';
        if (isset($aDynVal)) {
            $sDynValues = $oUtils->assignValuesToText($aDynVal);
        }

        $sQ = 'insert into oxuserpayments ( oxid, oxuserid, oxpaymentsid, oxvalue ) values ( "' . $sId . '", "' . $sUserId . '", "oxidcreditcard", "' . $sDynValues . '" ) ';
        $oDb->Execute($sQ);

        $this->_aUsers[$sUserId] = $oUser;

        return $oUser;
    }
}
