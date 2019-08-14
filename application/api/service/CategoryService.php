<?php


namespace app\api\service;


use app\api\model\CategoryT;
use app\lib\enum\UserEnum;
use app\lib\exception\AuthException;
use app\lib\exception\ParameterException;

class CategoryService
{
    public function CmsCategories($page, $size, $state, $parent_id, $name)
    {
        $categories = CategoryT::CmsCategories($page, $size, $state, $parent_id, $name);
        return $categories;

    }

    public function allCategories()
    {
        $type = Token::getCurrentTokenVar('type');
        if ($type == UserEnum::USER_CMS) {
            $categories = CategoryT::allCategoriesForCms();
        } elseif ($type == UserEnum::USER_MINI) {
            $categories = CategoryT::allCategoriesForMINI();
        } else {
            throw  new AuthException();
        }
        $categories = getTree($categories);
        return $categories;
    }

    public function categorySons($page, $size, $parent_id)
    {
        $category = CategoryT::get($parent_id);
        if (!$category) {
            throw new ParameterException();
        }
        $categories = CategoryT::categorySons($page, $size, $parent_id);
        return [
            'parent_name' => $category->name,
            'sons' => $categories
        ];
    }

}