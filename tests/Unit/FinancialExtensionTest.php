<?php

namespace Xefi\Faker\FaIr\Tests\Unit;

use Xefi\Faker\Calculators\Iban;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertEquals(26, strlen($iban));
            $this->assertMatchesRegularExpression('/^IR\d{2}0\d{21}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
