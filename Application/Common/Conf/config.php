<?php
return array(
	//'配置项' =>'配置值'
	'MODULE_ALLOW_LIST' =>    array('Home','Admin',),
	//我们用了入口版定 所以下面这行可以注释掉
	//'DEFAULT_MODULE'    =>    'Home',  // 默认模块
	'SHOW_PAGE_TRACE'   =>  false,
	'LOAD_EXT_CONFIG'   => 'db',
	'URL_CASE_INSENSITIVE'  =>  true,  //url不区分大小写
	'URL_MODEL'   =>1,
	'URL_HTML_SUFFIX'  =>'html',
	//'DEFAULT_FILTER'        => 'htmlspecialchars',
	'SUPER_ADMIN_ID'=>1,  //超级管理员id 删除用户的时候用这个禁止删除
	'SHOW_ERROR_MSG'        =>  true, 
	//用户注册默认信息
//	'DEFAULT_SCORE'=>100,
//	'LOTTERY_NUM'=>3,  //每天最多的抽奖次数


	'ACCESSKEY' => '6u_D2dkYLokKGZbfNDFWBHSuf74JOd7ZKL_c0JMg',//你的accessKey
	'SECRETKEY' => 'KStsD5ouiK0YHoWYD6eRJwW-40J2ybB0qS1w3pXP',//你的secretKey
	'BUCKET' => 'sanliang',//上传的空间
	'DOMAIN'=>'pba0rjj88.bkt.clouddn.com',//空间绑定的域名

//	'UPLOAD_SITEIMG_QINIU'=>array(
//		'maxSize'=>5*1024*1024,//文件大小
//		'rootPath'=>'./',
//		'saveName'=>array('uniqid',''),
//		'driver'=>'Qiniu',
//		'driverConfig'=>array(
//			'accessKey'=>'6u_D2dkYLokKGZbfNDFWBHSuf74JOd7ZKL_c0JMg',//AK和SK 的顺序一定要写对
//			'secretKey'=>'KStsD5ouiK0YHoWYD6eRJwW',//尤其是这个网上大多都写成‘secrectKey’多了个c，坑啊！
//			'domain'=>'pb9rg3zm9.bkt.clouddn.com',
//			'bucket'=>'sanliang',
//		)
//	),
);