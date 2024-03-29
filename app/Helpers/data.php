<?php
use App\Image;
use App\Order;
use Illuminate\Support\Facades\DB;

if (!function_exists('show_array')) {
    function show_array($data)
    {
        if (is_array($data)) {
            echo "<pre>";
            print_r($data);
            echo "<pre>";
        }
    }
}

// Product
if (!function_exists('get_main_image')) {
    function get_main_image($product_id)
    {
        if (!empty(Image::where("product_id", $product_id)->where("rank", "1")->first())) {
            return Image::where("product_id", $product_id)->where("rank", "1")->first()->image_link;
        }
        return false;
    }
}

//Material
if (!function_exists('get_main_image_material')) {
    function get_main_image_material($material_id)
    {
        if (!empty(Image::where("material_id", $material_id)->where("rank", "1")->first())) {
            return Image::where("material_id", $material_id)->where("rank", "1")->first()->image_link;
        }
        return false;
    }
}

// Order
if (!function_exists('get_order_product')) {
    function get_order_product($order_id)
    {
        if (!empty(Order::find($order_id))) {
            return Order::find($order_id)->product;
        }
        return false;
    }
}

if (!function_exists('get_total_price_order')) {
    function get_total_price_order($order_id)
    {
        if (!empty(Order::find($order_id))) {
            $total_price = DB::table("orders")
                ->join("order_product", "orders.id", "order_product.order_id")
                ->join("products", "order_product.product_id", "products.id")
                ->selectRaw("sum(number_order * price_new) as 'total_price'")
                ->where("order_product.order_id", $order_id)
                ->groupBy("order_product.order_id")
                ->first();
            if(!empty($total_price))
                return $total_price->total_price;
        }
        return false;
    }
}

//Lấy số lượng sản phẩm trong kho
if (!function_exists('get_total_quantity_remain')) {
    function get_total_quantity_remain()
    {
        $qty_remain = DB::table("products")
            ->selectRaw("sum(qty_remain) as 'quantity_remain'")
            ->first()->quantity_remain;
        if (!empty($qty_remain)) {
            return $qty_remain;
        }

        return 0;
    }
}

// Lấy số lượng sản phẩm bán ra
if (!function_exists('get_total_quantity_sold')) {
    function get_total_quantity_sold()
    {
        $qty_product = DB::table("products")
            ->selectRaw("sum(qty_sold) as 'quantity_sold'")
            ->first()->quantity_sold;
        if (!empty($qty_product)) {
            return $qty_product;
        }

        return 0;
    }
}

//Doanh số
if (!function_exists('get_total_product_sales')) {
    function get_total_product_sales()
    {
        //
        $orders = DB::table("orders")
            ->where("order_status", "delivery_successful")
            ->get();
        $total_price = 0;
        foreach ($orders as $item) {
            $total_price += get_total_price_order($item->id);
        }
        return $total_price;
    }
}

// Lấy số lượng đơn hàng thành công
if (!function_exists('get_order_success')) {
    function get_order_success()
    {
        return DB::table("orders")
            ->selectRaw("count(id) as 'order_success'")
            ->where("order_status", "delivery_successful")
            ->first()->order_success;
    }
}

// Lấy số lượng đơn hàng đang xử lý
if (!function_exists('get_order_pending')) {
    function get_order_pending()
    {
        return DB::table("orders")
            ->selectRaw("count(id) as 'order_pending'")
            ->where("order_status", "pending")
            ->first()->order_pending;
    }
}

// Lấy số lượng đơn hàng đang vận chuyển
if (!function_exists('get_order_shipping')) {
    function get_order_shipping()
    {
        return DB::table("orders")
            ->selectRaw("count(id) as 'order_shipping'")
            ->where("order_status", "shipping")
            ->first()->order_shipping;
    }
}
