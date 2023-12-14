<?php
return [
    "services" => [
            [
                "id" => 1,
                "name" => "Anbessa",
                "icon" => "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg",
                "command_name" => "fetch-anbessa",
                "addr" => null,
                "contact" => null,
                "lat" => null,
                "lng" => null,
                "is_discount" => 0,
                "is_fixed_discount" => 0,
                "discount_rate" => "0.02",
                "created_at" => null,
                "updated_at" => null,
                "parent_id" => null,
                "agency_id" => null,
                "is_hidden" => 0,
                "charges" => null
            ],
            [
                "id" => 194,
                "name" => "Anbessa",
                "icon" => null,
                "command_name" => "fetch-sasta-ticket",
                "addr" => null,
                "contact" => null,
                "lat" => null,
                "lng" => null,
                "is_discount" => 0,
                "is_fixed_discount" => 0,
                "discount_rate" => "0.00",
                "created_at" => "2022-08-17 06:37:48",
                "updated_at" => "2022-11-02 13:01:39",
                "parent_id" => null,
                "agency_id" => null,
                "is_hidden" => 0,
                "charges" => null
            ]
    ],
    "cities" => [
            [
                "id" => 1,
                "bus_service_city_id" => 36,
                "bus_service_id" => 1,
                "name" => "Addis Ababa",
                "short_name" => "AA",
                "hidden" => 0,
                "alias" => 41,
                "created_at" => "2021-04-02 11:32:57",
                "updated_at" => "2022-08-22 07:57:36",
                "latitude" => null,
                "longitude" => null,
                "radius" => null
            ],
            [
                "id" => 2,
                "bus_service_city_id" => 63,
                "bus_service_id" => 1,
                "name" => "Bahir Dar",
                "short_name" => "BD",
                "hidden" => 0,
                "alias" => 1,
                "created_at" => "2021-04-02 11:33:02",
                "updated_at" => "2022-08-17 07:40:05",
                "latitude" => null,
                "longitude" => null,
                "radius" => null
            ],
            [
                "id" => 3,
                "bus_service_city_id" => 6,
                "bus_service_id" => 1,
                "name" => "Gondar",
                "short_name" => "GN",
                "hidden" => 0,
                "alias" => 3,
                "created_at" => "2021-04-02 11:32:57",
                "updated_at" => "2022-08-17 07:40:05",
                "latitude" => null,
                "longitude" => null,
                "radius" => null
            ],
    ],
    "routes" => [
            [
                "id"=> 1,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 41
            ],
            [
                "id"=> 3,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 43
            ],
            [
                "id"=> 4,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 44
            ],
            [
                "id"=> 5,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 45
            ],
            [
                "id"=> 7,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 47
            ],
            [
                "id"=> 8,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 48
            ],
            [
                "id"=> 9,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 49
            ],
            [
                "id"=> 12,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 52
            ],
            [
                "id"=> 14,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 54
            ],
            [
                "id"=> 15,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 55
            ],
            [
                "id"=> 17,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 57
            ],
            [
                "id"=> 18,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 58
            ],
            [
                "id"=> 19,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 59
            ],
            [
                "id"=> 23,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 63
            ],
            [
                "id"=> 26,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 66
            ],
            [
                "id"=> 30,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 70
            ],
            [
                "id"=> 31,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 71
            ],
            [
                "id"=> 35,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 75
            ],
            [
                "id"=> 36,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 76
            ],
            [
                "id"=> 37,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 77
            ],
            [
                "id"=> 39,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 79
            ],
            [
                "id"=> 40,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 80
            ],
            [
                "id"=> 42,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 82
            ],
            [
                "id"=> 43,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 83
            ],
            [
                "id"=> 44,
                "service_id"=> 1,
                "from_city_id"=> 40,
                "to_city_id"=> 84
            ],
            [
                "id"=> 45,
                "service_id"=> 1,
                "from_city_id"=> 85,
                "to_city_id"=> 63
            ],
            [
                "id"=> 49,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 41
            ],
            [
                "id"=> 51,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 43
            ],
            [
                "id"=> 52,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 44
            ],
            [
                "id"=> 53,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 45
            ],
            [
                "id"=> 54,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 86
            ],
            [
                "id"=> 55,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 47
            ],
            [
                "id"=> 56,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 48
            ],
            [
                "id"=> 57,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 49
            ],
            [
                "id"=> 60,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 87
            ],
            [
                "id"=> 61,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 52
            ],
            [
                "id"=> 63,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 54
            ],
            [
                "id"=> 64,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 55
            ],
            [
                "id"=> 66,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 57
            ],
            [
                "id"=> 67,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 58
            ],
            [
                "id"=> 68,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 59
            ],
            [
                "id"=> 72,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 63
            ],
            [
                "id"=> 77,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 89
            ],
            [
                "id"=> 78,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 66
            ],
            [
                "id"=> 80,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 90
            ],
            [
                "id"=> 82,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 70
            ],
            [
                "id"=> 83,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 71
            ],
            [
                "id"=> 85,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 75
            ],
            [
                "id"=> 86,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 76
            ],
            [
                "id"=> 87,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 77
            ],
            [
                "id"=> 89,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 79
            ],
            [
                "id"=> 90,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 80
            ],
            [
                "id"=> 92,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 82
            ],
            [
                "id"=> 93,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 91
            ],
            [
                "id"=> 94,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 83
            ],
            [
                "id"=> 95,
                "service_id"=> 1,
                "from_city_id"=> 73,
                "to_city_id"=> 84
            ],
            [
                "id"=> 96,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 45
            ],
            [
                "id"=> 97,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 47
            ],
            [
                "id"=> 100,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 57
            ],
            [
                "id"=> 101,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 59
            ],
            [
                "id"=> 104,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 63
            ],
            [
                "id"=> 106,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 66
            ],
            [
                "id"=> 108,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 70
            ],
            [
                "id"=> 109,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 71
            ],
            [
                "id"=> 113,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 75
            ],
            [
                "id"=> 114,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 76
            ],
            [
                "id"=> 115,
                "service_id"=> 1,
                "from_city_id"=> 53,
                "to_city_id"=> 77
            ],
            [
                "id"=> 118,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 41
            ],
            [
                "id"=> 121,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 47
            ],
            [
                "id"=> 122,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 48
            ],
            [
                "id"=> 124,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 87
            ],
            [
                "id"=> 127,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 57
            ],
            [
                "id"=> 130,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 63
            ],
            [
                "id"=> 135,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 66
            ],
            [
                "id"=> 138,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 70
            ],
            [
                "id"=> 139,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 71
            ],
            [
                "id"=> 143,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 75
            ],
            [
                "id"=> 144,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 76
            ],
            [
                "id"=> 146,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 79
            ],
            [
                "id"=> 148,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 83
            ],
            [
                "id"=> 149,
                "service_id"=> 1,
                "from_city_id"=> 67,
                "to_city_id"=> 84
            ],
            [
                "id"=> 150,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 86
            ],
            [
                "id"=> 151,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 47
            ],
            [
                "id"=> 154,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 57
            ],
            [
                "id"=> 156,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 63
            ],
            [
                "id"=> 158,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 89
            ],
            [
                "id"=> 159,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 66
            ],
            [
                "id"=> 164,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 76
            ],
            [
                "id"=> 165,
                "service_id"=> 1,
                "from_city_id"=> 78,
                "to_city_id"=> 77
            ],
            [
                "id"=> 167,
                "service_id"=> 1,
                "from_city_id"=> 41,
                "to_city_id"=> 56
            ],
            [
                "id"=> 168,
                "service_id"=> 1,
                "from_city_id"=> 41,
                "to_city_id"=> 57
            ],
            [
                "id"=> 169,
                "service_id"=> 1,
                "from_city_id"=> 41,
                "to_city_id"=> 61
            ],
            [
                "id"=> 170,
                "service_id"=> 1,
                "from_city_id"=> 41,
                "to_city_id"=> 63
            ],

        ]
];
