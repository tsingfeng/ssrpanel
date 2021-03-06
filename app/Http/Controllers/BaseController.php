<?php

namespace App\Http\Controllers;
use App\Http\Models\SsConfig;

/**
 * 基础控制器
 * Class BaseController
 * @package App\Http\Controllers
 */
class BaseController extends Controller
{
    // 生成SS密码
    public function makeRandStr($length = 4)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijkmnpqrstuvwxyz23456789';
        $char = '@';
        for ($i = 0; $i < $length; $i++) {
            $char .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $char;
    }

    // base64加密（处理URL）
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    // base64解密（处理URL）
    function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    // 根据流量值自动转换单位输出
    public static function flowAutoShow($value = 0)
    {
        $kb = 1024;
        $mb = 1048576;
        $gb = 1073741824;
        if (abs($value) > $gb) {
            return round($value / $gb, 2) . "GB";
        } else if (abs($value) > $mb) {
            return round($value / $mb, 2) . "MB";
        } else if (abs($value) > $kb) {
            return round($value / $kb, 2) . "KB";
        } else {
            return round($value, 2);
        }
    }

    public static function toMB($traffic)
    {
        $mb = 1048576;
        return $traffic * $mb;
    }

    public static function toGB($traffic)
    {
        $gb = 1048576 * 1024;
        return $traffic * $gb;
    }

    public static function flowToGB($traffic)
    {
        $gb = 1048576 * 1024;
        return $traffic / $gb;
    }

    // 加密方式
    public function methodList()
    {
        return SsConfig::where('type', 1)->get();
    }

    // 协议
    public function protocolList()
    {
        return SsConfig::where('type', 2)->get();
    }

    // 混淆
    public function obfsList()
    {
        return SsConfig::where('type', 3)->get();
    }
}
