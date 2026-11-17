<?php

namespace Xefi\Faker\FaIr\Tests\Unit;

use Random\Randomizer;
use Xefi\Faker\FaIr\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new \ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompaniesHaveALegalForm(): void
    {
        foreach ($this->companies as $company) {
            $this->assertMatchesRegularExpression('/^شرکت .+ \((سهامی خاص|سهامی عام|با مسئولیت محدود|تعاونی)\)$/u', $company);
        }
    }

    public function testShenaseMelliChecksumValidatorAcceptsAKnownIdentifier(): void
    {
        $this->assertTrue($this->isValidShenaseMelli('10380284790'));
        $this->assertFalse($this->isValidShenaseMelli('10380284791'));
    }

    public function testShenaseMelli(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $id = $this->faker->shenaseMelli();

            $this->assertMatchesRegularExpression('/^1[04]\d{9}$/', $id);
            $this->assertNotSame('000000', substr($id, 3, 6));
            $this->assertTrue($this->isValidShenaseMelli($id));
        }
    }

    private function isValidShenaseMelli(string $id): bool
    {
        $offset = (int) $id[9] + 2;
        $coefficients = [29, 27, 23, 19, 17];

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += ((int) $id[$i] + $offset) * $coefficients[$i % 5];
        }

        $remainder = $sum % 11;

        return ($remainder === 10 ? 0 : $remainder) === (int) $id[10];
    }
}
