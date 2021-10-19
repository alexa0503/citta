function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split("&"),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split("=");

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined
                ? true
                : decodeURIComponent(sParameterName[1]);
        }
    }
}
$(document).ready(function() {
    $(".btn-delete").click(function() {
        var url = $(this).attr("href") || $(this).data("url");
        if (confirm("确认删除吗？")) {
            $.ajax({
                url: url,
                method: "POST",
                dataType: "JSON",
                data: {
                    _method: "DELETE",
                    // _token: $('meta[name="csrf-token"]').val()
                },
                success: function(data) {
                    new Noty({
                        timeout: 500,
                        type: "success",
                        text:
                            '<i class="fa fa-check-circle"></i>  删除成功!'
                    })
                        .on("afterShow", function() {
                            location.reload()
                        })
                        .show();
                },
                error: function(xhr, status, error) {
                    new Noty({
                        type: "error",
                        text:
                            '<span class="mdi mdi-close-circle-outline"></span> 服务器错误'
                    }).show();
                }
            });
        }
        return false;
    });

    $(".btn-restore").click(function() {
        var url = $(this).attr("href") || $(this).data("url");
        if (confirm("确认恢复吗？")) {
            $.ajax({
                url: url,
                method: "POST",
                dataType: "JSON",
                data: {
                    // _method: "DELETE",
                    // _token: $('meta[name="csrf-token"]').val()
                },
                success: function(data) {
                    new Noty({
                        timeout: 500,
                        type: "success",
                        text:
                            '<i class="fa fa-check-circle"></i>  操作成功!'
                    })
                        .on("afterShow", function() {
                            location.reload()
                        })
                        .show();
                },
                error: function(xhr, status, error) {
                    new Noty({
                        type: "error",
                        text:
                            '<span class="mdi mdi-close-circle-outline"></span> 服务器错误'
                    }).show();
                }
            });
        }
        return false;
    });
});
