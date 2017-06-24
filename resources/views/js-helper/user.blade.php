<script type="text/javascript">

(function($) {
    $('.change-role').each(function() {
        var changeRoleTo = $(this).find('.change-role-to').data('role');
        var currentRole = $(this).find('.current-role').data('role');
        var toggleClass = $(this).find('.role-change-class').data('class');
        $(this).hover(function() {
            $(this).find('.change-role-action a').toggleClass(toggleClass).html(changeRoleTo);
        }, function() {
            $(this).find('.change-role-action a').toggleClass(toggleClass).addClass('btn-default').html(currentRole);
        })
    })
})(jQuery);

</script>