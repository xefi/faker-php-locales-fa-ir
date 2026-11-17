<?php

namespace Xefi\Faker\FaIr\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    public function getLocale(): ?string
    {
        return 'fa_IR';
    }

    private array $companies = [
        'شرکت پارس نوین (سهامی خاص)', 'شرکت آریا صنعت (سهامی عام)', 'شرکت البرز گستر (با مسئولیت محدود)',
        'شرکت کاوش داده (سهامی خاص)', 'شرکت خلیج فارس ترابر (سهامی خاص)', 'شرکت سپید مهر (با مسئولیت محدود)',
        'شرکت زاگرس فولاد (سهامی عام)', 'شرکت نگین سبز (سهامی خاص)', 'شرکت دماوند انرژی (سهامی عام)',
        'شرکت آسمان آبی (با مسئولیت محدود)', 'شرکت ستاره کویر (سهامی خاص)', 'شرکت رایان پردازش (سهامی خاص)',
        'شرکت کیان تجارت (با مسئولیت محدود)', 'شرکت مهر آفرین (سهامی خاص)', 'شرکت توس صنعت (سهامی عام)',
        'شرکت هامون کشت (تعاونی)', 'شرکت سیمرغ ارتباطات (سهامی خاص)', 'شرکت ارغوان طب (با مسئولیت محدود)',
        'شرکت آفتاب شرق (سهامی خاص)', 'شرکت بهار نارنج (با مسئولیت محدود)', 'شرکت پیشگامان فناوری (سهامی خاص)',
        'شرکت کارون پترو (سهامی عام)', 'شرکت فیروزه ساختمان (سهامی خاص)', 'شرکت نیلوفر بافت (با مسئولیت محدود)',
        'شرکت اندیشه برتر (سهامی خاص)', 'شرکت سرو سامان (تعاونی)', 'شرکت آوای پارسیان (سهامی خاص)',
        'شرکت گلستان غذا (سهامی عام)', 'شرکت تندیس معماری (با مسئولیت محدود)', 'شرکت ماهور پخش (سهامی خاص)',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Return a legal entity national identifier (شناسه ملی, 11 digits with one check digit).
     *
     * @return string
     */
    public function shenaseMelli(): string
    {
        $id = sprintf(
            '1%d%d%06d%d',
            $this->pickArrayRandomElement([0, 4]),
            $this->randomizer->getInt(0, 9),
            $this->randomizer->getInt(1, 999999),
            $this->randomizer->getInt(0, 9)
        );

        $offset = (int) $id[9] + 2;
        $coefficients = [29, 27, 23, 19, 17];

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += ((int) $id[$i] + $offset) * $coefficients[$i % 5];
        }

        return $id.($sum % 11 % 10);
    }
}
