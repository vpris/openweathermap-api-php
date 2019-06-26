<?php
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.openweathermap.org/data/2.5/forecast?q=$qCity,$qCountry&cnt=30&lang=$qLang&units=$qUnits&appid=$apiKey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Accept: */*",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Host: api.openweathermap.org",
        "User-Agent: PogodaPHP/0.0.1",
        "accept-encoding: gzip, deflate",
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $object = json_decode($response, true);
}
$days = array( 1 => 'Понедельник' , 'Вторник' , 'Среда' , 'Четверг' , 'Пятница' , 'Суббота' , 'Воскресенье' ); //Array with days of the week in Russian


if ($object['city']['name'] == 'Omsk') {
    print "<span class='queryCity'>" . 'Погода в Омске' . "</span><img src='https://superomsk.ru/images/news/full/2018/01/50f68046f7ea1aa8d7b96396db013ed0.jpg' width='200'></div>" ;
} elseif ($object['city']['name'] == 'Moscow') {
    print "<span class='queryCity'>" . 'Погода в Москве' . "</span><img src='https://b1.m24.ru/c/1113555.jpg' width='200'></div>" ;
} else {
    print "<span class='queryCity'>" . 'Погода в Санкт-Петербурге' . "</span><img src='https://thehermitagehotel.ru/wp-content/uploads/2014/01/hermitage-museum-in-stpetersburg-russia-1.jpg' width='200'></div>" ;
}

print "<div class='wrapper'>";

foreach ($object['list'] as $objectc => $value) {
    $i = 0;
    $s = 0;
    $e = 0;
    $temper = "{$value['main']['temp']}";
    $dates = "{$value['dt_txt']}";
    $dnum = date("w", strtotime($dates));
    $textday = $days[$dnum];
    $date = date('G:i', strtotime($dates));
    $temp = round($temper);
    print "<div class='weather'>" . "<div class='temp'>" . $temp . "°" . "</div>" . "<br>";
    $iconsWeather = "http://openweathermap.org/img/w/" . "{$value['weather'][$s++]['icon']}" . ".png";
    print "<img class='iconWeather' src='$iconsWeather' alt=''>" . "<br>";
    print "{$value['weather'][$i++]['description']} <br>";
    print "<br>" . $date . " " . $textday . "</div>";
}