<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

/**
 * TikivnParser class file
 *
 * @author keywordrush.com <support@keywordrush.com>
 * @link http://www.keywordrush.com/
 * @copyright Copyright &copy; 2018 keywordrush.com
 */
class HccomvnParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';
    protected $headers = array('Accept'=>'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Encoding'=>'gzip, deflate, br',
    'Accept-Language'=>'vi,en-US;q=0.9,en;q=0.8',
    'Connection'=>'keep-alive',
    'Cookie'=>'ECOM_CLIENT_ID=45599613; P0_IS_MOBILE=NO; HC_ECOMMMERCE=ORA_WWV-Rg4SDuKvBfNbYeNZUFkdhfIR; _ga_RNELLY32L5=GS1.1.1625327385.1.0.1625327385.0; _ga=GA1.3.81976805.1625327386; _gid=GA1.3.2109345665.1625327386; _gcl_au=1.1.328574037.1625327391; Visitor_Returning=true; __utmzz=utmccn=(not set); __utmzzses=1; __zi=3000.SSZzejyD4DrbYVgitnWHacVTvEBH05BETTVxy9CIHDurYBtmcLyCtZkDllJJMmtPVeYyyTfS2TGqDW.1; _fbp=fb.2.1625327391092.1189646300; mepuzzConfig=%7B%22app_id%22%3A%22BnZenKl4jJ%22%2C%22app_domain%22%3A%22http%3A//dienmayhc.net/%2Chttps%3A//hc.mepuzz.com%2Chttps%3A//hc.com.vn/%22%2C%22app_status%22%3A10%2C%22public_key%22%3A%22BFx_ER3V0xQrBWpe5JAiW0syNbE6spGnw8uv_vOlTkK8dE0w7sjUC2wrWnkAxcbxXoN-eim8feYq3ItEAeVgSl0%22%2C%22not_ask_allow_in_day%22%3A0%2C%22notif_wellcome%22%3A%7B%22status%22%3A0%2C%22data%22%3A%7B%22title%22%3A%22%22%2C%22body%22%3A%22%22%2C%22icon%22%3A%22%22%2C%22image%22%3A%22%22%2C%22url%22%3A%22%22%7D%7D%7D; bannerStaticArray=%5B%7B%22id%22%3A%225f3b464c84baa3664173be58%22%2C%22opt%22%3A%7B%22timeout%22%3A0%2C%22timeout_off%22%3A0%2C%22display%22%3A%22always%22%2C%22device%22%3A%22allDevice%22%2C%22segment%22%3A%5B%5D%7D%7D%5D; bannerConfig=%5B%225f3b464c84baa3664173be58%22%5D; eventStaticArray=%5B%22Khach_roi_web%22%2C%22Khach_tren_trang_10s%22%2C%22Khach_tren_trang_15s%22%2C%22Khach_tren_trang_20s%22%2C%22Views_2_page%22%2C%22Khach_tren_trang_30s%22%2C%22Khach_khong_mua_hang%22%2C%22Visitor_Returning%22%2C%22Views_3_page%22%2C%22Cuon_chuot_50%25%22%2C%22Cuon_chuot_60%25%22%2C%22Cuon_chuot_70%25%22%2C%22Tu_bo_form_bieu_mau%22%5D; _gat_gtag_UA_151174138_1=1; pageviewCount=15',
    'DNT'=>'1',
    'Host'=>'hc.com.vn',
    'Referer'=>'https://hc.com.vn/ords/home',
    'sec-ch-ua'=>'" Not;A Brand";v="99", "Google Chrome";v="91", "Chromium";v="91"',
    'sec-ch-ua-mobile'=>'?0',
    'Sec-Fetch-Dest'=>'document',
    'Sec-Fetch-Mode'=>'navigate',
    'Sec-Fetch-Site'=>'same-origin',
    'Sec-Fetch-User'=>'?1',
    'Upgrade-Insecure-Requests'=>'1',
    'User-Agent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',);

    public function parseCatalog($max)
    {
        $path = array(
            ".//h3//a/@href"
        );

        $urls = $this->xpathArray($path);

        foreach ($urls as $i => $url) {
            $urls[$i] = 'https://hc.com.vn/ords/' . $url;
        }

        return $urls;
    }

    public function parseTitle()
    {
        return $this->xpathScalar(".//h1");
    }

    public function parsePrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price-new']"); 

        return $price;
    }

    public function parseOldPrice()
    {
        $price = 0;
        $price = $this->xpathScalar(".//*[@class='price-old']"); 
        
        return $price;
    }


    public function parseImg()
    {
        return $this->xpathScalar(".//*[@itemprop='image']/@src");
    }

    public function isInStock()
    {
        return true;
    }

}
