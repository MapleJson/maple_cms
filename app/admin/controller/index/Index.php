<?php

declare(strict_types = 1);

namespace app\admin\controller\index;

use app\admin\model\SysAdmin;
use app\Controller;
use app\common\Code;
use app\common\Common;
use think\App;

class Index extends Controller
{
    public function index()
    {
//        $data = [
//            'mtime'            => date('Y/m/d') . ' ' . date('H:i:s'),
//            'bjTime'           => date('Y/m/d  H:i:s', strtotime('+12 hour')),
//            'date'             => date('Y年m月d日') . ' ' . date('H:i:s'),
//            'loginName'        => session('login_name_1'),
//            'selfId'           => session('adminid'),
//            'role'             => session('quanxian'),
//            'siteId'           => SITE_ID,
//            'chatWsUrl'        => env('OTHER.CHAT_WS_URL'),
//            'chatJqRedisItem'  => env('OTHER.CHAT_JQ_REDIS_ITEM'),
//            'cndUrl'           => env('OTHER.CDN_URL'),
//            'workId'           => md5(md5('pk1688' . SITE_ID . 'company')),
//        ];
//
//        $data['onlineAccountNum'] = request()->isSuper ? count(Common::getOnlineAccountCountBySite(SITE_ID)) : 0;
//
//        //站点所有一二级导航
//        list($data['menus'], $data['sidebars'], $data['collection']) = $this->getMenuByAccount();

        return 222;//view('index/index', $data);
    }

    public function adminOnlineList()
    {
        $accountUid = Common::getOnlineAccountCountBySite(SITE_ID);
        $count      = count($accountUid);
        if ($count) {
            $accountList = SysAdmin::getOnlineAccountList(SITE_ID, $accountUid);
            $data        = [];
            foreach ($accountList as $account) {
                $data[] = [
                    'updateTime' => date('Y-m-d H:i:s', $account['updatetime']),
                    'loginName'  => $account['login_name_1'],
                    'about'      => $account['about'],
                    'loginIp'    => $account['login_ip'],
                ];
            }
            self::setCount($count);
            return $this->responseJson($data);
        }
        return $this->responseJson(Code::EMPTY_ONLINE_ACCOUNT);
    }

    /**
     * 获取权限内导航
     * @return array
     */
    private function getMenuByAccount()
    {
        $siteMenus = AllRoleRecord::getMenuNameByPermission(AgSiteRole::getRoleBySite(SITE_ID));
        // 超管
        if (session('quanxian') === 'sadmin' || session('quanxian') === 'agadmin') {
            return $this->formatMenus($siteMenus);
        }
        // 非超管，踢除无权限的导航
        $permissions = array_filter(array_unique(explode(',', session('quanxian'))));
        foreach ($siteMenus as $key => $siteMenu) {
            if (!in_array($siteMenu['role_name'], $permissions, true)) {
                unset($siteMenu[$key]);
            }
        }

        return $this->formatMenus($siteMenus);
    }

    /**
     * 组装一、二级菜单算法
     *
     * @param array $siteMenus
     *
     * @return array
     */
    private function formatMenus(array $siteMenus)
    {
        $menus = $collections = [];
        //是否收藏导航，默认否
        $collect = false;
        if (session('?collection')) {
            $collect     = true;
            $collections = explode(',', session('collection'));
            $collection  = [
                'name'            => lang('collection'),
                'icon_class_name' => 'layui-icon-star-fill',
            ];
        }
        // 整理一级导航
        foreach ($siteMenus as $siteMenu) {
            if (!(int)$siteMenu['pid']) {
                $menus[$siteMenu['id']] = $siteMenu;
            }
        }
        // 整理二级导航
        foreach ($siteMenus as $siteMenu) {
            if ((int)$siteMenu['pid']) {
                $menus[$siteMenu['pid']]['child'][] = $siteMenu;
            }
            //收藏导航
            if ($collect) {
                if (in_array($siteMenu['role_name'], $collections, true)) {
                    $collection['child'][] = $siteMenu;
                }
            }
        }
        // 踢除没有二级导航的一级导航
        foreach ($menus as $key => $menu) {
            if (empty($menu['child'])) {
                unset($menus[$key]);
            }
        }
        // 无收藏菜单时的所有导航
        $allMenus = array_values($menus);
        // 插入收藏导航
        if (!empty($collection['child'])) {
            array_unshift($menus, $collection);
        }
        unset($collection);

        return [$allMenus, array_values($menus), $collections];
    }
}
