<?php

namespace App\Enum;

enum BookingStatus: int
{
    case CREATED = 0;
    case CONFIRMED = 1;
    case COMPLETED = 2;
    case CANCALED = 3;
    case RESCHEDULED = 4;

    public function label(): string
    {
        return match($this) {
            self::CREATED => 'Randevu oluşturuldu',
            self::CONFIRMED => 'Randevu talebi alınıp onaylandı',
            self::COMPLETED => 'Randevu katılımı gerçekleşti',
            self::CANCALED => 'Randevu katılımı gerçekleşmedi',
            self::RESCHEDULED => 'Randevu katılımı ertelendi',
        };
    }
}
