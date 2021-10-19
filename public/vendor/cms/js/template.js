(function($) {
    "use strict";
    $(function() {
        var body = $("body");
        var contentWrapper = $(".content-wrapper");
        var scroller = $(".container-scroller");
        var footer = $(".footer");
        var sidebar = $(".sidebar");

        //Add active class to nav-link based on url dynamically
        //Active class can be hard coded directly in html file also as required
        function addActiveClass(element) {
            if (current === "") {
                //for root url
                if (element.attr("href").indexOf("dashboard") !== -1) {
                    element
                        .parents(".nav-item")
                        .last()
                        .addClass("active");
                    if (element.parents(".sub-menu").length) {
                        element.closest(".collapse").addClass("show");
                        element.addClass("active");
                    }
                }
            } else {
                //for other url
                if (element.attr("href").indexOf(current) !== -1) {
                    element
                        .parents(".nav-item")
                        .last()
                        // .addClass("active");
                    if (element.parents(".sub-menu").length) {
                        element.closest(".collapse").addClass("show");
                        if(element.attr("href") === (location.origin+location.pathname)){
                            element.addClass("active");
                        }
                    }
                    element.parents(".nav-item").addClass("active");
                    // if (element.parents(".nav-item").length) {
                    //     // element.addClass("active");
                    // }
                }
            }
        }

        // var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
        var current = location.pathname.split("/").slice(2);
        if (location.pathname.split("/").length === 5) {
            current = current[0];
        } else {
            current = current.join("/");
        }
        // addActiveClass($("#category_cities").parents("div.nav-item").find("a").eq(0));
        // $(".nav li a", sidebar).each(function() {
        //     var $this = $(this);
        //     console.log($(this))
        //     // addActiveClass($this);
        // });

        //Close other submenu in sidebar on opening any

        // sidebar.on("show.bs.collapse", ".collapse", function() {
        //     sidebar.find(".collapse.show").collapse("hide");
        // });

        //Change sidebar

        $('[data-toggle="minimize"]').on("click", function() {
            body.toggleClass("sidebar-icon-only");
        });

        //checkbox and radios
        $(".form-check label,.form-radio label").append(
            '<i class="input-helper"></i>'
        );
    });
})(jQuery);
