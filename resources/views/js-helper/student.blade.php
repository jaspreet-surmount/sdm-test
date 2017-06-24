<script type="text/javascript">

(function($) {
    $('#add-student-form').validate({
        rules: {
            full_name: {
                required: true
            },
            dob: {
                required: true
            },
            contact_number: {
                rangelength: [6, 15],
                number: true
            },
            gender: {
                required: true
            },
            program: {
                required: true
            }
        }
    });

    $("#dob").datepicker({
        showButtonPanel: false,
        dateFormat : "dd-mm-yy",
        changeMonth : true,
        changeYear : true,
        maxDate : -1
    });
})(jQuery);

</script>