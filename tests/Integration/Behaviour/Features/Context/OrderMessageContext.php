<?php
/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace Tests\Integration\Behaviour\Features\Context;

use RuntimeException;

class OrderMessageContext extends AbstractPrestaShopFeatureContext
{
    /**
     * @Then order message :reference :propertyName in default language should be :propertyValue
     */
    public function assertPropertyInDefaultLanguage(string $reference, string $propertyName, string $propertyValue)
    {
        /** @var \OrderMessage $orderMessage */
        $orderMessage = SharedStorage::getStorage()->get($reference);

        $defaultLangId = CommonFeatureContext::getContainer()
            ->get('prestashop.adapter.legacy.configuration')
            ->get('PS_LANG_DEFAULT');

        $actualValue = $orderMessage->{$propertyName}[$defaultLangId];

        if ($actualValue !== $propertyValue) {
            throw new RuntimeException(sprintf('Order message "%d" property "%s" was expected to have value "%s", but has "%s" instead', $orderMessage->id, $propertyName, $propertyValue, $actualValue));
        }
    }
}
