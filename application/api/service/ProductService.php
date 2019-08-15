<?php


namespace app\api\service;


use app\api\model\ProductT;
use app\lib\exception\SaveException;
use app\lib\exception\UpdateException;

class ProductService
{
    public function save($params)
    {
        $product = ProductT::create($params);
        if (!$product) {
            throw new SaveException();
        }

    }

    public function update($params)
    {
        $product = ProductT::update($params);
        if (!$product) {
            throw new UpdateException();
        }

    }

    public function CMSProducts($page, $size, $c_id, $key)
    {
        $products = ProductT:: CMSProducts($page, $size, $c_id, $key);
        return $products;
    }


    public function indexProducts()
    {

        $products = [
            'is_best' => ProductT::indexProducts('is_best'),
            'is_hot' => ProductT::indexProducts('is_hot'),
            'is_new' => ProductT::indexProducts('is_new'),
        ];

        return $products;
    }


    public function miniProducts($page, $size, $type)
    {

        $products = ProductT::miniProducts($page, $size, $type);
        return $products;
    }


}