"use strict";

function datatablesServerSide(tableId, columns, columnsDefs, url) {
    var dt;
    dt = $(tableId).DataTable({
        language: {
            url: 'ar.json',
        }, searchDelay: 500, processing: true, serverSide: true, order: [[4, 'desc']], stateSave: false, select: {
            style: 'multi', selector: 'td:first-child input[type="checkbox"]', className: 'row-selected'
        }, ajax: {
            url: url,
        }, columns: columns, columnDefs: columnsDefs,
    });
    dt.on('draw', function () {
        KTMenu.createInstances();
    });
    return dt;
}


var handleFilterDatatable = (dt) => {
    $('.filters').on("change", function () {
        let list = [];
        let type = $(this).attr("data-type")
        list.push({
            "type": type, "val": $(this).val(),
        });
        dt.search(JSON.stringify(list)).draw()

    })
}


var handleSearchDatatable = (dt, searchInput) => {
    document.querySelector(searchInput).addEventListener('keyup', function (e) {
        dt.search(JSON.stringify({
            search: true,
            val: e.target.value,
        })).draw();
    });
}

const handleDeleteDatatable = (dt, url) => {
    $('.delete-form-datatable').on("click", function (e) {
        let id = $(this).attr("data-id");
        Swal.fire({
            text: "هل تريد تأكيد عملية الحذف؟",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "احذف!",
            cancelButtonText: "الغاء",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary",
            },
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        user_id: id ,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        dt.draw();
                    }
                });

            }
        });

    })
    $('.delete-form-datatable').on("click", function (e) {
        let id = $(this).attr("data-id");
        Swal.fire({
            text: "هل تريد تأكيد عملية الحذف؟",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "احذف!",
            cancelButtonText: "الغاء",
            customClass: {
                confirmButton: "btn fw-bold btn-danger",
                cancelButton: "btn fw-bold btn-active-light-primary",
            },
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        user_id: id ,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        dt.draw();
                    }
                });

            }
        });

    })
}




