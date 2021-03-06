<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

namespace app\classes\personal;

use app\classes\Ctrl as Ctrl_Base;
use ginkgo\Loader;
use ginkgo\Route;
use ginkgo\Func;
use ginkgo\Config;
use ginkgo\Plugin;

//不能非法包含或直接执行
defined('IN_GINKGO') or exit('Access denied');


/*-------------控制中心通用控制器-------------*/
abstract class Ctrl extends Ctrl_Base {

    protected function c_init($param = array()) { //构造函数
        parent::c_init();

        Plugin::listen('action_personal_init'); //管理后台初始化时触发

        $this->mdl_user       = Loader::model('User');
        $this->mdl_verify     = Loader::model('Verify');

        $this->configMailtpl    = $this->config['var_extra']['mailtpl'];
    }

    protected function pathProcess() {
        parent::pathProcess();

        $_str_pathTpl = Config::get('path', 'tpl');

        $_str_pathTplPersonal = GK_PATH_TPL;

        if (!Func::isEmpty($_str_pathTpl)) {
            $_str_pathTplPersonal = BG_TPL_PERSONAL . DS . $_str_pathTpl . DS;
        }

        $_arr_url = array(
            'path_tpl_personal' => $_str_pathTplPersonal,
        );

        $this->url = $_arr_url;

        $this->generalData = array_replace_recursive($this->generalData, $_arr_url);
    }
}
