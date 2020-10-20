<?php

namespace App\Constants;

final class POSStatus
{

    const CASH = 1;
    const INSTALLMENT = 2;
    const DEPOSIT = 3;

    /**
     * list all predefined user types
     *
     *
     * @return array of types
     */
    public static function getList()
    {
        return [
            self::CASH => "Cash",
            self::INSTALLMENT => "Installment",
            self::DEPOSIT => "Deposit",
        ];
    }

    public static function getKeys()
    {
        return array_keys(self::getList());
    }

    public static function getLabel($status)
    {
        return array_key_exists($status, self::getList()) ?self::getList()[$status] : "";
    }
}
