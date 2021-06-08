function autoComplete(ele, type) {
    $(ele).next().empty();
    var ajaxAutoFieldURL =  `${window.location.origin}${window.location.pathname}/autosearch`;
    var token = $('[name="_token"]').val();
    var value = $(ele).val();
    var data = {_token: token, type: type, value: value};
    if(value.trim() == '') {
        return true;
    }

    $.ajax({
        url: ajaxAutoFieldURL,
        type: "GET",
        data: data,
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $(ele).next().empty().append($(data.html))
        }
    })
}

$(".column-name, .column-content").on("click", function() {
    var orderBy = $(this).text().trim().toLowerCase();
    if($('[name="orderBy"]').length) {
        $('[name="orderBy"]').val(orderBy);
        if($('[name="orderByType"]').val() == "DESC") {
            $('[name="orderByType"]').val("ASC")
        } else {
            $('[name="orderByType"]').val("DESC")
        }
    } else {
        $('#frmSearch').append('\
            <input class="" style="display: none" name="orderByType" value="ASC">\
            <input class="" style="display: none" name="orderBy" value="'+orderBy+'">\
        ')
    }
    $('#frmSearch').submit();

})

function setValueInput(e) {
    $(e).parents('.frmSearch').children('input').val($(e).text().trim());
    $(e).parents('.frmSearch').children('div').empty();
}

$('#delete-post').on('submit', function(e) {
    var confirm = window.confirm("Do you want to delete this post");
    if (confirm != true) {
        return false;
    } 
})
