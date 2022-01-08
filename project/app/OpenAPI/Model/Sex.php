<?php
/**
 * Sex
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * OpenAPI Tutorial
 *
 * OpenAPI Tutorial by halhorn
 *
 * The version of the OpenAPI document: 0.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace App\OpenAPI\Model;
use App\OpenAPI\ObjectSerializer;

/**
 * Sex Class Doc Comment
 *
 * @category Class
 * @description man: 男 woman: 女
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Sex
{
    /**
     * Possible values of this enum
     */
    const MAN = 1;

    const WOMAN = 2;

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::MAN,
            self::WOMAN
        ];
    }
}


