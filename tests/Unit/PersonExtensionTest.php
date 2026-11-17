<?php

namespace Xefi\Faker\FaIr\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\FaIr\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameFemale, $results);
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->firstNameMale, $results);
    }

    public function testFirstName(): void
    {
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));

        $results = [];
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing($firstNames, $results);
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing($this->lastName, $results);
    }

    public function testNameMale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE));

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE));

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name());

            $this->assertContains($firstName, array_merge($this->firstNameMale, $this->firstNameFemale));
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing($this->titleFemale, $results);
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing($this->titleMale, $results);
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing($titles, $results);
    }

    public function testCodeMelliChecksumValidatorAcceptsKnownCodes(): void
    {
        $this->assertTrue($this->isValidCodeMelli('0499370899'));
        $this->assertTrue($this->isValidCodeMelli('0084575948'));
        $this->assertFalse($this->isValidCodeMelli('0499370898'));
    }

    public function testCodeMelli(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $code = $this->faker->codeMelli();

            $this->assertMatchesRegularExpression('/^\d{10}$/', $code);
            $this->assertNotSame('000', substr($code, 0, 3));
            $this->assertTrue($this->isValidCodeMelli($code));
        }
    }

    private function isValidCodeMelli(string $code): bool
    {
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $code[$i] * (10 - $i);
        }

        $remainder = $sum % 11;

        return ($remainder < 2 ? $remainder : 11 - $remainder) === (int) $code[9];
    }
}
