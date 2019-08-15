<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\ProductT;
use app\api\service\ProductService;
use app\lib\enum\CommonEnum;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessMessageWithData;
use app\lib\exception\UpdateException;
use think\facade\Request;

class Product extends BaseController
{
    /**
     * @api {POST} /api/v1/product/save CMS管理端-新增商品
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription CMS管理端-新增商品
     * @apiExample {post}  请求样例:
     *    {
     *       "c_id":1,
     *       "image":"http://shop.tonglingok.com/static/image/a.png",
     *       "slider_image":["http://shop.tonglingok.com/static/image/a.png","http://shop.tonglingok.com/static/image/b.png"],
     *       "store_name":"短袖",
     *       "store_info":"这是一件很好看的短袖",
     *       "keyword":"白色,帅气",
     *       "price":"199.99",
     *       "ot_price":"299.99",
     *       "postage":10,
     *       "sort":1,
     *       "stock":100,
     *       "is_show":2,
     *       "description":""",
     *       "ficti":100,
     *       "browse":0,
     *       "unit":"件",
     *       "is_best":2,
     *       "is_hot":2,
     *       "is_new":2,
     *       "cost":0,
     *     }
     * @apiParam (请求参数说明) {int} c_id  商品分类id
     * @apiParam (请求参数说明) {String} image  商品主图地址
     * @apiParam (请求参数说明) {String} slider_image  轮播图，最多4张
     * @apiParam (请求参数说明) {String} store_name  商品名称
     * @apiParam (请求参数说明) {String} store_info  简介
     * @apiParam (请求参数说明) {String} keyword  关键词
     * @apiParam (请求参数说明) {float} price  价格
     * @apiParam (请求参数说明) {float} ot_price  原价
     * @apiParam (请求参数说明) {int} postage  邮费
     * @apiParam (请求参数说明) {int} sort  排序
     * @apiParam (请求参数说明) {int} stock  库存
     * @apiParam (请求参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiParam (请求参数说明) {int} is_best  是否精品：1|是；2|否
     * @apiParam (请求参数说明) {int} is_hot  是否热卖：1|是；2|否
     * @apiParam (请求参数说明) {int} is_new  是否新品：1|是；2|否
     * @apiParam (请求参数说明) {float} cost  成本
     * @apiParam (请求参数说明) {String} description  描述
     * @apiParam (请求参数说明) {int} ficti  虚拟销量
     * @apiParam (请求参数说明) {int} browse  浏览量
     * @apiParam (请求参数说明) {String} unit  商品单位
     * @apiSuccessExample {json} 返回样例:
     *{"msg":"ok","errorCode":0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误码： 0表示操作成功无错误
     * @apiSuccess (返回参数说明) {String} msg 信息描述
     */
    public function save()
    {
        $params = Request::param();
        (new ProductService())->save($params);
        return json(new SuccessMessage());
    }

    /**
     * @api {POST} /api/v1/product/update CMS管理端-商品更新
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription CMS管理端-更新
     * @apiExample {post}  请求样例:
     *    {
     *       "id":1,
     *       "c_id":1,
     *       "image":"http://shop.tonglingok.com/static/image/a.png",
     *       "slider_image":["http://shop.tonglingok.com/static/image/a.png","http://shop.tonglingok.com/static/image/b.png"],
     *       "store_name":"短袖",
     *       "store_info":"这是一件很好看的短袖",
     *       "keyword":"白色,帅气",
     *       "price":"199.99",
     *       "ot_price":"299.99",
     *       "postage":10,
     *       "sort":1,
     *       "stock":100,
     *       "is_show":2,
     *       "description":""",
     *       "ficti":100,
     *       "browse":0,
     *       "unit":"件",
     *       "is_best":2,
     *       "is_hot":2,
     *       "is_new":2,
     *       "cost":0,
     *     }
     * @apiParam (请求参数说明) {int} id  商品id
     * @apiParam (请求参数说明) {int} c_id  商品分类id
     * @apiParam (请求参数说明) {String} image  商品主图地址
     * @apiParam (请求参数说明) {String} slider_image  轮播图，最多4张
     * @apiParam (请求参数说明) {String} store_name  商品名称
     * @apiParam (请求参数说明) {String} store_info  简介
     * @apiParam (请求参数说明) {String} keyword  关键词
     * @apiParam (请求参数说明) {float} price  价格
     * @apiParam (请求参数说明) {float} ot_price  原价
     * @apiParam (请求参数说明) {int} postage  邮费
     * @apiParam (请求参数说明) {int} sort  排序
     * @apiParam (请求参数说明) {int} stock  库存
     * @apiParam (请求参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiParam (请求参数说明) {int} is_best  是否精品：1|是；2|否
     * @apiParam (请求参数说明) {int} is_hot  是否热卖：1|是；2|否
     * @apiParam (请求参数说明) {int} is_new  是否新品：1|是；2|否
     * @apiParam (请求参数说明) {float} cost  成本
     * @apiParam (请求参数说明) {String} description  描述
     * @apiParam (请求参数说明) {int} ficti  虚拟销量
     * @apiParam (请求参数说明) {int} browse  浏览量
     * @apiParam (请求参数说明) {String} unit  商品单位
     * @apiSuccessExample {json} 返回样例:
     *{"msg":"ok","errorCode":0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误码： 0表示操作成功无错误
     * @apiSuccess (返回参数说明) {String} msg 信息描述
     */
    public function update()
    {
        $params = Request::param();
        (new ProductService())->update($params);
        return json(new SuccessMessage());
    }

    /**
     * @api {POST} /api/v1/product/handel  CMS管理端-删除商品
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-删除商品
     * @apiExample {POST}  请求样例:
     * {
     * "id": 1,
     * }
     * @apiParam (请求参数说明) {int} id 商品id
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     *
     */
    public function handel()
    {
        $params = $this->request->param();
        $id = ProductT::update(['state' => CommonEnum::STATE_IS_FAIL],
            ['id' => $params['id']]);
        if (!$id) {
            throw new UpdateException();
        }
        return json(new SuccessMessage());

    }

    /**
     * @api {POST} /api/v1/product/show  CMS管理端-商品上下架操作
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-商品上下架操作
     * @apiExample {POST}  请求样例:
     * {
     * "id": 1,
     * "is_show": 1,
     * }
     * @apiParam (请求参数说明) {int} id 商品id
     * @apiParam (请求参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiSuccessExample {json} 返回样例:
     * {"msg": "ok","errorCode": 0}
     * @apiSuccess (返回参数说明) {int} errorCode 错误代码 0 表示没有错误
     * @apiSuccess (返回参数说明) {String} msg 操作结果描述
     *
     */
    public function show()
    {
        $params = $this->request->param();
        $id = ProductT::update(['is_show' => $params['is_show']],
            ['id' => $params['id']]);
        if (!$id) {
            throw new UpdateException();
        }
        return json(new SuccessMessage());

    }

    /**
     * @api {GET} /api/v1/products/cms  CMS管理端-获取商品列表
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-获取商品列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/products/cms?page=1&size=20&c_id=0&key=''
     * @apiParam (请求参数说明) {int} page 当前页码
     * @apiParam (请求参数说明) {int} size 每页多少条数据
     * @apiParam (请求参数说明) {int} c_id  0|所有
     * @apiParam (请求参数说明) {int} key 关键词查询
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"total":1,"per_page":10,"current_page":1,"last_page":1,"data":[{"id":1,"c_id":1,"image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","store_name":"短袖","price":"199.99","sort":1,"sales":0,"stock":1000,"is_show":2,"ficti":0,"browse":0,"create_time":"2019-08-14 23:48:20","zan":0,"collect":0,"is_best":2,"is_hot":2,"is_new":2,"cost":"0.00","category":{"id":1,"name":"衣服"}}]}}
     * @apiSuccess (返回参数说明) {int} total 数据总数
     * @apiSuccess (返回参数说明) {int} per_page 每页多少条数据
     * @apiSuccess (返回参数说明) {int} current_page 当前页码
     * @apiSuccess (返回参数说明) {int} id 商品id
     * @apiSuccess (返回参数说明) {int} c_id  商品分类id
     * @apiSuccess (返回参数说明) {String} image  商品主图地址
     * @apiSuccess (返回参数说明) {String} store_name  商品名称
     * @apiSuccess (返回参数说明) {String} store_info  简介
     * @apiSuccess (返回参数说明) {float} price  价格
     * @apiSuccess (返回参数说明) {float} ot_price  原价
     * @apiSuccess (返回参数说明) {int} sort  排序
     * @apiSuccess (返回参数说明) {int} stock  库存
     * @apiSuccess (返回参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiSuccess (返回参数说明) {int} is_best  是否精品：1|是；2|否
     * @apiSuccess (返回参数说明) {int} is_hot  是否热卖：1|是；2|否
     * @apiSuccess (返回参数说明) {int} is_new  是否新品：1|是；2|否
     * @apiSuccess (返回参数说明) {float} cost  成本
     * @apiSuccess (返回参数说明) {int} ficti  虚拟销量
     * @apiSuccess (返回参数说明) {int} browse  浏览量
     * @apiSuccess (返回参数说明) {int} zan  赞量
     * @apiSuccess (返回参数说明) {int} collect  收藏量
     * @apiSuccess (返回参数说明) {obj} category  商品类别信息
     * @apiSuccess (返回参数说明) {obj} category|id  商品类别id
     * @apiSuccess (返回参数说明) {obj} category|name  商品类别名称
     */
    public function CMSProducts($page = 1, $size = 10, $c_id = 0, $key = '')
    {
        $products = (new ProductService())->CMSProducts($page, $size, $c_id, $key);
        return json(new SuccessMessageWithData(['data' => $products]));
    }

    /**
     * @api {GET} /api/v1/product CMS管理端-获取商品信息
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription  CMS管理端-获取商品信息
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/product?id=1
     * @apiParam (请求参数说明) {int} id 商品id
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"id":1,"c_id":1,"image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","slider_image":"[\"http:\/\/shop.tonglingok.com\/static\/image\/a.png\",\"http:\/\/shop.tonglingok.com\/static\/image\/b.png\"]","store_name":"短袖","store_info":"这是一件很好看的短袖","keyword":"白色,帅气","price":"199.99","ot_price":"299.99","postage":"0.00","sort":1,"sales":0,"stock":1000,"is_show":2,"description":"","ficti":0,"browse":0,"unit":"件","state":1,"create_time":"2019-08-14 23:48:20","update_time":"2019-08-14 23:48:20","zan":0,"collect":0,"is_best":2,"is_hot":2,"is_new":2,"cost":"0.00"}}
     * @apiSuccess (返回参数说明) {int} id 商品id
     * @apiSuccess (返回参数说明) {int} c_id  商品分类id
     * @apiSuccess (返回参数说明) {String} image  商品主图地址
     * @apiSuccess (返回参数说明) {String} slider_image  轮播图，最多4张
     * @apiSuccess (返回参数说明) {String} store_name  商品名称
     * @apiSuccess (返回参数说明) {String} store_info  简介
     * @apiSuccess (返回参数说明) {String} keyword  关键词
     * @apiSuccess (返回参数说明) {float} price  价格
     * @apiSuccess (返回参数说明) {float} ot_price  原价
     * @apiSuccess (返回参数说明) {int} postage  邮费
     * @apiSuccess (返回参数说明) {int} sort  排序
     * @apiSuccess (返回参数说明) {int} stock  库存
     * @apiSuccess (返回参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiSuccess (返回参数说明) {int} is_show  状态（2：未上架，1：上架）
     * @apiSuccess (返回参数说明) {int} is_best  是否精品：1|是；2|否
     * @apiSuccess (返回参数说明) {int} is_hot  是否热卖：1|是；2|否
     * @apiSuccess (返回参数说明) {int} is_new  是否新品：1|是；2|否
     * @apiSuccess (返回参数说明) {float} cost  成本
     * @apiSuccess (返回参数说明) {String} description  描述
     * @apiSuccess (返回参数说明) {int} ficti  虚拟销量
     * @apiSuccess (返回参数说明) {int} browse  浏览量
     * @apiSuccess (返回参数说明) {String} unit  商品单位
     * @apiSuccess (返回参数说明) {int} zan  赞量
     * @apiSuccess (返回参数说明) {int} collect  收藏量
     */
    public function product()
    {
        $id = Request::param('id');
        $product = ProductT::get($id);
        return json(new SuccessMessageWithData(['data' => $product]));
    }

    /**
     * @api {GET} /api/v1/products/index 小程序端-获取首页商品列表
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription 小程序端-获取首页商品列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/products/index
     * @apiParam (请求参数说明) {int} id 商品id
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"is_best":[{"id":1,"store_name":"短袖","image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","price":"199.99","sales":0,"unit":"件"}],"is_hot":[{"id":1,"store_name":"短袖","image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","price":"199.99","sales":0,"unit":"件"}],"is_new":[{"id":1,"store_name":"短袖","image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","price":"199.99","sales":0,"unit":"件"}]}}
     * @apiSuccess (返回参数说明) {obj} is_best 精品推荐商品
     * @apiSuccess (返回参数说明) {obj} is_hot 热卖商品
     * @apiSuccess (返回参数说明) {obj} is_new 新品
     * @apiSuccess (返回参数说明) {int} id 商品id
     * @apiSuccess (返回参数说明) {String} image  商品主图地址
     * @apiSuccess (返回参数说明) {String} store_name  商品名称
     * @apiSuccess (返回参数说明) {float} price  价格
     * @apiSuccess (返回参数说明) {int} sort  排序
     * @apiSuccess (返回参数说明) {int} sales  销量
     * @apiSuccess (返回参数说明) {String} unit  商品单位
     */
    public function indexProducts()
    {
        $products = (new ProductService())->indexProducts();
        return json(new SuccessMessageWithData(['data' => $products]));


    }

    /**
     * @api {GET} /api/v1/products/mini 小程序端-获取更多商品列表
     * @apiGroup  CMS
     * @apiVersion 1.0.1
     * @apiDescription 小程序端-获取更多商品列表
     * @apiExample {get}  请求样例:
     * http://shop.tonglingok.com/api/v1/products/index?type="is_best"&page=1&size=10
     * @apiParam (请求参数说明) {int} page 当前页码
     * @apiParam (请求参数说明) {int} size 每页多少条数据
     * @apiParam (请求参数说明) {string} type 商品类别：is_best|精品推荐商品;is_hot|热卖商品;is_new|新品
     * @apiSuccessExample {json} 返回样例:
     * {"msg":"ok","errorCode":0,"code":200,"data":{"total":1,"per_page":10,"current_page":1,"last_page":1,"data":[{"id":1,"store_name":"短袖","image":"http:\/\/shop.tonglingok.com\/static\/image\/a.png","price":"199.99","sales":0,"unit":"件","ot_price":"299.99"}]}}
     * @apiSuccess (返回参数说明) {int} id 商品id
     * @apiSuccess (返回参数说明) {String} image  商品主图地址
     * @apiSuccess (返回参数说明) {String} store_name  商品名称
     * @apiSuccess (返回参数说明) {float} price  价格
     * @apiSuccess (返回参数说明) {float} ot_price  原价
     * @apiSuccess (返回参数说明) {int} sort  排序
     * @apiSuccess (返回参数说明) {int} sales  销量
     * @apiSuccess (返回参数说明) {String} unit  商品单位
     */
    public function miniProducts($page = 1, $size = 10)
    {
        $type = Request::param('type');
        $products = (new ProductService())->miniProducts($page, $size, $type);
        return json(new SuccessMessageWithData(['data' => $products]));


    }


}