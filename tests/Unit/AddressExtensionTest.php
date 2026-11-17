<?php

namespace Xefi\Faker\FaIr\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\FaIr\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $provinces = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($extension);

        $this->provinces = $reflection->getProperty('provinces')->getValue($extension);
        $this->cities = $reflection->getProperty('cities')->getValue($extension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($extension);
    }

    public function testProvincesCoverEveryOstan(): void
    {
        $this->assertCount(31, array_unique($this->provinces));
    }

    public function testProvince(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->province();
        }

        $this->assertEqualsCanonicalizing($this->provinces, $results);
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing($this->cities, $results);
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[13-9]{4}[1346-9][013-9]{5}$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertGreaterThanOrEqual(1, $result);
            $this->assertLessThanOrEqual(200, $result);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$type, $name] = explode(' ', $this->faker->streetName(), 2);

            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$street, $plate] = explode('، ', $this->faker->streetAddress());

            [$type, $name] = explode(' ', $street, 2);
            $this->assertContains($type, $this->streetTypes);
            $this->assertContains($name, $this->streetNames);
            $this->assertMatchesRegularExpression('/^پلاک \d{1,3}$/u', $plate);
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $parts = explode('، ', $this->faker->fullAddress());

            $this->assertCount(5, $parts);
            $this->assertContains($parts[0], $this->cities);
            $this->assertContains(explode(' ', $parts[1], 2)[0], $this->streetTypes);
            $this->assertMatchesRegularExpression('/^پلاک \d{1,3}$/u', $parts[2]);
            $this->assertMatchesRegularExpression('/^واحد \d{1,2}$/u', $parts[3]);
            $this->assertMatchesRegularExpression('/^کد پستی [13-9]{4}[1346-9][013-9]{5}$/u', $parts[4]);
        }
    }
}
