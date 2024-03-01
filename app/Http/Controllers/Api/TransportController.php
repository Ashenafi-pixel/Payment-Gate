<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;

class TransportController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function getSeatPlans(Request $request)
    {
        $response = $this->response();
        return response()->json(['success' => true, 'data' => $response->data,'errors'=>[],'message'=>'Data Found successfully']);
//        return GeneralHelper::SEND_RESPONSE_API($request, $response->data, 'Seat plans found');
    }

    /**
     * @return mixed
     */
    public function response()
    {
        $data = '{"data": {
        "seat_plan": {
            "rows": 10,
            "cols": 5,
            "seat_plan": [
                {
                    "seat_id": 1,
                    "seat_name": "seat_1",
                    "seat_pos": "0_0",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 2,
                    "seat_name": "seat_2",
                    "seat_pos": "0_1",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 3,
                    "seat_name": "seat_3",
                    "seat_pos": "0_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 3,
                    "seat_name": "seat_3",
                    "seat_pos": "0_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 4,
                    "seat_name": "seat_4",
                    "seat_pos": "0_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 5,
                    "seat_name": "seat_5",
                    "seat_pos": "1_0",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 6,
                    "seat_name": "seat_6",
                    "seat_pos": "1_1",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 7,
                    "seat_name": "seat_7",
                    "seat_pos": "1_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 7,
                    "seat_name": "seat_7",
                    "seat_pos": "1_3",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 8,
                    "seat_name": "seat_8",
                    "seat_pos": "1_4",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 9,
                    "seat_name": "seat_9",
                    "seat_pos": "2_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 10,
                    "seat_name": "seat_10",
                    "seat_pos": "2_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 11,
                    "seat_name": "seat_11",
                    "seat_pos": "2_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 11,
                    "seat_name": "seat_11",
                    "seat_pos": "2_3",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 12,
                    "seat_name": "seat_12",
                    "seat_pos": "2_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 13,
                    "seat_name": "seat_13",
                    "seat_pos": "3_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 14,
                    "seat_name": "seat_14",
                    "seat_pos": "3_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 15,
                    "seat_name": "seat_15",
                    "seat_pos": "3_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 15,
                    "seat_name": "seat_15",
                    "seat_pos": "3_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 16,
                    "seat_name": "seat_16",
                    "seat_pos": "3_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 17,
                    "seat_name": "seat_17",
                    "seat_pos": "4_0",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 18,
                    "seat_name": "seat_18",
                    "seat_pos": "4_1",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 19,
                    "seat_name": "seat_19",
                    "seat_pos": "4_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 19,
                    "seat_name": "seat_19",
                    "seat_pos": "4_3",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 20,
                    "seat_name": "seat_20",
                    "seat_pos": "4_4",
                    "seat_type": "M",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 21,
                    "seat_name": "seat_21",
                    "seat_pos": "5_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 22,
                    "seat_name": "seat_22",
                    "seat_pos": "5_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 23,
                    "seat_name": "seat_23",
                    "seat_pos": "5_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 23,
                    "seat_name": "seat_23",
                    "seat_pos": "5_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 24,
                    "seat_name": "seat_24",
                    "seat_pos": "5_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 25,
                    "seat_name": "seat_25",
                    "seat_pos": "6_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 26,
                    "seat_name": "seat_26",
                    "seat_pos": "6_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 27,
                    "seat_name": "seat_27",
                    "seat_pos": "6_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 27,
                    "seat_name": "seat_27",
                    "seat_pos": "6_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 28,
                    "seat_name": "seat_28",
                    "seat_pos": "6_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 29,
                    "seat_name": "seat_29",
                    "seat_pos": "7_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 30,
                    "seat_name": "seat_30",
                    "seat_pos": "7_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 31,
                    "seat_name": "seat_31",
                    "seat_pos": "7_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 31,
                    "seat_name": "seat_31",
                    "seat_pos": "7_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 32,
                    "seat_name": "seat_32",
                    "seat_pos": "7_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 33,
                    "seat_name": "seat_33",
                    "seat_pos": "8_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 34,
                    "seat_name": "seat_34",
                    "seat_pos": "8_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 35,
                    "seat_name": "seat_35",
                    "seat_pos": "8_2",
                    "seat_type": "-1",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 35,
                    "seat_name": "seat_35",
                    "seat_pos": "8_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 36,
                    "seat_name": "seat_36",
                    "seat_pos": "8_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 37,
                    "seat_name": "seat_37",
                    "seat_pos": "9_0",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 38,
                    "seat_name": "seat_38",
                    "seat_pos": "9_1",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 39,
                    "seat_name": "seat_39",
                    "seat_pos": "9_2",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 40,
                    "seat_name": "seat_40",
                    "seat_pos": "9_3",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                },
                {
                    "seat_id": 41,
                    "seat_name": "seat_41",
                    "seat_pos": "9_4",
                    "seat_type": "0",
                    "seat_female": false,
                    "seat_ristrictmale": false
                }
            ]
        },
        "total_seats": 49,
        "total_available": 38,
        "total_occupied": 11,
        "occupied_seats_male": 11,
        "occupied_seats_female": 0,
        "total_reserved": 11,
        "reserved_seats_male": 0,
        "reserved_seats_female": 0,
        "ticket_price": "",
        "available_seats": [
            3,
            4,
            9,
            10,
            12,
            13,
            14,
            15,
            16,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
            31,
            32,
            33,
            34,
            35,
            36,
            37,
            38,
            39,
            40,
            41
        ]
    }}';
        return json_decode($data);
    }

    /**
     * @return array[]
     */
    public function _cities()
    {
        return [
            ['id' => 1, 'name' => 'Addis Ababa'],
            ['id' => 2, 'name' => 'Bahir Dar'],
            ['id' => 3, 'name' => 'Gondar'],
        ];
    }

    public function parseResponse($req)
    {
        $city = collect([
            ['id' => 1, 'name' => 'Addis Ababa'],
            ['id' => 2, 'name' => 'Bahir Dar'],
            ['id' => 3, 'name' => 'Gondar'],
        ]);
        $from = $city->where('id', $req['from_city_ids'])->first() ? $city->where('id', $req['from_city_ids'])->first()['name'] : '-';
        $to = $city->where('id', $req['to_city_ids'])->first() ? $city->where('id', $req['to_city_ids'])->first()['name'] : '-';

        $data =
            '{"data": {
        "times": [
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "3",
                "arrival_seq": "13",
                "route_id": "16954",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP-SHM-AFC-ABT",
                "schedule_id": "1878671",
                "depart_time": "10:00:00",
                "arrival_time": "05:00:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "37",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 37,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Addis Ababa",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "3",
                "arrival_seq": "13",
                "route_id": "16960",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP",
                "schedule_id": "1878675",
                "depart_time": "12:00:00",
                "arrival_time": "07:00:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "42",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 42,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Addis Ababa",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "1",
                "arrival_seq": "10",
                "route_id": "16806",
                "route_name": "KHI-KBT-HYD-SKD-MOR-SKR-IQB-ZPI-MTN-RWP-RSK-PSW",
                "schedule_id": "1878479",
                "depart_time": "17:00:00",
                "arrival_time": "12:00:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "36",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 36,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Addis Ababa",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "1",
                "arrival_seq": "8",
                "route_id": "16935",
                "route_name": "KHI-HYD-SKD-MOR-SKR-IQB-KWL-RWP",
                "schedule_id": "1878481",
                "depart_time": "18:00:00",
                "arrival_time": "12:55:00",
                "schedule_time_code": "1",
                "fare_fare": "8400",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "25",
                "available_seats": "12",
                "bus_status": "OK",
                "bus_type_id": "21",
                "bus_name": "S.BUS",
                "bus_seats": 25,
                "bus_available_seats": 12,
                "bus_staff_seats": 25,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Addis Ababa",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "1",
                "arrival_seq": "8",
                "route_id": "16935",
                "route_name": "KHI-HYD-SKD-MOR-SKR-IQB-KWL-RWP",
                "schedule_id": "1878480",
                "depart_time": "21:00:00",
                "arrival_time": "15:55:00",
                "schedule_time_code": "1",
                "fare_fare": "8400",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "25",
                "available_seats": "22",
                "bus_status": "OK",
                "bus_type_id": "21",
                "bus_name": "S.BUS",
                "bus_seats": 25,
                "bus_available_seats": 22,
                "bus_staff_seats": 25,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Gondar",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 61,
                "arrival_city_id": 73,
                "depart_id": 13,
                "arrival_id": 22,
                "depart_seq": "3",
                "arrival_seq": "13",
                "route_id": "16960",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP",
                "schedule_id": "1878676",
                "depart_time": "23:15:00",
                "arrival_time": "18:15:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "47",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 47,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Gondar",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 95,
                "arrival_city_id": 73,
                "depart_id": 120,
                "arrival_id": 22,
                "depart_seq": "2",
                "arrival_seq": "13",
                "route_id": "16954",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP-SHM-AFC-ABT",
                "schedule_id": "1878671",
                "depart_time": "09:40:00",
                "arrival_time": "05:00:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "37",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 37,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Gondar",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 95,
                "arrival_city_id": 73,
                "depart_id": 120,
                "arrival_id": 22,
                "depart_seq": "2",
                "arrival_seq": "13",
                "route_id": "16960",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP",
                "schedule_id": "1878675",
                "depart_time": "11:40:00",
                "arrival_time": "07:00:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "42",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 42,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Gondar",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            },
            {
                "depart_date": "2023-05-23",
                "depart_city_id": 95,
                "arrival_city_id": 73,
                "depart_id": 120,
                "arrival_id": 22,
                "depart_seq": "2",
                "arrival_seq": "13",
                "route_id": "16960",
                "route_name": "KMJ-KBS-KHI-KBT-HYD-SKD-MOR-RNP-SKR-IQB-ZPI-MTN-RWP",
                "schedule_id": "1878676",
                "depart_time": "22:55:00",
                "arrival_time": "18:15:00",
                "schedule_time_code": "1",
                "fare_fare": "6870",
                "discounted_fare": 0,
                "fare_y": "0",
                "total_seats": "49",
                "available_seats": "47",
                "bus_status": "OK",
                "bus_type_id": "36",
                "bus_name": "N-VIP",
                "bus_seats": 49,
                "bus_available_seats": 47,
                "bus_staff_seats": 3,
                "bus_via": " ",
                "bus_service_id": 1,
                "bus_service_name": "Anbessa",
                "depart_city_name": "Bahir Dar",
                "arrival_city_name": "Gondar",
                "bus_service_icon": "https://www.bus-planet.com/bus/pictures/Ethiopia/JN/400/B2003-02-007.jpg"
            }
        ]
    }}';
        $decoded = json_decode($data, true);
        $array = $decoded['data']['times'];
        $final = [];
        foreach ($array as $key => $item) {
            $array[$key] = $array[$key];
            $item['depart_city_name'] = $from;
            $item['arrival_city_name'] = $to;
            $final[] = $item;
        }

        return $final;
    }

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function getTrips(Request $request)
    {
        $aray = [
            'from_city_ids' => $request->from_city_ids,
            'to_city_ids' => $request->to_city_ids,
        ];
        $response = $this->parseResponse($aray);
        return response()->json(['success' => true, 'data' => $response,'errors'=>[],'message'=>'Data Found successfully']);
//        return GeneralHelper::SEND_RESPONSE_API($request, $response, 'Trips has been found');
    }


}
