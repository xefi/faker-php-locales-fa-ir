<?php

namespace Xefi\Faker\FaIr;

use Xefi\Faker\FaIr\Extensions\AddressExtension;
use Xefi\Faker\FaIr\Extensions\ColorsExtension;
use Xefi\Faker\FaIr\Extensions\CompanyExtension;
use Xefi\Faker\FaIr\Extensions\FinancialExtension;
use Xefi\Faker\FaIr\Extensions\PersonExtension;
use Xefi\Faker\FaIr\Extensions\PhoneExtension;
use Xefi\Faker\FaIr\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerFaIrServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
