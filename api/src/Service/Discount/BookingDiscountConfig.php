<?php

namespace App\Service\Discount;

class BookingDiscountConfig
{
    public static function getConfig(): array
    {
        return [
            [
                "dateStart" => [
                    "date" => "01.04",
                ],
                "dateEnd" => [
                    "date" => "30.09",
                    "modify" => "+1 year"
                ],
                "conditions" => [
                    [
                        "date" => "30.11",
                        "percent" => 0.07
                    ],
                    [
                        "date" => "31.12",
                        "percent" => 0.05
                    ],
                    [
                        "date" => "31.01",
                        "modify" => "+1 year",
                        "percent" => 0.03,
                    ]
                ]
            ],
            [
                "dateStart" => [
                    "date" => "01.10",
                ],
                "dateEnd" => [
                    "date" => "14.01",
                    "modify" => "+1 year"
                ],
                "conditions" => [
                    [
                        "date" => "31.03",
                        "percent" => 0.07
                    ],
                    [
                        "date" => "30.04",
                        "percent" => 0.05
                    ],
                    [
                        "date" => "31.05",
                        "percent" => 0.03,
                    ]
                ]
            ],
            [
                "dateStart" => [
                    "date" => "15.01",
                    "modify" => "+1 year"
                ],
                "conditions" => [
                    [
                        "date" => "31.08",
                        "percent" => 0.07
                    ],
                    [
                        "date" => "30.09",
                        "percent" => 0.05
                    ],
                    [
                        "date" => "31.10",
                        "percent" => 0.03,
                    ]
                ]
            ]
        ];
    }
}