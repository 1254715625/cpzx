// window.web_url = 'http://www.view.cc';
var home = {
    cpzx : function(url){
        $.get(url+'/data/cpzx',function(r){
            var r = $.parseJSON(r);
            var content = '',type='';
            $.each(r,function(ind,val){
                if( ind%2 == 0){type = 'left';}else{type = 'right';}
                var data = '<div class="important-t-list0 '+type+'  clearfix cpzxs"><ul class="important-t-list-l im-js">';
                $.each(val,function(index,value){
                    console.log(index);
                    if(value['typename']){
                        if(index == 0){
                            data = data + '<li><i class="num'+(ind+1)+'">'+value['typename']+'</i>'+
                                '<a target="_blank" title="'+value['title']+'" href="'+url+'/News/content/'+value['id']+'">'+value['title'].substr(0,20) +
                                '</br><span>' + value['abstract'].substr(0,50) + '…</span></a></li>';
                        }else{
                            data = data + '<li><a href="'+url+'/News/content/'+value['id']+'" title="'+value['title']+'">'+value['title'].substr(0,20) +'</a></li>';
                        }
                    }

                })
                data = data + '</ul></div>';
                content = content + data;

            })

            $('.w100p').html(content);
        })
    }
}