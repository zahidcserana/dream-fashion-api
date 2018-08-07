var current_route = $("#current_route").val();
$("button[type='reset']").click(function () {
    window.location.href = current_route;
});

function getSubCategory(id) {
    $.ajax({
        url: '/get-sub-cat-by-cat',
        type: 'GET',
        data: {category:id},
        success: function (response) {
            //alert(response);
            //var parsed = $.parseJSON(response);
            $("#sub_cat_lebel").show();
            $("#sub_cat_list").show();
            $("#sub_cat_list").html(response);
        }
    });
}