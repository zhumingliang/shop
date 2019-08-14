<?php


namespace app\api\validate;


class Category extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
        'parent_id' => 'require',
        'name' => 'require|isNotEmpty',
        'state' => 'require|in:1,2,3',
        'order' => 'require|isPositiveInteger',

    ];

    protected $scene = [
        'save' => ['parent_id', 'name', 'state', 'order'],
        'update' => ['id'],
        'handel' => ['id','state'],
        'categorySons' => ['id'],
    ];
}