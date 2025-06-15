$(function () {
    $("body").append("<img id='goTopButton' style='display: none; z-index: 5; cursor: pointer;' title='回到頂端'/>");
    var img = "gotop.png", //宣告變數定圖檔名稱
        location = 0.5,       //按扭出現在螢幕高度
        right = 200,           //距離右邊的PX值
        opacity = 0.5,         //預設透明度
        speed = 800,           //返回TOP捲動速度
        $button = $("#goTopButton"), //定義JQUERY呼叫圖片ID
        $body = $(document),            //定義JQUERY網頁
        $win = $(window);       //定義JQUERY瀏覽器chrome
    $button.attr("src", img); //將圖設定到goTopButtion的src


    //建立當網頁捲動，呼叫自訂函數
    window.goTopMove = function () {  //從網頁取得與頂端離距的數值，約75-165PX之間
        var scrollH = $body.scrollTop(),
            winH = $win.height(), //從瀏覽器取得高度
            css = { "top": winH * location + "px", "position": "fixed", "right": right, "opacity": opacity, "z-index": 10000 }; // 將參數設定css，並設置z-index


        if (scrollH > 20) {
            $button.css(css);
            $button.fadeIn("slow");
        }
        else {
            css = { "transform": "none", };
            $button.css(css);
            $button.fadeOut("slow");
        }
    };
    //設定瀏覽器監聽兩個動作，分別為SCROLL與resize
    $win.on({
        scroll: function () { goTopMove(); },
        resize: function () { goTopMove(); }
    });
    //設定瀏覽器監聽圖片三個動作，分別為1滑鼠滑過去與2滑鼠滑出去與3按下動作
    $button.on({
        mouseover: function () { $button.css("opacity", 1); },
        mouseout: function () { $button.css("opacity", opacity); },
        click: function () {
            //將圖示返回TOP時，加上旋轉特效
            css = { "transform":  "rotate(720deg)", "transition": "transform 1s ease 0s" };
            $button.css(css);
            $("html, body").animate({ scrollTop: 0 }, speed);
        }
    });
});