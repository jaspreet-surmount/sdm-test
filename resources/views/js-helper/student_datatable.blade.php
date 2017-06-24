<script type="text/javascript">

(function($) {
    $('#students-active-data').dataTable( {
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "bProcessing": true,
        "bServerSide": true,
        "aoColumns": [
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
        ],
        "sAjaxSource": "{{ URL::route('student.data') }}"
    });

    $('#students-inactive-data').dataTable( {
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        },
        "bProcessing": true,
        "bServerSide": true,
        "aoColumns": [
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": true  },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
        ],
        "sAjaxSource": "{{ URL::route('student.inactive-data') }}"
    });
})(jQuery);

</script>