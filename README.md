MinerDash
=========

Self hosted YPool.net worker dashboard

![ScreenShot](https://raw.github.com/Edocsyl/MinerDash/master/overview.JPG)

Config
--------------

Open index.php file and change following things.
```php
// API Key from ypool.net
$y = new YPool('XXXXXXXXXXXXXXXXXXXXXXXXX');
// Coins: XPM, FTC, PTS, DOGE, MTC, RIC
$coins = array('XPM', 'RIC', 'DOGE');;
```

YPool.net PHP API
=========

Usage
--------------
```php
//Parameter is the api-key. If you call something else than the global_stats an api-key is required.
$y = new YPool(); 

echo '<pre>';
print_r($y->global_stats(Coins::DOGE));
echo '</pre>';
```