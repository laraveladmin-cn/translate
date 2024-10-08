<?php
namespace ShaoZeMing\Translate;

use GuzzleHttp\Client;
use ShaoZeMing\Translate\Exceptions\TranslateException;
use Stichoza\GoogleTranslate\GoogleTranslate as TranslateClient;

class Google implements TranslateInterface
{

    protected static $language = [
        '' =>'auto',   //中文
        'auto' =>'auto',   //中文
        'zh' =>'zh-CN',   //中文
        'hk' =>'zh-TW',   //繁体
        'en' =>'EN',   //英文
        'jp' =>'jp',   //日文
        'ko' =>'kor',  //韩文
        'fr' =>'fra',  //法语
        'ru' =>'ru',   //俄语
        'es' =>'spa',  //西班牙语
        'pt' =>'pt',  //葡萄牙语

        'ar' =>'ar', //阿拉伯语
        'zh-CN'=>'zh', //简体中文
        'zh-TW'=>'zh-TW', //繁体中文
        'de'=>'de', //德语
        'es'=>'es',//西班牙语
        'ru'=>'ru', //俄语
        'pt-BR'=>'pt',//巴西葡萄牙语
        'pt-PT'=>'pt',//葡萄牙葡萄牙语
        'ja'=>'ja', //日语
        'ko'=>'ko',//韩语
        'it'=>'it',//意大利语
        'nl'=>'nl',//荷兰语
        'pl'=>'pl',//波兰语
        'sv'=>'sv',//瑞典语
        'no'=>'no',//挪威语
        'da'=>'da',//丹麦语
        'fi'=>'	fi', //芬兰语
        'hu'=>'hu',//匈牙利语
        'cs'=>'cs', //捷克语
        'el'=>'el', //希腊语
        'ro'=>'ro',//罗马尼亚语
        'bg'=>'bg',//保加利亚语
        'tr'=>'tr',//土耳其语
        'vi'=>'vi',//越南语
        'th'=>'th',//泰语

    ];



    private $app_id;
    private $app_key;
    private $base_url;
    private $options;
    private $httpClient;
    private $from;
    private $to;
    public $source = false;


    public function __construct($app_id,$app_key,$from,$to,$base_url,$options=[])
    {
        $this->app_id = $app_id;
        $this->app_key = $app_key;
        $this->from = $this->checkLanguage($from);
        $this->to = $this->checkLanguage($to);
        $this->base_url = $base_url;
        $this->options = $options;
    }


    /**
     * @author ShaoZeMing
     * @email szm19920426@gmail.com
     * @param $string
     * @param bool $source  返回原数据结构
     * @return mixed
     */
    public function translate($string,$source=false)
    {
        $driver = new TranslateClient($this->to,$this->from,$this->options);
        $driver->setUrl($this->base_url);
        if($source){
           $result= $driver->getResponse($string);
        }else{
            $result=  $driver->translate($string);
        }
        return $result;

    }




    /**
     * @author ShaoZeMing
     * @email szm19920426@gmail.com
     * @param $language
     * @return mixed
     * @throws TranslateException
     */
    private static function checkLanguage($language)
    {

        if (!isset(self::$language[$language])) {
            return $language;
            //throw new TranslateException('10000');
        }

        return self::$language[$language];
    }







    /**
     * @author ShaoZeMing
     * @email szm19920426@gmail.com
     * @param $attr
     * @param $value
     * @return $this
     */
    public function __set($attr,$value)
    {
        $this->$attr = $value;
        return $this;
    }


    /**
     * @author ShaoZeMing
     * @email szm19920426@gmail.com
     * @param $attr
     * @return mixed
     */
    public function __get($attr)
    {
        return $this->$attr;
    }


}
