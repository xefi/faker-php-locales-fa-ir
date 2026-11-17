<?php

namespace Xefi\Faker\FaIr\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0(9\d{9}|[1-7]\d{9})$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^09\d{9}$/', $this->faker->cellPhoneNumber());
            $this->assertMatchesRegularExpression('/^09\d{2} \d{3} \d{4}$/', $this->faker->spacedCellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0(21|26|31|41|51|61|71|13) \d{4} \d{4}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+98[1-79]\d{9}$/', $this->faker->indicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+98 9\d{2} \d{3} \d{4}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+98-\d{2}-\d{4}-\d{4}$/', $this->faker->dashedIndicatoredLandlinePhoneNumber());
        }
    }
}
