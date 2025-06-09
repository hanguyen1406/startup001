<?php

namespace App\Factories;

use App\Interfaces\TravelInterface;
use App\Services\Travel\TicketService;
// Sẽ thêm các Service khác ở đây
// use App\Services\Travel\Services\TransportationService;
// use App\Services\Travel\Services\HotelService;

class TravelFactory
{
    public static function create(string $type): ?TravelInterface
    {
        switch (strtolower($type)) {
            case 'travel':
                return new TicketService();
            // Thêm các loại dịch vụ khác ở đây
            // case 'transportation':
            //     return new TransportationService();
            // case 'hotel':
            //     return new HotelService();
            default:
                return null;
        }
    }
}