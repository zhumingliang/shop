<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\CategoryT;
use app\api\service\CategoryService;
use app\lib\enum\CommonEnum;
use app\lib\exception\SaveException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessMessageWithData;
use app\lib\exception\UpdateException;
use think\facade\Request;

class Category extends BaseController
{
    /**
     * @api {POST} /api/v1/category/save CMS管理端-新增分类
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-新增分类
     * @apiExample {post}  请求样例:
     *    {
     *       "parent_id": 0
     *       "name": "家用电器"
     *       "icon": "/static"
     *       "state": "1"
     *       "order": 1
     *     }
     * @apiParam (请求参数说明) {string} name    分类名称
     * @apiParam (请求参数说明) {int} parent_id   分类上级id，顶级：parent_id=0
     * @apiParam (请求参数说明) {string} icon  分类图片
     * @apiParam (请求参数说明) {int} order  排序
     * @apiParam (请求参数说明) {int} state  状态 1|显示；2|隐藏
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     */
    public function save()
    {
        $params = $this->request->param();
        $params['state'] = CommonEnum::STATE_IS_OK;
        $id = CategoryT::create($params);
        if (!$id) {
            throw  new SaveException();
        }
        return json(new SuccessMessage());

    }

    /**
     * @api {POST} /api/v1/category/handel  CMS管理端-分类状态操作
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-删除分类
     * @apiExample {POST}  请求样例:
     * {
     * "id": 1,
     * "state": 1,
     * }
     * @apiParam (请求参数说明) {int} id 分类id
     * @apiParam (请求参数说明) {int} state  状态 1|显示；2|隐藏;3|删除
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     *
     */
    public function handel()
    {
        $params = $this->request->param();
        $id = CategoryT::update(['state' => $params['state']],
            ['id' => $params['id']]);
        if (!$id) {
            throw new UpdateException();
        }
        return json(new SuccessMessage());

    }

    /**
     * @api {POST} /api/v1/category/update  CMS管理端-修改分类
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription   CMS管理端-修改分类
     * @apiExample {post}  请求样例:
     *    {
     *       "id": 1
     *       "parent_id": 0
     *       "name": "家用电器"
     *       "icon": "/static"
     *       "state": "1"
     *       "order": 1
     *     }
     * @apiParam (请求参数说明) {int} id 分类id
     * @apiParam (请求参数说明) {string} name    分类名称
     * @apiParam (请求参数说明) {int} parent_id   分类上级id，顶级：parent_id=0
     * @apiParam (请求参数说明) {string} icon  分类图片地址
     * @apiParam (请求参数说明) {int} order  排序
     * @apiParam (请求参数说明) {int} state  状态 1|显示；2|隐藏
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     *
     */
    public function update()
    {
        $params = $this->request->param();
        $id = CategoryT::update($params, ['id' => $params['id']]);
        if (!$id) {
            throw new UpdateException();

        }
        return json(new  SuccessMessage());

    }

    /**
     * @api {GET} /api/v1/categories/cms  CMS管理端-获取分类列表
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-获取分类列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/categories/cms?page=1&size=20&state=3&parent_id&name=''
     * @apiParam (请求参数说明) {int} page 当前页码
     * @apiParam (请求参数说明) {int} size 每页多少条数据
     * @apiParam (请求参数说明) {int} state 分类状态：1|显示；2|隐藏；3|所有分类
     * @apiParam (请求参数说明) {int} parent_id  0|所有菜单（顶级）
     * @apiParam (请求参数说明) {int} name 名称查询
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"total":2,"per_page":10,"current_page":1,"last_page":1,"data":[{"id":4,"name":"电器","state":1,"create_time":"2019-08-14 09:12:16","update_time":"2019-08-14 09:12:16","icon":null,"order":1,"parent_id":0},{"id":1,"name":"衣服","state":1,"create_time":"2019-08-14 09:11:25","update_time":"2019-08-14 09:11:25","icon":null,"order":1,"parent_id":0}]}}
     * @apiSuccess (返回参数说明) {int} total 数据总数
     * @apiSuccess (返回参数说明) {int} per_page 每页多少条数据
     * @apiSuccess (返回参数说明) {int} current_page 当前页码
     * @apiSuccess (返回参数说明) {int} id 分类id
     * @apiSuccess (返回参数说明) {string} name    分类名称
     * @apiSuccess (返回参数说明) {int} parent_id   分类上级id，顶级：parent_id=0
     * @apiSuccess (返回参数说明) {string} icon  分类图片地址
     * @apiSuccess (返回参数说明) {int} order  排序
     * @apiSuccess (返回参数说明) {int} state  状态 1|显示；2|隐藏
     */
    public function CmsCategories($page = 1, $size = 10, $state = 3, $parent_id = 0, $name = '')
    {
        $categories = (new CategoryService())->CmsCategories($page, $size, $state, $parent_id, $name);
        return json(new SuccessMessageWithData(['data' => $categories]));

    }

    /**
     * @api {GET} /api/v1/categories  CMS管理端/小程序-获取分类列表
     * @apiGroup  COMMON
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端/小程序-获取分类列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/categories
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":[{"id":1,"parent_id":0,"name":"衣服","icon":null,"order":1,"items":[{"id":2,"parent_id":1,"name":"短袖","icon":null,"order":2},{"id":3,"parent_id":1,"name":"裤子","icon":null,"order":3}]},{"id":4,"parent_id":0,"name":"电器","icon":null,"order":1,"items":[{"id":5,"parent_id":4,"name":"洗衣机","icon":null,"order":1}]}]}
     * @apiSuccess (返回参数说明) {int} id 分类id
     * @apiSuccess (返回参数说明) {string} name    分类名称
     * @apiSuccess (返回参数说明) {int} parent_id   分类上级id，顶级：parent_id=0
     * @apiSuccess (返回参数说明) {string} icon  分类图片地址
     * @apiSuccess (返回参数说明) {int} order  排序
     * @apiSuccess (返回参数说明) {obj} items  当前分类子级分类
     */
    public function Categories()
    {
        $categories = (new CategoryService())->allCategories();
        return json(new SuccessMessageWithData(['data' => $categories]));
    }

    /**
     * @api {GET} /api/v1/category/sons  CMS管理端-获取指定分类子级菜单
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-获取分类列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/category/sons?id=1&page=1&size=10
     * @apiParam (请求参数说明) {int} page 当前页码
     * @apiParam (请求参数说明) {int} size 每页多少条数据
     * @apiParam (请求参数说明) {int} id 分类id
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"parent_name":"衣服","sons":{"total":2,"per_page":10,"current_page":1,"last_page":1,"data":[{"id":3,"name":"裤子","state":1,"create_time":"2019-08-14 09:12:04","update_time":"2019-08-14 09:12:04","icon":null,"order":3,"parent_id":1},{"id":2,"name":"短袖","state":1,"create_time":"2019-08-14 09:11:54","update_time":"2019-08-14 09:11:54","icon":null,"order":2,"parent_id":1}]}}}
     * @apiSuccess (返回参数说明) {int} parent_name 父级名称
     * @apiSuccess (返回参数说明) {obj} sons 子级列表
     * @apiSuccess (返回参数说明) {int} total 数据总数
     * @apiSuccess (返回参数说明) {int} per_page 每页多少条数据
     * @apiSuccess (返回参数说明) {int} current_page 当前页码
     * @apiSuccess (返回参数说明) {int} id 分类id
     * @apiSuccess (返回参数说明) {string} name    分类名称
     * @apiSuccess (返回参数说明) {int} parent_id   分类上级id，顶级：parent_id=0
     * @apiSuccess (返回参数说明) {string} icon  分类图片地址
     * @apiSuccess (返回参数说明) {int} order  排序
     * @apiSuccess (返回参数说明) {int} state  状态 1|显示；2|隐藏
     */
    public function categorySons($page = 1, $size = 10)
    {
        $parent_id = Request::param('id');
        $categories = (new CategoryService())->categorySons($page, $size, $parent_id);
        return json(new SuccessMessageWithData(['data' => $categories]));
    }

}