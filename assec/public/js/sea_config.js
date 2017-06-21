seajs.config({
	base : 'http://css.cyzone.cn/templates/cyzonev3/js/',
	alias:{
		func : 'lib/function',
		validform : 'lib/validform',
		cookie : 'lib/jquery.cookie',
		unslider : 'lib/unslider',
		layer : 'lib/layer/layer',
		tongji : 'lib/tongji'
	},
	map: [
	[ /^(.*\/templates\/cyzonev3\/js\/.*\.(?:css|js))(?:.*)$/i, '$1?201702211630' ]
	],
	vars:{
		temp : '/templates/cyzonev3/',
		member_layer_url : 'http://www.cyzone.cn/index.php?m=content&c=index&a=init&tpl=member_pannel'
	},
	charset : 'utf-8'
});
seajs.use(['init','tongji']);