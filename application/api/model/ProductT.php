<?php


namespace app\api\model;


use app\lib\enum\CommonEnum;
use think\Model;

class ProductT extends Model
{
    public function category()
    {
        return $this->belongsTo('CategoryT', 'c_id', 'id');
    }

    public static function CMSProducts($page, $size, $c_id, $key)
    {
        $list = self::where('state', CommonEnum::STATE_IS_OK)
            ->with(['category' => function ($query) {
                $query->field('id,name');
            }])
            ->where(function ($query) use ($c_id) {
                if (!empty($c_id)) {
                    $query->where('c_id', '=', $c_id);
                }
            })->where(function ($query) use ($key) {
                if (!empty($name)) {
                    $query->where('name|keyword', 'like', '%' . $name . '%');
                }
            })
            ->order('sort')
            ->hidden(['update_time', 'slider_image', 'state', 'ot_price', 'store_info', 'keyword',
                'postage', 'description', 'unit'])
            ->paginate($size, false, ['page' => $page]);
        return $list;
    }

    public static function indexProducts($type)
    {
        $list = self::where('state', CommonEnum::STATE_IS_OK)
            ->where('is_show', CommonEnum::STATE_IS_OK)
            ->where($type, CommonEnum::STATE_IS_OK)
            ->order('sort')
            ->field('id,store_name,image,price,(sales+ficti) as sales,unit ')
            ->limit(0, 3)
            ->select();
        return $list;
    }

    public static function miniProducts($page, $size, $type)
    {
        $list = self::where('state', CommonEnum::STATE_IS_OK)
            ->where('is_show', CommonEnum::STATE_IS_OK)
            ->where($type, CommonEnum::STATE_IS_OK)
            ->order('sort')
            ->field('id,store_name,image,price,(sales+ficti) as sales,unit,ot_price ')
            ->paginate($size, false, ['page' => $page]);
        return $list;
    }

}