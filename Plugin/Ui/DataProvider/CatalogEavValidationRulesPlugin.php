<?php

namespace Vendor\IncreaseSkuSize\Plugin\Ui\DataProvider;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Ui\DataProvider\CatalogEavValidationRules;

class CatalogEavValidationRulesPlugin
{
    const NEW_SKU_LENGTH = 255;
    public function beforeBuild(
        CatalogEavValidationRules $subject,
        ProductAttributeInterface $attribute,
        array $data
    ) {

        if ($attribute->getDefaultFrontendLabel() === 'SKU') {
            $frontendClass = $attribute->getFrontendClass();
            preg_match('/maximum-length-(\d+)/', $frontendClass, $matches);
            $frontendClass = str_replace($matches[1], self::NEW_SKU_LENGTH, $frontendClass);
            $attribute->setFrontendClass($frontendClass);
        }
        return [$attribute, $data];
    }

}