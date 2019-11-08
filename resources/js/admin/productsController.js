$(function () {

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var style = {
      'active': 'badge-primary',
      'inactive': 'badge-secondary'
    };


    $('.changeStatusBtn').click(function (e) {
        var thisController = $(this),
            thisId = thisController.parent().data('id'),
            thisUrl = thisController.parent().data('url'),
            statusItem = thisController.closest("tr").find("td:eq(4)");

        axios
            .put(thisUrl, {
                params: {
                    id: thisId,
                }
            }).then(function (res) {
            statusItem.find('span').removeClass('badge-primary badge-secondary').addClass(style[res.data.status]);
            statusItem.find('span').text(capitalizeFirstLetter(res.data.status));
            // statusItem.find('span');
        });

    });

});
