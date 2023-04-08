function action_delete(action_data, myCallback) {
    $.confirm({
        title: action_data.title,
        content: action_data.content,
        type: action_data.type,
        buttons: {
            yes: function () {
                $.ajax({
                    url: action_data.url,
                    type: "delete",
                    data: {id: action_data.id, '_token': action_data.token},
                    dataType: 'json',
                    async: false,
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == 200) {
                            message(parseInt(data.status), data.message);
                        }
                    },
                    complete: function (xhr, textStatus) {
                        var data = JSON.parse(xhr.responseText);
                        ajax_error(data, xhr)
                        myCallback()
                    }
                });
            },
            no: function () {
                $.alert({
                    title: "Your data safe",
                    content: 'No changes made',
                    type: 'blue'
                });
            }
        }
    });
}

function action_restore(action_data, myCallback) {
    $.confirm({
        title: action_data.title,
        content: action_data.content,
        type: action_data.type,
        buttons: {
            yes: function () {
                $.ajax({
                    url: action_data.url,
                    type: "get",
                    data: {id: action_data.id, '_token': action_data.token},
                    dataType: 'json',
                    async: false,
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == 200) {
                            message(parseInt(data.status), data.message);
                        }
                    },
                    complete: function (xhr, textStatus) {
                        var data = JSON.parse(xhr.responseText);
                        ajax_error(data, xhr);
                        myCallback()
                    }
                });
            },
            no: function () {
                $.alert({
                    title: "Your data safe",
                    content: 'No changes made',
                    type: 'blue'
                });
            }
        }
    });
}

function action_status(action_data, myCallback) {
    $.confirm({
        title: action_data.title,
        content: action_data.content,
        type: action_data.type,
        buttons: {
            yes: function () {
                $.ajax({
                    url: action_data.url,
                    type: "get",
                    dataType: 'json',
                    async: false,
                    success: function (data, textStatus, xhr) {
                        if (xhr.status == 200) {
                            message(parseInt(data.status), data.message);
                        }
                    },
                    complete: function (xhr, textStatus) {
                        var data = JSON.parse(xhr.responseText);
                        ajax_error(data, xhr)
                        myCallback()
                    }
                });
            },
            no: function () {
                $.alert({
                    title: "Your data safe",
                    content: 'No changes made',
                    type: 'blue'
                });
            }
        }
    });
}
