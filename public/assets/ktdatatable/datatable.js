function datatable(datatable_id){
    localStorage.clear();
    "use strict";

    // Class definition
    var KTDatatablesServerSide = function () {
        // Shared variables
        var table;
        var dt;
        var filterPayment;

        // Private functions
        var initDatatable = function () {
            dt = $("#datatable").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [],
                stateSave: false,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    // url: "https://preview.keenthemes.com/api/datatables.php",
                    url: "{{url()->current()}}",
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: null },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data) {
                            return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                        }
                    },
                    {
                        targets: 1,
                        orderable: false,
                    },
                    {
                        targets: -1,
                        data: null,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                {{__('actions')}}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/admin/categories/create/${row.id}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        {{__('Edit')}}
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row" id="delete_row">
                                         {{__('Delete')}}
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        `;
                        },
                    },
                ],
                // Add data-filter attribute
                createdRow: function (row, data, dataIndex) {
                    // $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
                }
            });

            table = dt.$;

            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            dt.on('draw', function () {
                initToggleToolbar();
                toggleToolbars();
                handleDeleteRows();
                KTMenu.createInstances();
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = function () {

            // const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
            const filterSearch = document.querySelector('#search');
            filterSearch.addEventListener('keyup', function (e) {
                dt.search(e.target.value,"search").draw();
            });
        }

        // Filter Datatable
        var handleFilterDatatable = () => {
            // Select filter options
            filterPayment = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');
            // filterPayment = document.querySelector('#payment_type');
            // const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');
            const filterButton = document.querySelector('#filter');
            // Filter datatable on submit
            filterButton.addEventListener('click', function () {
                // Get filter values
                let paymentValue = '';

                // Get payment value
                filterPayment.forEach(r => {
                    if (r.checked) {
                        paymentValue = r.value;
                    }

                    // Reset payment value if "All" is selected
                    if (paymentValue === 'all') {
                        paymentValue = '';
                    }
                });

                // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                dt.search(paymentValue).draw();
            });
        }

        // Delete customer
        var handleDeleteRows = () => {
            // Select all delete buttons
            // const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');
            const deleteButtons = document.querySelectorAll('#delete_row');

            deleteButtons.forEach(d => {
                // Delete button on click
                d.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Select parent row
                    const parent = e.target.closest('tr');
                    var record_id = $(parent.children[0]).children().children().val();
                    // Get customer name
                    const customerName = parent.querySelectorAll('td')[1].innerText;

                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "{{__('Are you sure you want to delete')}} " + customerName + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            Swal.fire({
                                text: "Deleting " + customerName,
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "You have deleted " + customerName + "!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // delete row data from server and re-draw datatable
                                    axios.post('/admin/categories/'+record_id+'/delete').then(function (response) {
                                        dt.draw();
                                    }).catch(function (error) {
                                        if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
                                            window.location.reload();
                                        }else if(error.response && error.response.status === 419){
                                            window.location.reload();
                                        }
                                    });
                                });
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: customerName + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                })
            });
        }

        // Reset Filter
        var handleResetForm = () => {
            // Select reset button
            // const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');
            const resetButton = document.querySelector('#reset');

            // Reset datatable
            resetButton.addEventListener('click', function () {
                // Reset payment type
                filterPayment[0].checked = true;

                // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                dt.search('').draw();
            });
        }

        // Init toggle toolbar
        var initToggleToolbar = function () {
            // Toggle selected action toolbar
            // Select all checkboxes
            const container = document.querySelector('#datatable');
            const checkboxes = container.querySelectorAll('[type="checkbox"]');

            // Select elements
            const deleteSelected = document.querySelector('#delete_selected');
            // Toggle delete selected toolbar
            checkboxes.forEach(c => {
                // Checkbox on click event
                c.addEventListener('click', function () {
                    setTimeout(function () {
                        toggleToolbars();
                    }, 50);
                });
            });


            // Deleted selected rows
            deleteSelected.addEventListener('click', function () {
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "{{__('confirm_delete_message')}}",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    },
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                        Swal.fire({
                            text: "{{__('Deleting selected records')}}",
                            icon: "info",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function () {
                            Swal.fire({
                                text: "{{__('You have deleted all selected records!')}}",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                const ids = [];
                                const headerCheck = container.querySelectorAll('[type="checkbox"]');
                                headerCheck.forEach((element) => {
                                    if(element.checked == true)
                                        ids.push(parseInt($(element).val()));
                                });
                                // delete row data from server and re-draw datatable
                                axios.post('/admin/categories/delete-selected',{'ids':ids}).then(function (response) {
                                    dt.draw();
                                }).catch(function (error) {
                                    if (error.response && error.response.status === 401 && error.response.data.message === 'Unauthenticated.') {
                                        window.location.reload();
                                    }else if(error.response && error.response.status === 419){
                                        window.location.reload();
                                    }
                                });
                            });

                            // Remove header checked box

                            const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];

                            headerCheckbox.checked = false;
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Selected records was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            });
        }

        // Toggle toolbars
        var toggleToolbars = function () {
            // Define variables
            const container = document.querySelector('#datatable');
            const toolbarBase = document.querySelector('[data-kt-customer-table-toolbar="base"]');
            const toolbarSelected = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
            const selectedCount = document.querySelector('[data-kt-customer-table-select="selected_count"]');

            // Select refreshed checkbox DOM elements
            const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

            // Detect checkboxes state & count
            let checkedState = false;
            let count = 0;

            // Count checked boxes
            allCheckboxes.forEach(c => {
                if (c.checked) {
                    checkedState = true;
                    count++;
                }
            });

            // Toggle toolbars
            if (checkedState) {
                selectedCount.innerHTML = count;
                toolbarBase.classList.add('d-none');
                toolbarSelected.classList.remove('d-none');
            } else {
                toolbarBase.classList.remove('d-none');
                toolbarSelected.classList.add('d-none');
            }
        }

        // Public methods
        return {
            init: function () {
                initDatatable();
                handleSearchDatatable();
                initToggleToolbar();
                handleFilterDatatable();
                handleDeleteRows();
                handleResetForm();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });
    $(document).ready(function() {
        //set initial state.
        $('#all_checked').val(this.checked);

        $('#all_checked').change(function() {
            const headerAllCheck = document.querySelector('#datatable').querySelectorAll('[type="checkbox"]');
            if(this.checked) {
                headerAllCheck.forEach((element) => {
                    element.checked = true
                });
            }else{
                headerAllCheck.forEach((element) => {
                    element.checked = false
                });
            }
            $('#all_checked').val(this.checked);
        });
    });
}
