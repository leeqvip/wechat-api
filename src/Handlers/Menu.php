<?php

namespace TechOne\WechatApi\Handlers;

/**
 * 自定义菜单
 *
 * Class Menu
 * @package TechOne\WechatApi\Handlers
 * @author TechLee <techlee@qq.com>
 */
class Menu extends AbstractHandler
{

    /**
     * 自定义菜单创建接口
     * 自定义菜单能够帮助公众号丰富界面，让用户更好更快地理解公众号的功能
     *
     * @param array $menu
     * @return mixed
     * @throws \Exception
     */
    public function create(array $menu)
    {
        return $this->postJson('/menu/create', $menu);
    }

    /**
     * 自定义菜单查询接口
     * 使用接口创建自定义菜单后，开发者还可使用接口查询自定义菜单的结构。另外请注意，在设置了个性化菜单后，使用本自定义菜单查询接口可以获取默认菜单和全部个性化菜单信息。
     *
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        return $this->getJson('/menu/get');
    }

    /**
     * 自定义菜单删除接口
     * 使用接口创建自定义菜单后，开发者还可使用接口删除当前使用的自定义菜单。另请注意，在个性化菜单时，调用此接口会删除默认菜单及全部个性化菜单。
     *
     * @return mixed
     * @throws \Exception
     */
    public function delete()
    {
        return $this->getJson('/menu/delete');
    }
}
