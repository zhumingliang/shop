<?php


namespace app\api\model;


use app\lib\enum\CommonEnum;
use think\Model;

class CategoryT extends Model
{
    public static function CmsCategories($page, $size, $state, $parent_id, $name)
    {
        $list = self::where('parent_id', $parent_id)
            ->where(function ($query) use ($state) {
                if ($state < 3) {
                    $query->where('state', '=', $state);
                }
            })->where(function ($query) use ($name) {
                if (!empty($name)) {
                    $query->where('name', 'like', '%' . $name . '%');
                }
            })
            ->order('create_time desc')
            ->paginate($size, false, ['page' => $page]);
        return $list;
    }

    public static function categorySons($page, $size, $parent_id)
    {
        $list = self::where('parent_id', $parent_id)
            ->where('state', '<', CommonEnum::STATE_IS_DELETE)
            ->order('create_time desc')
            ->paginate($size, false, ['page' => $page]);
        return $list;
    }

    public static function allCategoriesForCms()
    {
        $list = self::where('state', '<', CommonEnum::STATE_IS_DELETE)
            ->field('id,parent_id,name,order')
            ->select()->toArray();
        return $list;
    }

    public static function allCategoriesForMINI()
    {
        $list = self::where('state', '=', CommonEnum::STATE_IS_OK)
            ->field('id,parent_id,name,icon,order')
            ->select()->toArray();
        return $list;
    }

}