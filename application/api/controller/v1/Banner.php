<?php
/**
 * Created by PhpStorm.
 * User: mingliang
 * Date: 2018/9/30
 * Time: 上午12:14
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\BannerMiniV;
use app\api\model\BannerT;
use app\api\service\BannerService;
use app\api\validate\BannerValidate;
use app\lib\enum\CommonEnum;
use app\lib\exception\BannerException;
use app\lib\exception\SaveException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessMessageWithData;
use app\lib\exception\UpdateException;
use think\facade\Request;

class Banner extends BaseController
{
    /**
     * @api {POST} /api/v1/banner/save  CMS管理端-新增小程序轮播图
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-新增小程序轮播图
     * @apiExample {post}  请求样例:
     *    {
     *       "title": "第一张"
     *       "url": "http://xxxxx"
     *       "sort": 1
     *     }
     * @apiParam (请求参数说明) {String} url   地址
     * @apiParam (请求参数说明) {String} title    标题
     * @apiParam (请求参数说明) {String} sort    序号
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     */
    public function save()
    {
        $params = Request::param('url');
        $banner = BannerT::create($params);
        if (!$banner) {
            throw  new SaveException();
        }
        return json(new  SuccessMessage());


    }

    /**
     * @api {POST} /api/v1/banner/handel  14-轮播图状态操作
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  管理员删除系统轮播图/管理员审核加盟商添加轮播图/加盟商删除轮播图
     * @apiExample {POST}  请求样例:
     * {
     * "id": 1,
     * "state":2
     * }
     * @apiParam (请求参数说明) {int} id  轮播图id
     * @apiParam (请求参数说明) {String} state   状态类别：1|发布；2|未发布；3|删除
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","error_code": 0}
     * @apiSuccess (返回参数说明) {int} error_code 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     *
     */
    public function handel()
    {
        $params = $this->request->param();
        $id = BannerT::update(['state' => $params['state']], ['id' => $params['id']]);
        if (!$id) {
            throw new UpdateException();
        }
        return json(new SuccessMessage());

    }

    /**
     * @api {POST} /api/v1/banner/update  15-管理员/加盟商修改轮播图
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  管理员/加盟商新增轮播图
     * @apiExample {post}  请求样例:
     *    {
     *       "id": 1,
     *       "title": "第一张"
     *       "url": "http://xxxxx"
     *       "sort": 1
     *     }
     * @apiParam (请求参数说明) {String} id    轮播图id
     * @apiParam (请求参数说明) {String} title    标题
     * @apiParam (请求参数说明) {String} url    图片
     * @apiParam (请求参数说明) {String} sort    序号
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     */
    public function update()
    {
        $params = $this->request->param();
        BannerT::update($params);
        return json(new  SuccessMessage());


    }

    /**
     * @api {GET} /api/v1/banners/mini 小程序端-获取轮播图
     * @apiGroup  MINI
     * @apiVersion 1.0.1
     * @apiDescription  小程序端-获取轮播图
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/banners/mini
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":[{"id":1,"url":"http:\/\/a.png","create_time":"2019-08-15 11:25:54","sort":1,"title":"first"},{"id":2,"url":"http:\/\/2.png","create_time":"2019-08-15 11:27:01","sort":2,"title":"second"}]}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     * @apiSuccess (返回参数说明) {int} id 轮播图id
     * @apiSuccess (返回参数说明) {String} title 标题
     * @apiSuccess (返回参数说明) {int} sort 排序
     * @apiSuccess (返回参数说明) {String} url 轮播图地址
     */
    public function miniBanners()
    {

        $banners = BannerT::where('state', CommonEnum::STATE_IS_OK)
            ->hidden(['state', 'update_time'])
            ->order('sort')
            ->select();
        return json(new SuccessMessageWithData(['data' => $banners]));


    }

    /**
     * @api {GET} /api/v1/banners/cms CMS管理端-获取轮播图列表
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-获取轮播图列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/banners/cms?page=1&size=20
     * @apiParam (请求参数说明) {int} page 当前页码
     * @apiParam (请求参数说明) {int} size 每页多少条数据
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"total":2,"per_page":10,"current_page":1,"last_page":1,"data":[{"id":1,"url":"http:\/\/a.png","state":1,"create_time":"2019-08-15 11:25:54","update_time":"2019-08-15 11:26:46","sort":1,"title":"first"},{"id":2,"url":"http:\/\/2.png","state":1,"create_time":"2019-08-15 11:27:01","update_time":"2019-08-15 11:27:03","sort":2,"title":"second"}]}}
     * @apiSuccess (返回参数说明) {int} total 数据总数
     * @apiSuccess (返回参数说明) {int} per_page 每页多少条数据
     * @apiSuccess (返回参数说明) {int} current_page 当前页码
     * @apiSuccess (返回参数说明) {int} id 轮播图id
     * @apiSuccess (返回参数说明) {String} title 标题
     * @apiSuccess (返回参数说明) {int} sort 排序
     * @apiSuccess (返回参数说明) {String} url 轮播图地址
     * @apiSuccess (返回参数说明) {String} create_time 创建时间
     * @apiSuccess (返回参数说明) {int} state 轮播图状态：1发布；2|未发布
     *
     */
    public function CMSBanners($page = 1, $size = 10, $state = 3)
    {
        $banners = BannerT::where(function ($query) use ($state) {
            if ($state < 3) {
                $query->where('state', $state);
            }
        })
            ->paginate($size, false, ['page' => $page]);
        return json(new SuccessMessageWithData(['data' => $banners]));

    }

}