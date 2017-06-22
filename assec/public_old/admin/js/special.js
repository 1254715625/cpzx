//s开头为后台特效
var ashome = {
    left_change: function () {
        $('.leftnav h2').click(function () {
            $('.leftnav ul').hide(500);
            var num = $('.leftnav h2').index(this);
            $('.leftnav ul:eq(' + num + ')').show(500);
        })
    }
}

var ascontent_manage = {
    rili: function () {
        $(function () {
            $("#txtBeginDate").calendar({
                controlId: "divDate",                                 // 弹出的日期控件ID，默认: $(this).attr("id") + "Calendar"
                speed: 200,                                           // 三种预定速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认：200
                complement: true,                                     // 是否显示日期或年空白处的前后月的补充,默认：true
                readonly: true,                                       // 目标对象是否设为只读，默认：true
                upperLimit: new Date(),                               // 日期上限，默认：NaN(不限制)
                lowerLimit: new Date("2011/01/01"),                   // 日期下限，默认：NaN(不限制)
            });
        });
    }
}

var asaddimg = {
    del : function(){
        $('.imgcontent li').mousemove(function(){
            $(this).children('.delimg').show();
        })

        $('.imgcontent li').mouseleave(function(){
            $(this).children('.delimg').hide();
        })

        $('.delimg').click(function(){
            if(confirm('确定要删除吗？')){
                $(this).parents('li').remove();
            }
        })
    }
}