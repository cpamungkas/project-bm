    <!-- Libs JS -->
    <!-- <script src="./libs/apexcharts/dist/apexcharts.min.js" defer></script>
    <script src="./libs/jsvectormap/dist/js/jsvectormap.min.js" defer></script>
    <script src="./libs/jsvectormap/dist/maps/world.js" defer></script>
    <script src="./libs/jsvectormap/dist/maps/world-merc.js" defer></script> -->
    <script src="./libs/litepicker/dist/litepicker.js" defer=""></script>
    <!-- Tabler Core -->
    <script src="./js/tabler.min.js" defer></script>
    <!-- <script src="./js/demo.min.js" defer></script> -->

    <?php if ($url == 'store' or $url == 'employee' or $url == 'worker' or $url == 'admin' or $url == 'userguide' or $url == 'techshift' or $url == 'troubleshift' or $url == 'troublejobout' or $url == 'troublejobin' or $url == 'trafocubicle' or $url == 'kwhmeter' or $url == 'panellvmdp' or $url == 'panelcapacitorbank' or preg_match('/^genset[1-2]$/', $url) or $url == 'dieselhydrant' or $url == 'acchiller' or $url == 'accoolingtower' or $url == 'acahu' or $url == 'acsplitwallduckcassettevrv' or $url == 'temperature' or $url == 'lighting' or $url == 'escalator' or $url == 'elevator' or $url == 'dumbwaiter' or $url == 'sanitary') { ?>
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
        <?php if ($url == 'store' or $url == 'employee' or $url == 'techshift' or $url == 'troubleshift' or $url == 'troublejobout' or $url == 'troublejobin' or $url == 'trafocubicle' or $url == 'kwhmeter' or $url == 'panellvmdp' or $url == 'panelcapacitorbank' or preg_match('/^genset[1-2]$/', $url) or $url == 'dieselhydrant' or $url == 'acchiller' or $url == 'accoolingtower' or $url == 'acahu' or $url == 'acsplitwallduckcassettevrv' or $url == 'temperature' or $url == 'lighting' or $url == 'escalator' or $url == 'elevator' or $url == 'dumbwaiter' or $url == 'sanitary') { ?>
            $(document).ready(function() {
                var myTable = $('#dynamic-table')
                var table = $('#dynamic-table').DataTable({
                    lengthChange: true,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        ['5', '10', '25', '50', 'Show all']
                    ],
                    responsive: true,
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
                        {
                            "extend": "pdf",
                            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                            "className": "btn btn-white btn-primary btn-bold"
                        },
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

                $('#dynamic-table').on('click', 'button.btn-edit-employee', function(e) {
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

                $('#dynamic-table').on('click', 'button.btn-view-employee', function(e) {
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

                    // Set data to Form Edit
                    // $('#viewid').val(modalviewid);
                    // $('#viewnik').val(modalviewnik);
                    // $('#viewname').val(modalviewname);
                    // $('#viewinitial').val(modalviewinitial);
                    // $('#viewemail').val(modalviewemail);
                    // $('#viewusername').val(modalviewusername);
                    // $('#viewsuperiorrole').val(modalviewrolesuperior).trigger('change');
                    // $('#viewsuperiorname').val(modalviewsuperiorname).trigger('change');
                    // $('#viewemployeerole').val(modalviewroleuser).trigger('change');
                    // $('#viewlevel').val(modalviewlevel).trigger('change');
                    // $('#viewlocation').val(modalviewlocation).trigger('change');

                    detail_nikname += '<strong>' + modalviewname + ' - ' + modalviewnik + '</strong>';
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

                $('#dynamic-table').on('click', 'button.btn-delete-employee', function(e) {
                    const modaldelid = $(this).data('id');
                    const modaldelnik = $(this).data('nik');
                    const modaldelname = $(this).data('name');

                    $('#modaldelid').val(modaldelid);
                    $('#modaldelnik').val(modaldelnik);
                    $('#modaldelname').val(modaldelname);

                    // $('.modal-title').text('View data nik employee ');
                    $('#modalConfirmDelete').modal('show');
                });

                //get Edit Product
                $('.btn-edit').on('click', function() {
                    saveMethod = 'update';
                    const modaleditidstore = $(this).data('idstore');
                    const modalstorecode = $(this).data('storecode');
                    const modalstorename = $(this).data('storename');
                    const modalkwhmeter1 = $(this).data('kwhmeter1');
                    const modalidpln1 = $(this).data('idpln1');
                    const modalkwhmeter2 = $(this).data('kwhmeter2');
                    const modalidpln2 = $(this).data('idpln2');


                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    $('#editidpln2').val(modalidpln2);

                    $('.modal-title').text('Edit data store ' + modalstorename);
                    $('#modal-edit-store').modal('show');
                });
                //get Delete Product
                $('#btnUpdate').on('click', function() {
                    var url;
                    const modalidstore = $('#editidstore').val();
                    const modalstorecode = $('#editstorecode').val();
                    const modalstorename = $('#editstorename').val();
                    const modalkwhmeter1 = $('#editkwhmeter1').val();
                    const modalidpln1 = $('#editidpln1').val();
                    const modalkwhmeter2 = $('#editkwhmeter2').val();
                    const modalidpln2 = $('#editidpln2').val();

                    url = "<?= base_url(); ?>/store/updateStore/" + modalidstore;
                    $('#editstoremodalForm').attr('action', url);

                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    $('#editidpln2').val(modalidpln2);

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

                $('.superiorrole').change(function() {
                    var id = $(this).val();
                    $.ajax({
                        url: "< ?= base_url('employee/getDataSuperiorName2'); ?>",
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
                                    html += '<option value="' + data[i].idSuperior + '">' + data[i].SuperiorName + '</option>';
                                }
                            } else {
                                html += '<option value="0">None</option>';
                            }
                            $('.superiorname').html(html);
                        }
                    });
                });

                // const Toast = Swal.mixin({
                //     toast: true,
                //     position: 'top-end',
                //     showConfirmButton: false,
                //     timer: 3000,
                //     timerProgressBar: true,
                //     didOpen: (toast) => {
                //         toast.addEventListener('mouseenter', Swal.stopTimer)
                //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                //     }
                // })

                // Toast.fire({
                //     icon: 'success',
                //     title: 'Signed in successfully'
                // })
            });
        <?php } ?>

        <?php if ($url == 'worker') { ?>
            <?php if (session()->getFlashdata('loginsuccessmsg')) : ?>
                // $(document).ready(function() {
                //     let timerInterval
                //     Swal.fire({
                //         position: 'top-end',

                //         title: 'Success',
                //         html: '<?php echo session()->getFlashdata('loginsuccessmsg'); ?>',
                //         timer: 3000,
                //         timerProgressBar: true,

                //         didOpen: () => {
                //             Swal.showLoading()                            
                //             timerInterval = setInterval(() => {                                
                //             }, 100)
                //         },
                //         willClose: () => {
                //             clearInterval(timerInterval)
                //         }
                //     }).then((result) => {                        
                //         if (result.dismiss === Swal.DismissReason.timer) {
                //             console.log('I was closed by the timer')
                //         }
                //     });
                // });

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

        $(window).on("load", function() {
            var nodes = document.querySelectorAll(".dropdown-menu-column-eq");
            for(var i = 0; i < nodes.length; i++){
                nodes[i].innerHTML = jQuery.trim(nodes[i].innerHTML);
                if(!nodes[i].innerHTML) {
                    nodes[i].classList.add('blank');
                }
            }
        });
    </script>

    <?php if ($url == 'store' or $url = 'employee' or $url == 'techshift') { ?>
        <?php if ($url == 'techshift') { ?>
            <script>
                // @formatter:off
                document.addEventListener("DOMContentLoaded", function() {
                    window.Litepicker && (new Litepicker({
                        element: document.getElementById('datepicker-icon'),
                        buttonText: {
                            previousMonth: `
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>`,
                            nextMonth: `
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>`,
                        },
                        format: 'DD-MM-YYYY'
                    }));
                });
                // @formatter:on
            </script>
        <?php } ?>
        <?php if ($url == 'employee') { ?>
            <!-- <script type="text/javascript">
                $(document).ready(function() {
                    $('.superiorrole').change(function() {
                        var id = $(this).val();
                        $.ajax({
                            url: "< ?= base_url('employee/getDataSuperiorName2'); ?>",
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
            </script> -->
        <?php } ?>

        <!-- <script type="text/javascript">
            var saveMethod;
            $(document).ready(function() {
                //get Edit Product
                $('.btn-edit').on('click', function() {
                    saveMethod = 'update';
                    const modaleditidstore = $(this).data('idstore');
                    const modalstorecode = $(this).data('storecode');
                    const modalstorename = $(this).data('storename');
                    const modalkwhmeter1 = $(this).data('kwhmeter1');
                    const modalidpln1 = $(this).data('idpln1');
                    const modalkwhmeter2 = $(this).data('kwhmeter2');
                    const modalidpln2 = $(this).data('idpln2');


                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    $('#editidpln2').val(modalidpln2);

                    $('.modal-title').text('Edit data store ' + modalstorename);
                    $('#modal-edit-store').modal('show');
                });
                //get Delete Product
                $('#btnUpdate').on('click', function() {
                    var url;
                    const modalidstore = $('#editidstore').val();
                    const modalstorecode = $('#editstorecode').val();
                    const modalstorename = $('#editstorename').val();
                    const modalkwhmeter1 = $('#editkwhmeter1').val();
                    const modalidpln1 = $('#editidpln1').val();
                    const modalkwhmeter2 = $('#editkwhmeter2').val();
                    const modalidpln2 = $('#editidpln2').val();

                    url = "<?= base_url(); ?>/store/updateStore/" + modalidstore;
                    $('#editstoremodalForm').attr('action', url);

                    // Set data to Form Edit
                    $('#editidstore').val(modaleditidstore);
                    $('#editstorecode').val(modalstorecode);
                    $('#editstorecode').attr('readonly', true);
                    $('#editstorename').val(modalstorename);
                    $('#editkwhmeter1').val(modalkwhmeter1).trigger('change');
                    $('#editidpln1').val(modalidpln1);
                    $('#editkwhmeter2').val(modalkwhmeter2).trigger('change');
                    $('#editidpln2').val(modalidpln2);

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
            });
        </script> -->




    <?php } ?>


    </body>

    </html>