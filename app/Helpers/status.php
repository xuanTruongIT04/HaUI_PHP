<?php 

if (!function_exists('hello')) {
function set_status_defective_product($status) {
    if($status == 0) {
        return "<span class='badge badge-danger'>Không thể sửa</span>";
    }
    return  "<span class='badge badge-primary'>Có thể sửa</span>";
}
}

?>