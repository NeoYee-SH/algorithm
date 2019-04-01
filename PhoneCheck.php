<?php

class PhoneCheck
{
    static public $mobile_pattern = '(?<phone>(?:1[3-9](\d[-|\s]?){6}\d{3}))';//移动电话1开头
    static public $tel_pattern02 = '(?<phone>(?:0[12]\d[-|\s]?\d{8}([-|\s]?\d{2,4})?))';//固定电话01|02开头
    static public $tel_pattern03 = '(?<phone>(?:0[^12]\d{2}[-|\s]?\d{7,8}([-|\s]?\d{1,4})?))';//固定电话非01|02开头
    static public $corp_pattern = '(?<phone>(?:[4|8]00[-|\s]?(\d[-|\s]?){2}\d{2}[-|\s]?\d{3}))';//企业电话400|800

    static public function analysis(string $str):array
    {
        $data = ['mobile'=>'','tel'=>''];
        $index = $str[0];
        if('0' === $index)
        {
            $phone = self::hasTel($str);
            if($phone)
            {
                $str = preg_replace("/[^\d]/", '', str_replace($phone, 'p', $str));
                $data['tel'] = \in_array($phone[1], ['1','2']) ? self::formatTel02($phone) : self::formatTel03($phone);
            }
            $mobile = self::hasMobile($str);
            $data['mobile'] = $mobile ? self::formatMobile($mobile) : '';
        }

        if('1' === $index)
        {
            $mobile = self::hasMobile($str);
            if($mobile)
            {
                $data['mobile'] = self::formatMobile($mobile);
                $str = preg_replace("/[^\d]/", 'p', str_replace($mobile, '', $str));
            }
            $phone = self::hasTel($str);
            $data['tel'] = \in_array($phone[1], ['1','2']) ? self::formatTel02($phone) : self::formatTel03($phone);
        }

        if(\in_array($index, ['4', '8']))
        {
            $phone = self::hasCorp($str);
            if($phone)
            {
                $str = preg_replace("/[^\d]/", 'p', str_replace($phone, '', $str));
                $data['tel'] = self::formatCorp($phone);
            }
            $mobile = self::hasMobile($str);
            $data['mobile'] = $mobile ? self::formatMobile($mobile) : '';
        }
        return $data;
    }

    static public function hasMobile(string $str):string
    {
        $pattern = self::$mobile_pattern;
        preg_match("/{$pattern}/", $str, $matches);
        if(isset($matches['phone']) && $matches['phone'])
        {
            return $matches['phone'];
        }
        return '';
    }

    static public function hasTel(string $str):string
    {
        $pattern02 = self::$tel_pattern02;
        preg_match("/{$pattern02}/", $str, $matches02);
        if(isset($matches02['phone']) && $matches02['phone'])
        {
            return $matches02['phone'];
        }

        $pattern03 = self::$tel_pattern03;
        preg_match("/{$pattern03}/", $str, $matches03);
        if(isset($matches03['phone']) && $matches03['phone'])
        {
            return $matches03['phone'];
        }

        return '';
    }

    static public function hasCorp(string $str):string
    {
        $pattern = self::$corp_pattern;
        preg_match("/{$pattern}/", $str, $matches);
        if(isset($matches['phone']) && $matches['phone'])
        {
            return $matches['phone'];
        }
        return '';
    }

    static private function formatMobile(string $mobile):string
    {
        return preg_replace("/[^\d]/", '', $mobile);
    }

    static private function formatTel02(string $tel):string
    {

        $tel =preg_replace("/[^\d]/", '', $tel);
        return substr($tel, 0, 3) . '-' . substr($tel, 3);
    }

    static private function formatTel03(string $tel):string
    {

        $tel =preg_replace("/[^\d]/", '', $tel);
        return substr($tel, 0, 4) . '-' . substr($tel, 3);
    }

    static private function formatCorp(string $corp):string
    {
        $corp =preg_replace("/[^\d]/", '', $corp);
        return chunk_split(substr($corp,0,6),3,"-") . substr($corp,6);
    }
}