<?php

namespace TechOne\WechatApi\Handlers;

/**
 * 用户标签管理
 * 开发者可以使用用户标签管理的相关接口，实现对公众号的标签进行创建、查询、修改、删除等操作，也可以对用户进行打标签、取消标签等操作。
 *
 * Class Tags
 * @package TechOne\WechatApi\Handlers
 * @author TechLee <techlee@qq.com>
 */
class Tags extends AbstractHandler
{
    /**
     * 创建标签
     * 一个公众号，最多可以创建100个标签。
     * @param string $tagName
     * @return mixed
     * @throws \Exception
     */
    public function create(string $tagName)
    {
        return $this->postJson('/tags/create', [
            'tag' => [
                'name' => $tagName,
            ],
        ]);
    }

    /**
     * 获取公众号已创建的标签
     *
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        return $this->getJson('/tags/get');
    }

    /**
     * 编辑标签
     *
     * @param $TagId
     * @param $tagName
     * @return mixed
     * @throws \Exception
     */
    public function update($tagId, $tagName)
    {
        return $this->postJson('/tags/update', [
            'tag' => [
                'id' => $tagId,
                'name' => $tagName,
            ],
        ]);
    }

    /**
     * 删除标签
     *
     * @param $TagId
     * @return mixed
     * @throws \Exception
     */
    public function delete($TagId)
    {
        return $this->postJson('/tags/delete', [
            'tag' => [
                'id' => $TagId,
            ],
        ]);
    }

    /**
     * 获取标签下粉丝列表
     *
     * @param $tagId
     * @param null $nextOpenid
     * @return mixed
     * @throws \Exception
     */
    public function user($tagId, $nextOpenid = null)
    {
        $data = ['tagid' => $tagId];
        if ($nextOpenid != null) {
            $data['next_openid'] = $nextOpenid;
        }
        return $this->postJson('/user/tag/get', $data);
    }

    /**
     * 1. 批量为用户打标签
     *
     * @param $tagId
     * @param array $openids
     * @param bool $cancel
     * @return mixed
     * @throws \Exception
     */
    public function batchtagging($tagId, array $openids, $cancel = false)
    {
        return $this->postJson('/tags/members/' . ($cancel ? 'batchuntagging' : 'batchtagging'), [
            'openid_list' => $openids,
            'tagid' => $tagId,
        ]);
    }

    /**
     * 批量为用户取消标签
     *
     * @param $tagId
     * @param array $openids
     * @return mixed
     * @throws \Exception
     */
    public function batchuntagging($tagId, array $openids)
    {
        return $this->batchtagging($tagId, $openids, true);
    }

    /**
     * 获取用户身上的标签列表
     *
     * @param $openid
     * @return mixed
     * @throws \Exception
     */
    public function idlist($openid)
    {
        return $this->postJson('/tags/getidlist', [
            'openid' => $openid,
        ]);
    }
}
