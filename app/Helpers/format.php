<?php
use Carbon\Carbon;

if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = ' VNĐ')
    {
        if (!empty($number))
            return number_format($number) . $suffix;
        return "<span class='text-muted'>Chưa cập nhật</span>";

    }
}

if (!function_exists('time_format')) {
    function time_format($dateTime)
    {
        if (!empty($dateTime)) {
            $dt = new Carbon($dateTime);
            return $dt -> format("H:i:s d/m/Y");
        }
        
        return Carbon::now() -> format("H:i:s d/m/Y");
    }
}

if (!function_exists('slug_format')) {
    function slug_format($slug, $create_date)
    {
        if (strlen(strstr($slug, date("Ymd", $create_date) . ".html")) > 4) {
            return $slug;
        }
        return $slug . "-" . date("Ymd", $create_date) . ".html";
    }
}

if (!function_exists('code_product_format')) {
    function code_product_format($slug)
    {
        return "ISMART#" . substr(md5($slug), 10, 8);
    }
}

if (!function_exists('code_order_format')) {

    function code_order_format($order_id)
    {
        return "ISMART#" . substr(md5($order_id), 0, 10);
    }
}


