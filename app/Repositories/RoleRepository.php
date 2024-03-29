<?php

namespace App\Repositories;

use App\Model\RoleModel;
use App\Model\PermissionModel;

/**
 * 角色权限仓库RolePermissionRepository
 * 主 Model 为 Role
 *
 */
class RoleRepository extends BaseRepository
{

    /**
     * The Permission instance.
     *
     * @var App\Model\PermissionModel
     */
    protected $permission;

    /**
     * Create a new RolePermissionRepository instance.
     *
     * @param  App\Model\RoleModel $role
     * @param  App\Model\PermissionModel $permission
     * @return void
     */
    public function __construct(RoleModel $role, PermissionModel $permission)
    {
        $this->model = $role;
        $this->permission = $permission;
    }

    /**
     * 获取所有角色数据
     *
     * @return Illuminate\Support\Collection
     */
    public function all()
    {
        $roles = $this->model->all();
        return $roles;
    }

    /**
     * 获取所有权限许可
     *
     * @return Illuminate\Support\Collection
     */
    public function permissions()
    {
        $permissions = $this->permission->all();
        return $permissions;
    }

    /**
     * 获取当前角色所拥有的权限
     *
     * @param  Illuminate\Support\Collection $role
     * @return array
     */
    public function getRoleCans($role)
    {
        $perms = $role->perms;
        $cans = array();
        foreach ($perms as $p) {
            $cans[] = ['id' => $p->id, 'name' => $p->name];
        }
        return $cans;
    }


    /**
     * 创建或更新Role
     *
     * @param  App\Model\RoleModel $role
     * @param  array $inputs
     * @return App\Model\RoleModel
     */
    private function saveRole($role, $inputs)
    {
        $role->name = e($inputs['name']);
        $role->display_name = e($inputs['display_name']);
        if (array_key_exists('description', $inputs)) {
            $role->description = e($inputs['description']) ;
        }

        if ($role->save()) {
            if (array_key_exists('permissions', $inputs)) {
                $permissions = $inputs['permissions'];  //这里提交的为数组
                if (is_array($permissions) && $permissions) {
                    $role->perms()->sync($permissions);  //同步角色权限
                }
            } else {
                $role->perms()->sync([]);
            }
        }

        return $role;
    }

    #********
    #* 资源 REST 相关的接口函数 START
    #********
    /**
     * 角色资源列表数据
     * 注：暂使用all()返回所有角色数据，不进行分页与搜索处理
     *
     * @param  array $data
     * @param  string $extra 
     * @param  string $size 分页大小
     * @return Illuminate\Support\Collection
     */
    public function index($data = [], $extra = '', $size = null)
    {
        return $this->all();
    }
    
    public function indexPermissions($data = [], $extra = '', $size = null)
    {
        if (!ctype_digit($size)) {
            $size = cache('page_size', '10');
        }

        $permissions = $this->permission->where(function ($query) use ($data) {
            $s_name = e($data['s_name']);
            if (!empty($s_name)) {
                $query->where('name', 'like', '%'.$s_name.'%')
                    ->orWhere('display_name', 'like', '%'.$s_name.'%');
            }
        })->paginate($size);

        return $permissions;
    }

    /**
     * 存储角色
     *
     * @param  array $inputs
     * @param  string|array $extra
     * @return App\Model\RoleModel
     */
    public function store($inputs, $extra = '')
    {
        $role = new $this->model;
        $role = $this->saveRole($role, $inputs);
        return $role;
    }

    /**
     * 获取编辑的角色
     *
     * @param  int $id
     * @param  string|array $extra
     * @return App\Model\RoleModel
     */
    public function edit($id, $extra = '')
    {
        $role = $this->getById($id);
        return $role;
    }

    /**
     * 更新角色
     *
     * @param  int $id
     * @param  array $inputs
     * @param  string|array $extra
     * @return void
     */
    public function update($id, $inputs, $extra = '')
    {
        $role = $this->getById($id);
        $role = $this->saveRole($role, $inputs);
    }

    #********
    #* 资源 REST 相关的接口函数 END
    #********
}
