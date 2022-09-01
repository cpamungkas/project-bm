    <!-- Libs JS -->
    <!-- <script src="./libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script src="./libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
    <script src="./libs/jsvectormap/dist/maps/world.js" defer></script>
    <script src="./libs/jsvectormap/dist/maps/world-merc.js" defer></script>-->
    <script src="./libs/litepicker/dist/litepicker.js" defer=""></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/litepicker/2.0.12/litepicker.js" integrity="sha512-ZbnsrTCJAJWynwgi3ndt7jcjwrJfHNzUh/mZakBRhZG8lYgMVtZLxY2CG4GuONoER9E8iiuupt4fnrNfXy+aGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script> -->
    <!-- Tabler Core -->
    <script src="./js/tabler.min.js" defer></script>
    <!-- <script src="./js/demo.min.js" defer></script> -->

    <?php if ($url == 'store' or $url == 'employee' or $url == 'techshift'  or $url == 'techjobout' or $url == 'techjobin' or $url == 'level') { ?>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.jqueryui.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.jqueryui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
        <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script> -->

    <?php } ?>

    <script type="text/javascript">
        function showLoading() {
            document.getElementById("cover-spin").classList.add("d-block");
        }

        function hideLoading() {
            document.getElementById("cover-spin").classList.remove("d-block");
        }

        $(document).bind("ajaxSend", function() {
            showLoading();
        }).bind("ajaxComplete", function() {
            hideLoading();
        });

        <?php if ($url == 'store' or $url == 'employee' or $url == 'techshift'  or $url == 'techjobout' or $url == 'techjobin' or $url == 'level') { ?>
            $(document).ready(function() {
                var myTable = $('#dynamic-table')
                var table = $('#dynamic-table').DataTable({
                    lengthChange: true,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        ['5', '10', '25', '50', 'Show all']
                    ],
                    responsive: false,
                    // dom: 'bfrtip',
                    // paging: true,
                    // "info": true,
                    // "iDisplayLength": 10,
                    // fixedColumns: true,
                    // scrollY: 300,
                    // scrollX: true,
                    // scrollCollapse: true,

                    select: true,
                    // {
                    //     style: 'multi'
                    // },
                    buttons: [{
                            "extend": "colvis",
                            "text": "<i class='fa fa-eye bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                            "className": "btn-outline-primary",
                            columns: ':not(:first):not(:last)'
                        },
                        {
                            "extend": "copy",
                            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                            "className": "btn btn-primary btn-outline-*"
                        },
                        {
                            "extend": "print",
                            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                            "className": "btn btn-white btn-primary btn-bold",
                            autoPrint: false,
                            message: 'This print was produced using the Print button for DataTables'
                        },
                        // {
                        //     "extend": "pdf",
                        //     "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        //     "className": "btn btn-white btn-primary btn-bold"
                        // },
                        {
                            "extend": "excel",
                            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "csv",
                            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "text": "<i class='fa fa-file-text-o bigger-110 green'></i> <span class='hidden'>Export to JSON</span>",
                            "className": "btn btn-white btn-primary btn-bold",
                            action: function(e, dt, button, config) {
                                var data = dt.buttons.exportData();

                                $.fn.dataTable.fileSave(
                                    new Blob([JSON.stringify(data)]),
                                    'Export.json'
                                );
                            }
                        },
                        // "selectRows",
                        "selectColumns",
                        "selectCells",
                        "selectNone"
                    ]
                });

                $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

                new $.fn.dataTable.Buttons(table, {
                    buttons: [{
                            "extend": "colvis",
                            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                            "className": "btn-outline-primary",
                            columns: ':not(:first):not(:last)'
                        },
                        {
                            "extend": "copy",
                            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                            "className": "btn btn-primary btn-outline-*"
                        },
                        {
                            "extend": "excel",
                            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "pdf",
                            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
                        {
                            "extend": "print",
                            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                            "className": "btn btn-white btn-primary btn-bold",
                            autoPrint: false,
                            message: 'This print was produced using the Print button for DataTables'
                        },
                        {
                            "extend": "csv",
                            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        }

                    ]
                });

                // table.buttons().container().insertBefore('#dynamic-table_filter');

                table.buttons().container().appendTo($('.tableTools-container'));


                // setTimeout(function() {
                //     $($('.tableTools-container')).find('a.dt-button').each(function() {
                //         var div = $(this).find(' > div').first();
                //         if (div.length == 1) div.tooltip({
                //             container: 'body',
                //             title: div.parent().text()
                //         });
                //         else $(this).tooltip({
                //             container: 'body',
                //             title: $(this).text()
                //         });
                //     });
                // }, 500);

                // table.on('select', function(e, dt, type, index) {
                //     if (type === 'row') {
                //         $(table.row(index).node()).find('input:checkbox').prop('checked', true);
                //     }
                // });

                // table.on('deselect', function(e, dt, type, index) {
                //     if (type === 'row') {
                //         $(table.row(index).node()).find('input:checkbox').prop('checked', false);
                //     }
                // });

                // $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

                // $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function() {
                //     var th_checked = this.checked;
                //     $(this).closest('table').find('tbody > tr').each(function() {
                //         var row = this;
                //         if (th_checked) {
                //             table.row(row).select();
                //         } else {
                //             table.row(row).deselect();
                //         }
                //     });
                // });                

                // $('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
                //     var row = $(this).closest('tr').get(0);
                //     if (this.checked) table.row(row).deselect();
                //     else table.row(row).select();
                // });
                // $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                //     e.stopImmediatePropagation();
                //     e.stopPropagation();
                //     e.preventDefault();
                // });        

                //tooltips
                $(function() {
                    $('[data-tooltips="tooltip"]').tooltip()
                })

                //Button Action Level Start
                $('#dynamic-table').on('click', '.btn-view-level', function(e) {
                    const modallevelname = $(this).data('level');

                    $('#viewlevel').val(modallevelname);
                    $('#viewlevel').attr('readonly', true);
                    $('.modal-title').text('View level ' + modallevelname);
                    $('#modal-view-level').modal('show');
                });
                $('#dynamic-table').on('click', '.btn-edit-level', function(e) {
                    const modalidlevel = $(this).data('id');
                    const modallevelname = $(this).data('level');

                    $('#editidlevel').val(modalidlevel);
                    $('#editlevel').val(modallevelname);

                    $('.modal-title').text('Edit level ' + modallevelname);
                    $('#modal-edit-level').modal('show');
                });
                $('#dynamic-table').on('click', '.btn-delete-level', function(e) {
                    const modalidlevel = $(this).data('id');
                    const modallevelname = $(this).data('level');


                    $('#modaldelidlevel').val(modalidlevel);
                    $('#modaldellevel').val(modallevelname);

                    $('.modal-title').text('Delete level ' + modallevelname);
                    $('#modal-delete-level').modal('show');

                });
                $('#btnUpdateLevel').on('click', function() {
                    const modaleditid = $('#editidlevel').val();
                    const modallevelname = $('#editlevel').val();

                    url = "<?= base_url(); ?>/level/updateLevel/" + modaleditid;
                    $('#editlevelmodalForm').attr('action', url);
                    $('#editlevelmodalForm').attr('method', 'POST');
                });
                $('#btnDeleteLevelYes').on('click', function() {
                    const modaldelidlevel = $('#modaldelidlevel').val();
                    const modaldellevelname = $('#modaldellevel').val();

                    url = "<?= base_url(); ?>/level/deleteLevel/" + modaldelidlevel;
                    $('#deletelevelmodalForm').attr('action', url);
                    $('#deletelevelmodalForm').attr('method', 'POST');
                });

                //Button Action Store Start
                $('#dynamic-table').on('click', '.btn-view-store', function(e) {
                    const modaleditidstore = $(this).data('idstore');
                    const modalstorecode = $(this).data('storecode');
                    const modalstorename = $(this).data('storename');
                    const modalkwhmeter1 = $(this).data('kwhmeter1');
                    const modalidpln1 = $(this).data('idpln1');
                    const modalkwhmeter2 = $(this).data('kwhmeter2');
                    const modalidpln2 = $(this).data('idpln2');

                    var detail_storename = '';
                    var kwhmeter1 = '';
                    var pln1 = '';
                    var kwhmeter2 = '';
                    var pln2 = '';
                    var email = '';


                    detail_storename += '<strong>' + modalstorename + ' - ' + modalstorecode + '</strong>';
                    kwhmeter1 += 'KWH 1 : ' + modalkwhmeter1 + ' KVA';
                    pln1 += 'Id PLN 1 : ' + modalidpln1;
                    kwhmeter2 += 'KWH 2 : ' + modalkwhmeter2 + ' KVA';
                    pln2 += 'Id PLN 2 : ' + modalidpln2;

                    $('.detail_storename').html(detail_storename);

                    $('#viewstorename').val(modalstorename);
                    $('#viewstorename').attr('readonly', true);
                    $('#viewidpln1').val(modalidpln1);
                    $('#viewidpln1').attr('readonly', true);
                    $('#viewkwhmeter1').val(modalkwhmeter1);
                    $('#viewkwhmeter1').attr('readonly', true);

                    $('#viewidpln2').val(modalidpln2);
                    $('#viewidpln2').attr('readonly', true);
                    $('#viewkwhmeter2').val(modalkwhmeter2);
                    $('#viewkwhmeter2').attr('readonly', true);


                    $('.modal-title').text('View Store ');
                    $('#modal-view-store').modal('show');
                });
                $('#dynamic-table').on('click', '.btn-edit-store', function(e) {
                    saveMethod = 'update';
                    const modaleditidstore = $(this).data('idstore');
                    const modalstorecode = $(this).data('storecode');
                    const modalstorename = $(this).data('storename');
                    const modalkwhmeter1 = $(this).data('kwhmeter1');
                    const modalidpln1 = $(this).data('idpln1');
                    const modalkwhmeter2 = ($(this).data('kwhmeter2') == 1 ? 0 : $(this).data('kwhmeter2'));
                    const modalidpln2 = ($(this).data('idpln2') ? $(this).data('idpln2') : '');

                    // alert(modalkwhmeter2);


                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    if (modalkwhmeter2 != 0) {
                        $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    }

                    $('#editidpln2').val(modalidpln2);

                    $('.modal-title').text('Edit store ');
                    $('#modal-edit-store').modal('show');
                });
                $('#btnUpdate').on('click', function() {
                    var url;
                    const modalidstore = $('#editidstore').val();
                    const modalstorecode = $('#editstorecode').val();
                    const modalstorename = $('#editstorename').val();
                    const modalkwhmeter1 = $('#editkwhmeter1').val();
                    const modalidpln1 = $('#editidpln1').val();
                    const modalkwhmeter2 = ($('#editkwhmeter2').val() == '' ? 1 : $('#editkwhmeter2').val());
                    const modalidpln2 = $('#editidpln2').val();

                    url = "<?= base_url(); ?>/store/updateStore/" + modalidstore;
                    $('#editstoremodalForm').attr('action', url);
                    $('#editstoremodalForm').attr('method', 'POST');

                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    if (modalkwhmeter2 != 0) {
                        $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    }
                    $('#editidpln2').val(modalidpln2);

                });
                $('#dynamic-table').on('click', '.btn-delete-store', function(e) {
                    saveMethod = 'delete';
                    const modaldeleteidstore = $(this).data('idstore');
                    const modaldeletestorecode = $(this).data('storecode');
                    const modaldeletestorename = $(this).data('storename');
                    const modaldeletekwhmeter1 = $(this).data('kwhmeter1');
                    const modaldeleteidpln1 = $(this).data('idpln1');
                    const modaldeletekwhmeter2 = $(this).data('kwhmeter2');
                    const modaldeleteidpln2 = $(this).data('idpln2');

                    // Set data to Form Edit
                    $('#modaldeleteidstore').val(modaldeleteidstore);
                    $('#modaldeletestorecode').val(modaldeletestorecode);
                    $('#modaldeletestorecode').attr('readonly', true);
                    $('#modaldeletestorename').val(modaldeletestorename);
                    $('#modaldeletekwhmeter1').val(modaldeletekwhmeter1).trigger('change');
                    $('#modaldeleteidpln1').val(modaldeleteidpln1);
                    $('#modaldeletekwhmeter2').val(modaldeletekwhmeter2).trigger('change');
                    $('#modaldeleteidpln2').val(modaldeleteidpln2);

                    $('.modal-title').text('Delete store ' + modaldeletestorename);
                    $('#modal-delete-store').modal('show');
                });
                $('#btnDeleteStore').on('click', function() {
                    var url;
                    const modaldeleteidstore = $('#modaldeleteidstore').val();
                    const modaldeletestorecode = $('#modaldeletestorecode').val();
                    const modaldeletestorename = $('#modaldeletestorename').val();
                    const modaldeletekwhmeter1 = $('#modaldeletekwhmeter1').val();
                    const modaldeleteidpln1 = $('#modaldeleteidpln1').val();
                    const modaldeletekwhmeter2 = ($('#modaldeletekwhmeter2').val() == '' ? 1 : $('#modaldeletekwhmeter2').val());
                    const modaldeleteidpln2 = $('#modaldeleteidpln2').val();

                    url = "<?= base_url(); ?>/store/deleteStore/" + modaldeleteidstore;
                    $('#deletestoreForm').attr('action', url);
                    $('#deletestoreForm').attr('method', 'POST');

                })

                //Button Action Employee Start
                $('#dynamic-table').on('click', '.btn-view-employee', function(e) {
                    const modalviewid = $(this).data('id');
                    const modalviewnik = $(this).data('nik');
                    const modalviewname = $(this).data('name');
                    const modalviewinitial = $(this).data('initial');
                    const modalviewemail = $(this).data('email');
                    const modalviewusername = $(this).data('username');
                    const modalviewrolesuperior = $(this).data('rolesuperior');
                    const modalviewsuperiorname = $(this).data('superiorname');
                    const modalviewroleuser = $(this).data('roleuser');
                    const modalviewlevel = $(this).data('level');
                    const modalviewlocation = $(this).data('location');
                    const modalviewimageuser = $(this).data('imguser');
                    var detail_nikname = '';
                    var job_post = '';
                    var location = '';
                    var superior = '';
                    var image = '';
                    var email = '';

                    detail_nikname += '<strong>' + modalviewnik + ' - ' + modalviewname + '</strong>';
                    job_post += 'Position : ' + modalviewroleuser;
                    location += 'Location : ' + modalviewlocation;
                    superior += 'Superior Name : ' + modalviewsuperiorname + ' <br/> Superior Role : ' + modalviewrolesuperior;
                    image += modalviewimageuser;
                    email += modalviewemail

                    $('.detail_nikname').html(detail_nikname);
                    $('.job_post').html(job_post);
                    $('.location').html(location);
                    $('.superiorrole').html(superior);
                    $('#imguser').attr('src', '<?= base_url('static/avatars/'); ?>' + '/' + image);
                    $('.mailuser').attr('href', 'mailto:' + email)

                    $('.modal-title').text('View data ');
                    $('#modal-view-employee').modal('show');

                });
                $('#dynamic-table').on('click', '.btn-edit-employee', function(e) {
                    const modaleditid = $(this).data('id');
                    const modaleditnik = $(this).data('nik');
                    const modaleditname = $(this).data('name');
                    const modaleditemail = $(this).data('email');
                    const modaleditusername = $(this).data('username');
                    const modaleditinitial = $(this).data('initial');
                    const modaleditroleuser = $(this).data('roleuser');
                    const modaleditrolesuperior = $(this).data('rolesuperior');
                    const modaleditsuperiorname = $(this).data('superiorname');
                    const modaleditlevel = $(this).data('level');
                    const modaleditlocation = $(this).data('location');

                    // Set data to Form Edit
                    $('#editid').val(modaleditid);
                    $('#editnik').val(modaleditnik);
                    $('#editname').val(modaleditname);
                    $('#editinitial').val(modaleditinitial);
                    $('#editemail').val(modaleditemail);
                    $('#editusername').val(modaleditusername);
                    $('#editsuperiorrole').val(modaleditrolesuperior).trigger('change');
                    $('#editsuperiorname').val(modaleditsuperiorname).trigger('change');
                    $('#editemployeerole').val(modaleditroleuser).trigger('change');
                    $('#editlevel').val(modaleditlevel).trigger('change');
                    $('#editlocation').val(modaleditlocation).trigger('change');


                    $('.modal-title').text('Edit data nik employee ' + modaleditnik);
                    $('#modal-edit-employee').modal('show');
                });
                $('#dynamic-table').on('click', '.btn-delete-employee', function(e) {
                    const modaldelid = $(this).data('id');
                    const modaldelnik = $(this).data('nik');
                    const modaldelname = $(this).data('name');

                    $('#modaldelid').val(modaldelid);
                    $('#modaldelnik').val(modaldelnik);
                    $('#modaldelname').val(modaldelname);

                    // $('.modal-title').text('View data nik employee ');
                    $('#modalConfirmDelete').modal('show');
                });
                $('#btnUpdateEmployee').on('click', function() {
                    var url;
                    //get Edit Employee
                    const modaleditid = $('#editid').val();
                    const modaleditnik = $('#editnik').val();
                    const modaleditname = $('#editname').val();
                    const modaleditemail = $('#editname').val();
                    const modaleditusername = $('#editusername').val();
                    const modaleditinitial = $('#editinitial').val();
                    const modaleditroleuser = $('#editemployeerole').val();
                    const modaleditrolesuperior = $('#editsuperiorrole').val();
                    const modaleditsuperiorname = $('#editsuperiorname').val();
                    const modaleditlevel = $('#editlevel').val();
                    const modaleditlocation = $('#editlocation').val();

                    url = "<?= base_url(); ?>/employee/updateEmployee/" + modaleditid;
                    $('#editemployeemodalForm').attr('action', url);
                    $('#editemployeemodalForm').attr('method', 'POST');
                });
                $('#btnDeleteYes').on('click', function() {
                    const modaldelid = $('#modaldelid').val();;
                    const modaldelnik = $('#modaldelnik').val();
                    const modaldelname = $('#modaldelname').val();


                    url = "<?= base_url(); ?>/employee/deleteEmployee/" + modaldelid;
                    $('#deleteemployeemodalForm').attr('action', url);
                    $('#deleteemployeemodalForm').attr('method', 'POST');
                });
                //Button Action Employee End

                $('.superiorrole').change(function() {
                    var id = $(this).val();
                    alert(id);
                    $.ajax({
                        // url: "< ?= base_url('employee/getDataSuperiorName2'); ?>",
                        url: "<?= base_url('employee/getDataSuperiorNameFilter'); ?>",
                        method: "POST",
                        data: {
                            id: id
                        },
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            var html = '';
                            var i;
                            if (data.length > 0) {
                                for (i = 0; i < data.length; i++) {
                                    // html += '<option value="' + data[i].idSuperior + '">' + data[i].SuperiorName + '</option>';
                                    html += '<option value="' + data[i].idSuperior + '">' + data[i].SuperiorName + '</option>';
                                }
                            } else {
                                html += '<option value="0">None</option>';
                            }
                            $('.superiorname').html(html);
                        }
                    });
                });
            });
        <?php } ?>

        <?php if ($url == 'worker') { ?>
            <?php if (session()->getFlashdata('loginsuccessmsg')) : ?>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    // title: 'Signed in successfully'
                    title: '<?php echo session()->getFlashdata('loginsuccessmsg'); ?>'
                })
            <?php endif; ?>
        <?php } ?>
    </script>





    </body>

    </html>