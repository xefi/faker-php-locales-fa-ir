<?php

namespace Xefi\Faker\FaIr\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    public function getLocale(): ?string
    {
        return 'fa_IR';
    }

    /**
     * Return an Iranian IBAN (شبا): 3-digit bank code followed by a 19-digit account number.
     *
     * @param string|null $countryCode
     * @param string|null $format
     *
     * @return string
     */
    public function iban(?string $countryCode = 'IR', ?string $format = null): string
    {
        if ($format === null) {
            $format = sprintf(
                '0%s%s',
                str_repeat('{d}', 2),
                str_repeat('{d}', 19)
            );
        }

        return parent::iban($countryCode, $format);
    }
}
