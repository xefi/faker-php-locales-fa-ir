<?php

namespace Xefi\Faker\FaIr\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'fa_IR';
    }

    protected $provinces = [
        'آذربایجان شرقی', 'آذربایجان غربی', 'اردبیل', 'اصفهان', 'البرز', 'ایلام', 'بوشهر', 'تهران',
        'چهارمحال و بختیاری', 'خراسان جنوبی', 'خراسان رضوی', 'خراسان شمالی', 'خوزستان', 'زنجان', 'سمنان',
        'سیستان و بلوچستان', 'فارس', 'قزوین', 'قم', 'کردستان', 'کرمان', 'کرمانشاه', 'کهگیلویه و بویراحمد',
        'گلستان', 'گیلان', 'لرستان', 'مازندران', 'مرکزی', 'هرمزگان', 'همدان', 'یزد',
    ];

    protected $cities = [
        'تهران', 'مشهد', 'اصفهان', 'کرج', 'شیراز', 'تبریز', 'قم', 'اهواز', 'کرمانشاه', 'ارومیه',
        'رشت', 'زاهدان', 'همدان', 'کرمان', 'یزد', 'اردبیل', 'بندرعباس', 'اراک', 'زنجان', 'سنندج',
        'قزوین', 'خرم‌آباد', 'گرگان', 'ساری', 'بوشهر', 'بیرجند', 'ایلام', 'شهرکرد', 'سمنان', 'یاسوج',
        'بجنورد', 'کاشان', 'دزفول', 'آمل', 'نیشابور',
    ];

    protected $streetTypes = ['خیابان', 'بلوار', 'کوچه', 'میدان', 'بزرگراه'];

    protected $streetNames = [
        'ولیعصر', 'انقلاب', 'آزادی', 'شریعتی', 'فردوسی', 'حافظ', 'سعدی', 'مولوی', 'خیام', 'ابن سینا',
        'جمهوری', 'طالقانی', 'کارگر', 'پاسداران', 'نیاوران', 'ستارخان', 'گلستان', 'بهار', 'نارنجستان', 'لاله',
        'نسترن', 'یاس', 'شقایق', 'سرو', 'دماوند', 'پیروزی', 'نیایش', 'فاطمی', 'هفت تیر', 'سهروردی',
        'میرداماد', 'ونک', 'صادقیه', 'کریمخان زند', 'امیرکبیر', 'باهنر', 'چمران', 'فرشته', 'زعفرانیه', 'شهرزاد',
    ];

    /**
     * Return a random province (استان).
     *
     * @return string
     */
    public function province(): string
    {
        return $this->pickArrayRandomElement($this->provinces);
    }

    /**
     * Return a random city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    /**
     * Return a random ten-digit postcode (no 0 or 2 in the first five digits, no 5 in the fifth, no 2 afterwards).
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->randomizer->getBytesFromString('13456789', 4)
            .$this->randomizer->getBytesFromString('1346789', 1)
            .$this->randomizer->getBytesFromString('013456789', 5);
    }

    /**
     * Return a random building number (پلاک).
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 200);
    }

    /**
     * Return a random street name, prefixed with its type.
     *
     * @return string
     */
    public function streetName(): string
    {
        $streetType = $this->pickArrayRandomElement($this->streetTypes);
        $name = $this->pickArrayRandomElement($this->streetNames);

        return sprintf('%s %s', $streetType, $name);
    }

    /**
     * Return a street name followed by a building number.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s، پلاک %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Return a full address from the most general to the most specific part, ending with the postcode.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        return sprintf(
            '%s، %s، واحد %d، کد پستی %s',
            $this->city(),
            $this->streetAddress(),
            $this->randomizer->getInt(1, 30),
            $this->postcode()
        );
    }
}
