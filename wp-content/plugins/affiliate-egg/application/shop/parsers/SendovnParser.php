<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

class SendovnParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';
    protected $headers = array(
        ':method' => 'GET',
        'accept' => '*/*',
        'accept-encoding' => 'gzip, deflate, br',
        'accept-language' => 'vi,en-US;q=0.9,en;q=0.8',
        'dnt' => '1',
        'origin' => 'https://www.sendo.vn',
        'referer' => 'https://www.sendo.vn/',
        'sec-ch-ua' => "'Not;A Brand';v='99', 'Google Chrome';v='91', 'Chromium';v='91",
        'sec-ch-ua-mobile' => '?0',
        'sec-fetch-dest' => 'empty',
        'sec-fetch-mode' => 'cors',
        'sec-fetch-site' => 'same-site',
        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36'
    );


    public function parseCatalog($max)
    {
        $html = $this->dom->saveHTML();
        if (preg_match_all('/"category_path":"(.+?)"/', $html, $matches)) {
            $urls = array();
            foreach ($matches[1] as $i => $path)
            {
                $urls[$i] = 'https://www.sendo.vn/' . $path;
            }
            return $urls;
        }
    }

    public function parseTitle()
    {
        return $this->xpathScalar(".//h1");
    }

    public function _priceTrim($price) {
        $price = str_replace('₫', '', $price);
        $price = str_replace('.', '', $price);
        $price = str_replace(' ', '', $price);
        return $price;
    }

    public function parsePrice()
    {
        $paths = array(
            ".//*[@class='currentPrice_2zpf']",
        );
        $price = 0;

        if ($price = $this->xpathScalar($paths)) {
            $price = $this->_priceTrim($price);
        }
        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $lds = $this->xpathArray("(.//script[@type='application/ld+json'])[2]", true);
        foreach ($lds as $ld)
        {
            if (!$data = json_decode($ld, true))
                continue;

            $price = $data['offers']['price'];
        }

        return $price;
    }

    public function parseImg()
    {
        $img = $this->xpathScalar(".//*[@class='img_2xfX']/@src");
        return $img;
    }
}
