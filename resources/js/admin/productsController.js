$(function () {


$('.setActivityBtn').click(function (e) {
    var thisController = $(this),
        thisId = thisController.parent().data('id'),
        thisUrl = thisController.parent().data('url');
    axios
        .put(thisUrl, {
            params: {
                id: thisId,
            }
        }).then(function (res) {
            console.log(res.data);
    });

});

});
