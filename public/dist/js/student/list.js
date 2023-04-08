$(document).ready(function () {
    var status = 1;
    $.fn.dataTable.ext.buttons.active = {
        text: 'Active',
        action: function (e, dt, node, config) {
            $("#box-title").html(" - Active");
            $("#currunt_status").val(1);
            generateTable()
        }
    };
    $.fn.dataTable.ext.buttons.delete = {
        text: 'Delete',
        action: function (e, dt, node, config) {
            $("#box-title").html(" - Deleted");
            $("#currunt_status").val(0);
            generateTable()
        }
    };
    generateTable();

});

function generateTable() {
    var sts = $("#currunt_status").val();
    var _token = $("#_csrf_token").val();
    $("#students").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "destroy": true,
        "responsive": true,
        "ajax": {
            url: BASE_URL + "api/students/list",
            data: {'status': sts, '_token':_token},
            type: "post"
        },
        "columns": [
            {data: 'id'},
            {
                data: 'register_no',
            },
            {
                data: 'name',
            },
            {
                data: 'email',
            },
            {
                data: 'phone',
            },
            {
                data: 'dept_name',
            },
            {
                data: 'year',
            },
            {
                data: 'city',
            },
            {
                data: 'is_active',
                "render": function (data, type, row, meta) {
                    state = row['is_active'];
                    if(state==1) {
                        ret = "<small class=\"badge badge-success\"><i class=\"far fa fa-check\"></i> Active</small>";
                    }else{
                        ret = "<small class=\"badge badge-warning\"><i class=\"far fa fa-close\"></i> In-Active</small>";
                    }
                    return ret;
                }
            },
            {
                data: 'id',
                "render": function (data, type, row, meta)
                {
                    state = row['deleted_at'];
                    var ret = "";
                    var ret = " <button class='btn btn-xs bg-primary' onclick='edit(" + data + ")'><i class='fa fas fa-edit'></i></button>";
                    if(row['is_active']==0) {
                        ret += " <button class='btn btn-xs btn-success' onclick='activate(" + data + ")'><i class='fa fas fa-check'></i></button>";
                    }else{
                        ret += " <button class='btn btn-xs btn-warning' onclick='deactivate(" + data + ")'><i class='fa fas fa-close'></i></button>";
                    }
                    if(state=='' || state==null) {
                        ret += " <button class='btn btn-xs btn-danger' onclick='deleted(" + data + ")'><i class='fa fas fa-trash'></i></button>";
                    }else{
                        ret += " <button class='btn btn-xs btn-info' onclick='restore(" + data + ")'><i class='fa fas fa-trash-restore'></i></button>";
                    }
                    return ret;
                }
            },
        ],
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'copy',
                text: "Copy",
                className: "btn bg-blue btn-sm"
            },
            {
                extend: 'excel',
                text: "Excel",
                className: "btn bg-blue btn-sm",
            },
            {
                extend: 'delete',
                text: "Delete",
                className: "btn bg-red btn-sm"
            },
            {
                extend: 'active',
                text: "Active",
                className: "btn bg-green btn-sm"
            }
        ],
        "stateSave": true
    });
}
