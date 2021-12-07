<?php

namespace Keywordrush\AffiliateEgg;

defined('\ABSPATH') || exit;

class LazadavnParser extends ShopParser {

    protected $charset = 'utf-8';
    protected $currency = 'VND';
    protected $_product;
    protected $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36';
    
    protected $headers = array(
        'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'accept-encoding' => 'gzip, deflate, br',
        'accept-language' => 'vi,en-US;q=0.9,en;q=0.8',
        'cookie' => 'miidlaz=miid5h33e61f2fsqj05nvhi; t_fv=1617588735418; t_uid=3xbhbw9nx8lIWHpedEUEiKZv9hytDkGN; cna=/1/xGC4/nX4CAav3nypQxef9; lzd_cid=47cb8fea-2b95-4889-be21-502c0e5da706; _gcl_au=1.1.1846481029.1617588738; _bl_uid=ebkpInes35Uy6kktFkL93e1heRn5; _ga=GA1.2.1317132771.1617588740; _fbp=fb.1.1617588740870.1937130443; cto_axid=EOlFv3loRa9EqAwd8RQvN-sswriEiGsg; _gcl_aw=GCL.1622308868.CjwKCAjwzMeFBhBwEiwAzwS8zPXoinA2ApmK1iFSA5KugrXNwMm__NnIXIspxCXoFUumJcnqLy4oNRoCpS8QAvD_BwE; _gac_UA-30172376-1=1.1622308871.CjwKCAjwzMeFBhBwEiwAzwS8zPXoinA2ApmK1iFSA5KugrXNwMm__NnIXIspxCXoFUumJcnqLy4oNRoCpS8QAvD_BwE; lzd_click_id=clkgg2f961f7ol6suv8759; hng=VN|vi|VND|704; hng.sig=EmlYr96z9MQGc5b9Jyf9txw1yLZDt_q0EWkckef954s; xlly_s=1; __disclaimer_milk__=true; t_sid=1vt7xmKrS1aPJl62XKFeOr7DohBUwQ6n; utm_channel=NA; lzd_sid=1a86a83ed5b81e776909f21bff27305f; _m_h5_tk=ab3594e302b943fdfd2934405ae6ec9e_1623521539606; _m_h5_tk_enc=31a86cc6f4b4fee84417664891337aa4; _tb_token_=737e749de7781; EGG_SESS=S_Gs1wHo9OvRHCMp98md7AN9CpSq9oOzrCXAoa8z7UU1Cz3oLPDnqYaaK8pnN2iK__j63KC-snzScjfoSTJU95qIW6YV09h4Okg8l6AJa7F6o7gnhEKO2r230-5vDsZWxIYcvIeNd-wX4sepmo_kvxuNTOx6W9ZkN3jMToLs9dI=; _gid=GA1.2.912190560.1623513016; dsa_category_disclaimer=true; x5sec=7b22617365727665722d6c617a6164613b32223a226438653163386234346533663536653261613564656630656239633963323630435036346b345947454c6276786553623174654c795145776e4f484873674d3d227d; _uetsid=ea0aa040cb7511eba185b3b54efbb5e1; _uetvid=09191850c03411eb8e6b6dd4fe5b9df7; isg=BMjIoRgFPC9ggVBSkvNRpB68mTbacSx7d_A4wYJ5eMM-XWrHK4UxC2Rf1S0t7eRT; tfstk=cpcCBy29oMjQ-_9PT2TNUdzh1sVVZjQbPpZnRxf5GDQ1d5gCir14cnfnEgCTHP1..; l=eBLySxpnjIU2tl28KOfZourza77TlIRVguPzaNbMiOCPOaCM72DfW6O-QCTHCnMNHshXJ3l-cR2bBq8Jpydrnxv9-8J2xzkondC..',
        'dnt' => '1',
        'referer' => 'https://www.lazada.vn/?spm=a2o4n.searchlist.header.dhome.207c7330Xcsx9M',
        'sec-ch-ua' => '" Not;A Brand";v="99", "Google Chrome";v="91", "Chromium";v="91"',
        'sec-ch-ua-mobile' => '?0',
        'sec-fetch-dest' => 'document',
        'sec-fetch-mode' => 'navigate',
        'sec-fetch-site' => 'same-origin',
        'sec-fetch-user' => '?1',
        'upgrade-insecure-requests' => '1',
    );

    public function parseCatalog($max)
    {
        $html = $this->dom->saveHTML();
        if (preg_match_all('/\],"productUrl":"(.+?)","image"/', $html, $matches)) {
            $urls = array();
            foreach ($matches[1] as $i => $url)
            {
                $urls[$i] = $url;
            }
            return $urls;
        }
    }

    public function _saveProduct() {
        $this->_product = $this->dom->saveHTML();
    }

    public function parseTitle()
    {
        return $this->xpathScalar(".//meta[@name='og:title']/@content");
    }

    public function parsePrice()
    {
        $this->_saveProduct();
        $price = 0;
        if (preg_match('/"salePrice":{"text":"(.+?)","value":(\d+?)}/', $this->_product, $matches))
            $price = $matches[2];
        return $price;
    }

    public function parseOldPrice()
    {
        if (preg_match('/"originalPrice":{"text":"(.+?)","value":(\d+?)}/', $this->_product, $matches))
            return $matches[2];
    }

    public function parseImg()
    {
        return $this->xpathScalar(".//link[@as='image']/@href") ? $this->xpathScalar(".//link[@as='image']/@href") : 'https://vn-test-11.slatic.net/p/4ea8b33d45e481757554a93220110f51.jpg_720x720q80.jpg_.webp';
    }

}
