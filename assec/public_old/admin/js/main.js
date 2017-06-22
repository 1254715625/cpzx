
//window.web_url = 'http://www.view.cc';
window.web_url = '';

function  del(id,type){
    if(confirm("确定要删除？") ){
        window.location.href = web_url+'/admin/data/del?id='+id+'&type='+type;
    }
}

var amaddnew = {
    /*checkid : function(){
        $('input[name="aid"]').mouseleave(function(){
            var id = $(this).val();
            console.log(id);
            if(id){
                var data = {
                    string:id
                }

                $.post(web_url + '/admin/data/userinfo',data,function(r){
                    console.log(r);
                    if(r){
                        $("input[name='aname']").val(r);
                        $("input[name='aname']").show();
                    }
                });
            }
        })

    },*/

}

var amcolum = {
    get_columinfo : function(){
        $('.border-main').click(function(){

            var id = $(this).attr('data');

            $.get(web_url + '/admin/data/columninfo?id='+id,function(r){
                if(r != 1){
                    var data = eval(r);
                    $('input[name="id"]').val(data[0]['id']);
                    $('input[name="name"]').val(data[0]['name']);
                    $('input[name="sort"]').val(data[0]['sort']);
                    $('input[name="key"]').val(data[0]['web_key']);
                    $('input[name="info"]').val(data[0]['web_info']);
                    $('.active').removeClass('active');
                    $('input[name="status"]:eq('+(data[0]['status'])+')').parents('label').addClass('active');
                    $('input[name="status"]:eq('+(data[0]['status'])+')').prop('checked',true);
                }
            })
        })
    },
	   get_lanmu:function(){
        $('.border-main').click(function(){

            var id = $(this).attr('data');

            $.get(web_url + '/admin/data/columninfo?id='+id,function(r){
                if(r != 1){
                    console.log(r);
                    var data = eval(r);
                    $('input[name="id"]').val(data[0]['id']);
                    $('input[name="name"]').val(data[0]['name']);
                    $('input[name="sort"]').val(data[0]['sort']);
                    $('input[name="key"]').val(data[0]['key']);
                    $('input[name="info"]').val(data[0]['info']);
                    //$('input[name="recomend"]').val(data[0]['recomend']);
                    $('.active').removeClass('active');
                    $('input[name="status"]:eq('+(data[0]['status'])+')').parents('label').addClass('active');
                    $('input[name="status"]:eq('+(data[0]['status'])+')').prop('checked',true);
                }
            })
        })
    }
}

var amad= {
    get_adinfo : function(){
        $('.border-main').click(function(){

            var id = $(this).attr('data');

            $.get(web_url + '/admin/data/adinfo?id='+id,function(r){
                if(r != 1){
                    var data = eval(r);
                    $('input[name="id"]').val(data[0]['id']);
                    $('input[name="name"]').val(data[0]['name']);
                    $('input[name="url"]').val(data[0]['url']);
					$('input[name="sslogo"]').val(data[0]['img']);
					var content = $('input[name="sslogo"]').attr('data-image');
					$('input[name="sslogo"]').attr('data-image',content+data[0]['img']);
                }
            })
        })
    }
}
 
var f_link= {
    get_f_link : function(){
        $('.border-main').click(function(){
            var id = $(this).attr('data');
            $.get(web_url + '/admin/data/f_linkinfo?id='+id,function(r){
                if(r != 1){
                    var data = eval(r);
                    $('input[name="id"]').val(data[0]['id']);
                    $('input[name="title"]').val(data[0]['title']);
                    $('input[name="sort"]').val(data[0]['sort']);
                    $('input[name="link"]').val(data[0]['link']);
                }
            })
        })
    }

}
