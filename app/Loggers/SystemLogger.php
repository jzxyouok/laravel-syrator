<?php 

namespace App\Loggers;

use Illuminate\Http\Request;
use App\Model\SystemLogModel;

/**
 * Class
 * 系统日志记录器
 * 操作模型：SystemLog
 * 操作数据表：system_log
 *
 * @package App\Loggers
 * 
 */
class SystemLogger
{

    /**
     * 记录系统日志
     * @param  array $data = [
     *     'user_id' => 0, //默认为0，表示操作者为系统
     *     'type' => 'system', //默认为'system'，表示系统级操作
     *     'url' => '-', //默认为空
     *     'content' => '', //*操作内容，必须传入
     *     'operator_ip' => '', //默认为当前登录用户ip
     *    ]
     * @return boolean 记录系统日志成功，返回true；失败返回false
     */
    public static function write($data)
    {
        if (is_array($data)) {
            if (array_key_exists('content', $data)) {  //如果操作内容不存在，则拒绝记录系统日志
                $data = array_add($data, 'user_id', 0);  //默认为0，表示操作者为系统
                $data = array_add($data, 'type', 'system');  //默认为系统级操作
                $data = array_add($data, 'url', '-');
                $data = array_add($data, 'operator_ip', app('request')->ip());  //操作者ip
                $sys_log = new SystemLogModel;
                $sys_log->fill($data);
                return $sys_log->save($data);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
