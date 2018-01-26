<?php
return array(
	//'配置项'=>'配置值'
	/* 默认设定 */
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
    'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
    'DEFAULT_JSONP_HANDLER' =>  'jsonpReturn', // 默认JSONP格式返回的处理方法
    'DEFAULT_FILTER'        =>  'htmlspecialchars', // 默认参数过滤方法 用于I函数...
	/* 数据库设置 */
	'DB_TYPE'               =>  'mysqli',     // 数据库类型
	'DB_HOST'               =>  '127.0.0.1', // 服务器地址
	'DB_NAME'               =>  'class',          // 数据库名
	'DB_USER'               =>  'root',      // 用户名
	'DB_PWD'                =>  '',          // 密码
	'DB_PORT'               =>  '',        // 端口
	'DB_PREFIX'             =>  'class_',    // 数据库表前缀
	//添加模板变量规则
     'TMPL_PARSE_STRING' =>array(
            '__PUBLIC__'=> __ROOT__.'/pub',
            '__APUBLIC__' => __ROOT__.'/pub/admin', // 后台admin路径 替换规则
            '__ACSS__' => __ROOT__.'/pub/admin/css', // 后台css路径 替换规则
            '__AJS__' => __ROOT__.'/pub/admin/js', // 后台js路径替换规则
            '__AIMAGE__' => __ROOT__.'/pub/admin/image', // 后台image路径替换规则
            '__AIMG__' => __ROOT__.'/pub/admin/img', // 后台img路径替换规则
            
            '__UPLOAD__' => __ROOT__.'/pub/upload', // 增加新的上传路径替换规则

            '__HPUBLIC__' => __ROOT__.'/pub/home', // 前台admin路径 替换规则
            '__HCSS__' => __ROOT__.'/pub/home/css', // 前台css路径 替换规则
            '__HJS__' => __ROOT__.'/pub/home/js', // 前台js路径替换规则
            '__HIMAGE__' => __ROOT__.'/pub/home/image', // 前台image路径替换规则
            '__HIMG__' => __ROOT__.'/pub/home/img', // 前台img路径替换规则
            
            )


);