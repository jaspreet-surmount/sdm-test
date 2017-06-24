/**
 * @package public\assets\js
 * @description all common user-defined jquery functions using throughout the application
 * @author Jaspreet <jaspreet.singh@surmountsoft.com>
 * @copyright 2015 SurmountSoft Pvt. Ltd. All rights reserved.
 */
var current_page = 1;

$(document).ready(function() {
    /**
     * @var removedFieldSetCount
     * Used while adding/removing more form fields dynamically
     * to keep field index position unique
     *
     * @type {number}
     *
     * @author Jaspreet Singh <jaspreet.singh@surmountsoft.com>
     */

    var removedFieldSetCount = 0;

    $('body').on('click', 'a.formModal', function(event) { //due to ajax data request with datatable grids

        // width of model to be opened
        var width = $.trim($(this).data('width'));

        if (width != '' && (width.match("px$") || width.match("%$"))) {
            $('#dynamicEdit .modal-dialog').css('width', width);
        } else {
            $('#dynamicEdit .modal-dialog').css('width','');
        }

        //path of the route
        var route = $(this).data("route");
        // name of the form that we have to edit
        var name = $(this).data("name");

        if(!$(this).data("name")) {
            alert('Error: name attribute not defined. Please define name attribute.');
            return false;
        }

        if(!$(this).data("route")) {
            alert('Error: route attribute not defined. Please define route attribute.');
            return false;
        }

        $.ajax({
            type: "GET",
            url : route,
            async : true,
            beforeSend: function() {
                $('#dynamicEdit').modal('show');
                $("#dynamicEdit").find("#formTitle").html(name);
                setTimeout(function () {
                    //$('#loader').html() defined in layout before editing model
                    $("#dynamicEdit").find("#datatResult").html($('#loader').html());
                } , 10);
            },
            success:function(data, textStatus, jqXHR)
            {
                $("#dynamicEdit").find("#datatResult").html(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $('#dynamicEdit').fadeOut(100, 'linear');
                alert(errorThrown+'. Please contact your administrator.');
            }
        });
        return false;
        event.preventDefault(); //STOP default action
        event.unbind(); //unbind. to stop multiple form submit.
    }).ajaxComplete(function () {

        $('select').addClass('chosen');
        $('.chosen').chosen({
            disable_search_threshold: 15
        });

    }).on('click', '.addCollectionElement', function() {
        var parent = $(this).parents('.addMoreCollectionElementContainer');

        var currentCount = parent.find('.copy').length;

        var template = parent.find('.template').data('template');

        var indexPosition = currentCount + removedFieldSetCount;

        template = template.replace(/_index_/g, indexPosition);

        parent.find('.copy:last').after(template);

        parent.find('.copy:last').append('<div class="removeFieldSet"><a href="javascript:void(0);" class="colorRed"><span class="glyphicon glyphicon-minus-sign"></span></a></span>');

    }).on('click', '.removeFieldSet a', function() {
        var parent = $(this).parents('.addMoreFormContainer');

        removedFieldSetCount++;

        $(this).parent().parent().remove();

        if (parent.find('.copy').length > 1 && parent.find('.copy:last').find('.removeFieldSet').length == 0) {
            parent.find('.copy:last').append('<div class="removeFieldSet"><a href="javascript:void(0);" class="colorRed"><span class="glyphicon glyphicon-minus-sign"></span></a></span>');
        }
        if (parent.find('.copy').length == 0) {
            $(parent).addClass('hide');
        }

    }).on('click', '.__drop', function(event) {

        var alertMsg = 'Do you really want to delete this ?';
        if ($(this).data('msg')) {
            alertMsg = $(this).data('msg') + '\n' + alertMsg;
        }
        return(confirm(alertMsg));

    }).on('click', '.__confirm', function(event) {

        if ($(this).data('msg')) {
            var alertMsg = $(this).data('msg');
        } else {
            return false;
        }
        return(confirm(alertMsg));

    }).on('mouseover', 'form', function() {
        var form = $(this).find('input[type=submit]:not(:hidden)');
        form.removeAttr('disabled');

    }).on('submit', 'form', function() {
        /*var close = $(this).find('button[data-dismiss=modal]:not(".close")');
        var form = $(this).find('input[type=submit]:not(:hidden)');
        if ($.trim(close.html()) == 'Close') {
            close.removeClass('btn-default').attr('disabled','disabled').css('color','#111111');
        }
        $(this).find('button[data-dismiss=modal]').attr('disabled','disabled').attr('value', 'Processing..');
        form.attr('disabled','disabled');
        form.next().attr('disabled','disabled');*/

    }).on('keypress', 'input.keyAlphaNum',function (evt) {
        /**
         * keys behavior
         */
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        return (charCode > 47 && charCode < 58) // numbers(0-9) keys
        || (charCode > 64 && charCode < 91) // capital Alphabet keys
        || (charCode > 96 && charCode < 123) // small Alphabet keys
        || charCode == 8 || charCode == 32 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyAlpha',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        return (charCode > 64 && charCode < 91) // capital Alphabet keys
        || (charCode > 96 && charCode < 123) // small Alphabet keys
        || charCode == 8 || charCode == 32 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyAlphaWithComma',function (evt) {
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    return (charCode > 64 && charCode < 91) // capital Alphabet keys
                        || (charCode > 96 && charCode < 123) // small Alphabet keys
                        || charCode == 8 || charCode == 32 || charCode == 9 || charCode == 44 || charCode == 188
                        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyNumeric',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        // numbers(0-9) keys
        return (charCode > 47 && charCode < 58)
        || charCode == 8 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyFloat',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode == 46 && $(this).val().indexOf('.') != -1) {
            return false;
        }
        return (charCode > 47 && charCode < 58) // numbers(0-9) keys
        || charCode == 8 || charCode == 9 || charCode == 46
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyAlphaSingleWord',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        return  (charCode > 64 && charCode < 91) // capital Alphabet keys
        || (charCode > 96 && charCode < 123) // small Alphabet keys
        || charCode == 8 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyAlphaNumSingle',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        return (charCode > 47 && charCode < 58) // numbers(0-9) keys
        || (charCode > 64 && charCode < 91) // capital Alphabet keys
        || (charCode > 96 && charCode < 123) // small Alphabet keys
        || charCode == 8 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyNumSingle',function (evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        return (charCode > 47 && charCode < 58) // numbers(0-9) keys
        || charCode == 8 || charCode == 9
        || ((charCode == 37 || charCode == 39) && !evt.shiftKey && !evt.ctrlKey && !evt.altKey);

    }).on('keypress', 'input.keyNotAllowed',function (evt) {
        return false;
    }).on('mouseover', 'input', function() {
        $(this).attr('autocomplete', 'off');

    }).on('click', 'input[type=checkbox]', function() {

        /**
         * Select parent-child checkbox functionality
         * @Usage : Assign class to parent checkbox element and
         * assign @attr: rel (of val = className of parent checkbox) to its child checkbox elements
         */
        var ele = $('input[rel="'+$(this).attr("class")+'"]');

        /**
         * child checkboxes behaviour on parent checkbox
         */
        var c = 0;
        if ($(this).attr('rel')) {

            var ele1 = $('input[rel="'+$(this).attr("rel")+'"]');

            ele1.each(function() {
                if ($(this).prop('checked') === false) {
                    c++;
                }
            });

            if (c == 0) {
                $('.'+$(this).attr('rel')).prop('checked','checked');
            } else {
                $('.'+$(this).attr('rel')).removeAttr('checked');
            }
        }

        /**
         * Parent checkbox behaviour on child checkboxes
         */
        if ($(this).prop('checked') === true) {
            ele.prop('checked','checked');
        } else {
            ele.removeAttr('checked');
        }
        var count = 0;
        $('input[type=checkbox]').each(function() {
            if ($(this).prop('checked') === true) {
                count++;
            }
        });
    });

    /**
     * @package public\assets\js
     * @description all common user-defined jquery functions using throughout the application
     * @author Jaspreet <jaspreet.singh@surmountsoft.com>
     * @copyright Copyright (C) 2012 - 2014 SurmountSoft Pvt. Ltd. All rights reserved.
     */

    $.fn.stars = function() {
        return $(this).each(function() {
            $(this).html($('<span />').width(Math.max(0, (Math.min(5, parseFloat($(this).html())))) * 16));
        });
    };


    $('span.stars').stars();

    $('.delete-items').on('click', function(event){
        var option = confirm("Are you sure this operation!");

        if( option == true){
            var element_id = $(this).attr('id');
            var items_id = element_id.split("-").pop();
            var url = '/'+$(this).attr('url');
            var requestData = 'id=' + items_id;
            var el = $(this).closest('.item-list');
            $.ajax({
                type: "get",
                url : url,
                data : requestData,
                success : function(data){
                    event.preventDefault();
                    el.remove();
                    alert(data);
                }
            });
        }
    });

    $('#logo-picture').mouseover(function(){
        $("#change-logo-btn").removeClass('hide');
    });
});

function PrintElem(elem)
{
    Popup($(elem).html());
}

function Popup(data)
{
    var mywindow = window.open('', 'Print', 'height=700,width=1024');
    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('<style>');
    mywindow.document.write('@media print { #print_option{ display: none !important;} }');
    mywindow.document.write('table { width : 100%;}');
    
    mywindow.document.write('#print_option { visibility: hidden;}');
    mywindow.document.write('</style>');
    mywindow.document.write('</head><body >');

    mywindow.document.write(data);

    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}

$(function(){
$('.change_rfq_status').on('click', function(event){
     event.preventDefault();
     var url = $(this).attr('href');
     var element_id = $(this).attr('id');
     var operation = $(this).attr('operation');
     var rfq_id = element_id.split("-").pop();
     var requestData = 'id=' + rfq_id + '&operation=' + operation;
     var option = confirm("Are you sure this operation!");
        if (option == true)
        {

            $.ajax({
                type: "get",
                url : url,
                data : requestData,
                success : function(data){
                 //alert(data); return false;
                 location.reload();
                }
            });
        }

    });
    $('.tree-toggle').click(function () {
        $(this).parent().children('ul.tree').slideToggle(200);
    });
    $('.sidebar-toggle-box').click(function(){
        $("#wrapper").toggleClass("toggled");
    });
});

function confirmBox(handler) {
    handler = $(handler);
    var form = handler.parent('form');
    var href = handler.data('route');

    var message = handler.data('message') || 'Do you really want to perform this operation?';
    bootbox.dialog({
        message: message,
        closeButton: false,
        buttons: {
            "No": {
                className: 'btn-danger'
            },
            success: {
                label: 'Yes',
                className: 'btn-success',
                callback: function() {
                    if (form.length == 1) {
                        form.submit();
                    } else {
                        window.location = href;
                    }
                }
            }
        }
    });
    return false;
}
