<?php

namespace Xefi\Faker\FaIr\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $defaultPrefix = '0';

    public string $indicator = '+98';

    public function getLocale(): ?string
    {
        return 'fa_IR';
    }

    protected array $landlineFormats = [
        '21{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '26{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '31{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '41{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '51{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '61{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '71{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '13{separator}{d}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '9{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    /**
     * Generate a phone number; the international indicator is followed by the separator, the trunk 0 is not.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
