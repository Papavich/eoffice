/*globals $:false */
$(document).ready(function() {
    "use strict";
    $('#pro_year').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ ข้อมูล / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#governance_all').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ ข้อมูล / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#strategic_issues_all').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ ข้อมูล / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#strategic_all').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ ข้อมูล / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#table_wait_in_system').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
        order: [ 2, 'desc' ]
    });
    $('#table_permisoffer_staff_in_system').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#table_permisoffer_manager_in_system').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#table_permisoffer_planner_in_system').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });
    $('#table_compact_place').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
        order: [ 2, 'desc' ]
    });
    $('#table_compact_budget').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
        order: [ 2, 'desc' ]
    });
    $('#table_compact_pandb').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
        order: [ 2, 'desc' ]
    });
    $('#table_report').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
        order: [ 2, 'desc' ]
    });
    $('#table_compact_summary').DataTable({
        "language": {
            "search": "ค้นหา :",
            "lengthMenu": "แสดง _MENU_ โครงการ / หน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            "infoEmpty": "ไม่พบข้อมูล",
            "infoFiltered": "(จาก _MAX_ โครงการ)",
            "paginate": {
                "first":      "หน้าแรก",
                "last":       "หน้าสุดท้าย",
                "next":       "หน้าถัดไป",
                "previous":   "ย้อนกลับ",
            }
        },
    });




    $('.delete').click(function(){
        if(!confirm('ต้องการลบข้อมูลหรือไม่')){
            return false;
        }
    });
});