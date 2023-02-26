<?php

if (!function_exists('field_status_user')) {
    function field_status_user($status)
    {
        if ($status == 'licensed') {
            return '<span class="badge badge-success">Đã cấp quyền</span>';
        } else if ($status == "pending") {
            return '<span class="badge badge-primary">Chờ xét duyệt</span>';
        }

        return '<span class="badge badge-dark">Trong thùng rác</span>';
    }
}

if (!function_exists('field_status_user_vi')) {
    function field_status_user_vi($status)
    {
        if ($status == "Chờ xét duyệt") {
            return 'pending';
        } else if ($status == "Đã cấp quyền") {
            return 'licensed';
        }

    }
}

if (!function_exists('field_status')) {
    function field_status($status)
    {
        if ($status == 'licensed') {
            return '<span class="badge badge-success">Đã đăng</span>';
        } else if ($status == 'pending') {
            return '<span class="badge badge-primary">Chờ xét duyệt</span>';
        } else if ($status == 'trashed') {
            return '<span class="badge badge-dark">Trong thùng rác</span>';
        }

    }
}

if (!function_exists('field_status_material')) {
    function field_status_material($status)
    {
        if ($status == 'pass_test') {
            return '<span class="badge badge-success">Đã kiểm tra</span>';
        } else if ($status == 'testing') {
            return '<span class="badge badge-primary">Chưa kiểm tra</span>';
        }

    }
}
if (!function_exists('field_status_vi')) {
    function field_status_vi($status)
    {
        if ($status == 'Đã đăng') {
            return 'licensed';
        } else if ($status == 'Chờ xét duyệt') {
            return 'pending';
        } else if ($status == 'Trong thùng rác') {
            return 'trashed';
        }

    }
}

if (!function_exists('field_status_order')) {
    function field_status_order($status)
    {
        if ($status == 'delivery_successful') {
            return '<span class="badge badge-success">Thành công</span>';
        } else if ($status == 'pending') {
            return '<span class="badge badge-primary">Chờ xét duyệt</span>';
        } else if ($status == 'shipping') {
            return '<span class="badge badge-warning">Đang vận chuyển</span>';
        } else if ($status == 'trashed') {
            return '<span class="badge badge-dark">Vô hiệu hoá</span>';
        }

    }
}

if (!function_exists('field_status_order_vi')) {
    function field_status_order_vi($status)
    {
        if ($status == 'Thành công') {
            return 'delivery_successful';
        } else if ($status == 'Chờ xét duyệt') {
            return 'pending';
        } else if ($status == 'Đang vận chuyển') {
            return 'shipping';
        }

    }
}

if (!function_exists('field_thumb')) {
    function field_thumb($thumb)
    {
        if (!empty($thumb)) {
            echo $thumb;
        } else {
            echo "public/images/img-thumb.png";
        }

    }
}

if (!function_exists('field_level')) {
    function field_level($level)
    {
        if ($level >= 0) {
            echo $level;
        } else {
            echo '<span style="color: #008900db;">Chờ phân quyền</span>';
        }

    }
}

if (!function_exists('template_update_status')) {
    function template_update_status($status)
    {
        $str = "<select name='status' id='status' class='form-control'>";

        $data = array(
            'licensed' => 'Đã đăng',
            'pending' => 'Chờ xét duyệt',
            'trashed' => 'Trong thùng rác',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

if (!function_exists('template_update_status_checked')) {
    function template_update_status_checked($status, $id)
    {
        $str = "<select name=\"status_{$id}\" id=\"status_{$id}\">";

        $data = array(
            'licensed' => 'Đã đăng',
            'pending' => 'Chờ xét duyệt',
            'trashed' => 'Trong thùng rác',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

// Trạng thái người dùng
if (!function_exists('template_update_status_user')) {
    function template_update_status_user($status)
    {
        $str = "<select name='status' id='status' class='form-control'>";

        $data = array(
            'licensed' => 'Đã cấp quyền',
            'pending' => 'Chờ xét duyệt',
            'trashed' => 'Trong thùng rác',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

if (!function_exists('template_update_status_user_checked')) {
    function template_update_status_user_checked($status, $id)
    {
        $str = "<select name=\"status_{$id}\" id='status'>";

        $data = array(
            'licensed' => 'Đã cấp quyền',
            'pending' => 'Chờ xét duyệt',
            'trashed' => 'Trong thùng rác',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

if (!function_exists('template_field_empty')) {
    function template_field_empty()
    {
        return "<span style='color: #333;'>#</span>";
    }
}

if (!function_exists('template_get_field_status')) {
    function template_get_field_status($array_available, $name_field_fixed, $field_status = "")
    {
        $cnt_interation_field_licensed = 0;
        $cnt_interation_field_pending = 0;
        $cnt_interation_field_trashed = 0;
        $cnt_interation_field_shipping = 0;
        $cnt_interation_field_delivery_successful = 0;
        if (!empty($field_status)) {
            foreach ($array_available as $item) {
                if (array_key_exists($name_field_fixed, $item)) {
                    if ($item[$name_field_fixed] == 'licensed') {
                        $cnt_interation_field_licensed++;
                    } else if ($item[$name_field_fixed] == 'pending') {
                        $cnt_interation_field_pending++;
                    } else if ($item[$name_field_fixed] == 'trashed') {
                        $cnt_interation_field_trashed++;
                    } else if ($item[$name_field_fixed] == 'shipping') {
                        $cnt_interation_field_shipping++;
                    } else if ($item[$name_field_fixed] == 'delivery_successful') {
                        $cnt_interation_field_delivery_successful++;
                    }
                }
            }
            if ($field_status == 'licensed') {
                return $cnt_interation_field_licensed;
            } else if ($field_status == 'pending') {
                return $cnt_interation_field_pending;
            } else if ($field_status == 'trashed') {
                return $cnt_interation_field_trashed;
            } else if ($field_status == 'shipping') {
                return $cnt_interation_field_shipping;
            } else if ($field_status == 'delivery_successful') {
                return $cnt_interation_field_delivery_successful;
            }

        } else {
            $cnt_interation_field_all = count($array_available);
            return $cnt_interation_field_all;
        }
    }
}

// Order
if (!function_exists('show_order_status')) {
    function show_order_status($order_status)
    {
        $str = "<select class='form-control w-17' name='order_status' id='status'>";

        $data = array(
            'delivery_successful' => 'Thành côn',
            'shipping' => 'Đang vận chuyển',
            'pending' => 'Chờ xét duyệt',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($order_status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

if (!function_exists('show_defective_product_status')) {
    function show_defective_product_status($defective_product_status)
    {
        $str = "<select class='form-control w-17 d-block' name='defective_product_status' id='status'>";


        $data = array(
            '1' => 'Có thể sửa',
            '0' => 'Không thể sửa',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($defective_product_status == $item) {
                $sel = "selected='selected'";
            }

            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}

if (!function_exists('show_payment_method')) {
    function show_payment_method($method)
    {
        $str = "<select class='form-control w-17' name='payment_method' id='payment-method'>";

        $data = array(
            'payment_home' => 'Thanh toán tại nhà',
            'payment_store' => 'Thanh toán tại cửa hàng',
        );

        foreach ($data as $item => $ele) {
            $sel = "";
            if ($method == $item) {
                $sel = "selected='selected'";
            }
            $str .= "<option value=" . $item . " " . $sel . " >" . $ele . "</option>";
        }

        $str .= "</select>";

        return $str;
    }
}
