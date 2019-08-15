<?php


namespace app\api\validate;


class Product extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'c_id' => 'require|isPositiveInteger',
        'sort' => 'require|isPositiveInteger',
        'is_show' => 'require|in:1,2',
        'image' => 'require|isNotEmpty',
        'slider_image' => 'require|isNotEmpty',
        'store_name' => 'require|isNotEmpty',
        'store_info' => 'require|isNotEmpty',
        'price' => 'require|isNotEmpty',
        'ot_price' => 'require|isNotEmpty',
        'stock' => 'require|isPositiveInteger',


    ];

    protected $scene = [
        'save' => ['c_id', 'sort', 'is_show', 'image', 'slider_image', 'store_name',
            'store_info', 'price', 'ot_price','stock'],
        'update' => ['id'],
        'handel' => ['id', 'state'],
        'categorySons' => ['id'],
    ];
}