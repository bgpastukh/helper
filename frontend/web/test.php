<?php

function getMonth($month)
{
    switch ($month)
    {
        case 'Jan':
            return 1;
            break;
        case 'Feb':
            return 2;
            break;
        case 'Mar':
            return 3;
            break;
        case 'Apr':
            return 4;
            break;
        case 'May':
            return 5;
            break;
        case 'Jun':
            return 6;
            break;
        case 'Jul':
            return 7;
            break;
        case 'Aug':
            return 8;
            break;
        case 'Sep':
            return 9;
            break;
        case 'Oct':
            return 10;
            break;
        case 'Nov':
            return 11;
            break;
        case 'Dec':
            return 12;
            break;
    }
}

//function getLinks()
//{
//    for ($i = 300; $i < 500)
//    {
//        $page = file_get_contents("http://steamcommunity.com/market/search?q=&category_730_ItemSet%5B%5D=any&category_730_ProPlayer%5B%5D=any&category_730_StickerCapsule%5B%5D=any&category_730_TournamentTeam%5B%5D=any&category_730_Weapon%5B%5D=any&category_730_Type%5B%5D=tag_CSGO_Type_Pistol&category_730_Type%5B%5D=
//        tag_CSGO_Type_SMG&category_730_Type%5B%5D=tag_CSGO_Type_Rifle&category_730_
//        Type%5B%5D=tag_CSGO_Type_SniperRifle&category_730_Type%5B%5D=tag_CSGO_Type_Shotgun&category_730
//        _Type%5B%5D=tag_CSGO_Type_Machinegun&appid=730#p{$i}_price_asc");
//
//
//    }
//}

function getPrice($data)
{
    preg_match('/var line1=\[.*\];/', $data, $prices);
    $prices = substr($prices[0], 12);
    $prices = substr($prices, 0, -3);

    $array = explode('],[', $prices);
    $records = array_reverse($array);
    $i = 0;
    $sold = 0;
    $sum = 0;

    date_default_timezone_set('UTC');
    $now = new DateTime("now");

    foreach ($records as $record) {
//        Get product info
        $record = trim($record, '"');
        $recordElem = explode(',', $record);
        $dateArr = explode(" ", trim($recordElem[0], '"'));

//        24 hours
        $month = getMonth($dateArr[0]);
        $day = $dateArr[1];
        $year = $dateArr[2];
        $hour = trim($dateArr[3], ':');
        $date = new DateTime("{$year}-{$month}-{$day}-{$hour}");
        $interval = $now->diff($date);
        $diff = $interval->format('%R%D days, %R%H hours');
        if (!strpos($diff, '00 days')){
            break;
        }

        $sum += $recordElem[1];
        $sold += trim($recordElem[2], '"');
        $i++;
    }

    $avg = $sum / $i;



    return [
        'avg' => $avg,
        'sold' => $sold
    ];
}

function getList()
{
    // Links
    $links = [
        'https://steamcommunity.com/market/listings/730/UMP-45%20%7C%20Primal%20Saber%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Basilisk%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Royal%20Paladin%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/USP-S%20%7C%20Caiman%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Hyper%20Beast%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Glock-18%20%7C%20Water%20Elemental%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AWP%20%7C%20Phobos%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/UMP-45%20%7C%20Blaze%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Pink%20DDPAT%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A4%20%7C%20Griffin%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Kumicho%20Dragon%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Red%20Laminate%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Electric%20Hive%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Vulcan%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20X-Ray%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/P2000%20%7C%20Fire%20Elemental%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20USP-S%20%7C%20Stainless%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AK-47%20%7C%20Blue%20Laminate%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Desert-Strike%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Hypnotic%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/Five-SeveN%20%7C%20Candy%20Apple%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AK-47%20%7C%20Blue%20Laminate%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/Galil%20AR%20%7C%20Cerberus%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/FAMAS%20%7C%20Roll%20Cage%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AK-47%20%7C%20Cartel%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Cobalt%20Disruption%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Desert%20Eagle%20%7C%20Conspiracy%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/P90%20%7C%20Asiimov%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Cyrex%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Cyrex%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/P250%20%7C%20Asiimov%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Basilisk%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/PP-Bizon%20%7C%20Judgement%20of%20Anubis%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/P250%20%7C%20Whiteout%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Desert%20Eagle%20%7C%20Crimson%20Web%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/SSG%2008%20%7C%20Big%20Iron%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AUG%20%7C%20Anodized%20Navy%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AWP%20%7C%20Phobos%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Redline%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/PP-Bizon%20%7C%20Judgement%20of%20Anubis%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Dark%20Water%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Point%20Disarray%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Atomic%20Alloy%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Vulcan%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Guardian%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Glock-18%20%7C%20Water%20Elemental%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/Glock-18%20%7C%20Wasteland%20Rebel%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AK-47%20%7C%20Cartel%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/USP-S%20%7C%20Kill%20Confirmed%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Desert%20Eagle%20%7C%20Kumicho%20Dragon%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Golden%20Koi%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/USP-S%20%7C%20Kill%20Confirmed%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Jaguar%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AWP%20%7C%20Elite%20Build%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A4%20%7C%20Zirka%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Fuel%20Injector%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/UMP-45%20%7C%20Primal%20Saber%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Five-SeveN%20%7C%20Case%20Hardened%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/P90%20%7C%20Asiimov%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/P90%20%7C%20Asiimov%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Chantico%27s%20Fire%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Royal%20Paladin%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/P90%20%7C%20Death%20by%20Kitty%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20BOOM%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Red%20Laminate%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Frontside%20Misty%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A4%20%7C%20Evil%20Daimyo%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Desolate%20Space%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Corticera%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20AWP%20%7C%20Worm%20God%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Black%20Laminate%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/P2000%20%7C%20Fire%20Elemental%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Bullet%20Rain%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20USP-S%20%7C%20Guardian%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/P90%20%7C%20Asiimov%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Bullet%20Rain%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20%E9%BE%8D%E7%8E%8B%20%28Dragon%20King%29%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Cobalt%20Disruption%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20The%20Battlestar%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/Five-SeveN%20%7C%20Case%20Hardened%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Black%20Laminate%20%28Field-Tested%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Redline%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/Desert%20Eagle%20%7C%20Crimson%20Web%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/MAC-10%20%7C%20Neon%20Rider%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/Five-SeveN%20%7C%20Candy%20Apple%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Aquamarine%20Revenge%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/Tec-9%20%7C%20Fuel%20Injector%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Hyper%20Beast%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/M4A4%20%7C%20Asiimov%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Aquamarine%20Revenge%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/USP-S%20%7C%20Orion%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Case%20Hardened%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20Desert%20Eagle%20%7C%20Conspiracy%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Golden%20Coil%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Golden%20Coil%20%28Well-Worn%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Bright%20Water%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/M4A1-S%20%7C%20Golden%20Coil%20%28Minimal%20Wear%29',
        'https://steamcommunity.com/market/listings/730/AWP%20%7C%20Electric%20Hive%20%28Factory%20New%29',
        'https://steamcommunity.com/market/listings/730/AK-47%20%7C%20Case%20Hardened%20%28Battle-Scarred%29',
        'https://steamcommunity.com/market/listings/730/StatTrak%E2%84%A2%20M4A1-S%20%7C%20Dark%20Water%20%28Minimal%20Wear%29',
    ];

    foreach ($links as $link) {

        // Get product id
        @$data = file_get_contents($link);
        if (!$data)
        {
            do{
                sleep(3);
                @$data = file_get_contents($link);
            } while (!$data);
        }
        preg_match('/Market_LoadOrderSpread\( .* /U', $data, $id);
        $id = preg_replace("/[^0-9]/", '', $id[0]);

        $info = getPrice($data);


        // Get highest buy order and lowest sell order
        @$buyRequests = file_get_contents("http://steamcommunity.com/market/itemordershistogram?country=UA&language=english&currency=1&item_nameid={$id}&two_factor=0");

            if (!$buyRequests)
        {
            do{
                sleep(3);
                @$buyRequests = file_get_contents("http://steamcommunity.com/market/itemordershistogram?country=UA&language=english&currency=1&item_nameid={$id}&two_factor=0");
            } while (!$buyRequests);
        }

        $json = json_decode($buyRequests);

        $buyOrder = $json->highest_buy_order;
        $sellOrder = $json->lowest_sell_order;

        $diff = 100 - (($buyOrder / $sellOrder) * 100);

        if ($diff > 12.5){
            echo "Buy " . $buyOrder;
            echo "<br>";
            echo "Sell " . $sellOrder;
            echo "<br>";
            echo "Diff " . $diff;
            echo "<br>";
            echo "Sold " . $info['sold'];
            echo "<br>";
            echo "Avg " . $info['avg'];
            echo "<br>";
            echo '<a href="' . $link . '">Link</a>';
            echo "<hr>";
        }
    }
}


getList();
