$(document).ready(function () {
    $("<input type='button' value='Effacer' onclick='document.getElementById(\"androiddev_adminbundle_articletype_vignette\").value=\"\"'/>").insertAfter("#androiddev_adminbundle_articletype_vignette");
    $("<input type='button' value='Effacer' onclick='document.getElementById(\"androiddev_adminbundle_categorietype_vignette\").value=\"\"'/>").insertAfter("#androiddev_adminbundle_categorietype_vignette");
    $("<input type='button' value='Effacer' onclick='document.getElementById(\"androiddev_adminbundle_projettype_vignette\").value=\"\"'/>").insertAfter("#androiddev_adminbundle_projettype_vignette");

    $(".champs-vignette").click(function () {
        openKCFinder(this);
    });

    $('.dataTable').dataTable({
        "iDisplayLength": 100,
        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
        "bStateSave": true,
        "aLengthMenu": [[50, 100, 250, -1], [50, 100, 250, "Tous"]],
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page"
        }
    });

    $("#listeMotCle input").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "../motcle",
                dataType: "json",
                type:"POST",
                data: {
                    q: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function (event, ui) {
            this.value = ui.item.label;
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });

});

$.extend(true, $.fn.dataTable.defaults, {
    "sDom": "<'row'<'col-6'f><'col-6'l>r>t<'row'<'col-6'i><'col-6'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
        "sLengthMenu": "Show _MENU_ Rows",
        "sSearch": ""
    }
});


/* Default class modification */
$.extend($.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
});


/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
{
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": oSettings._iDisplayLength === -1 ?
                0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};


/* Bootstrap style pagination control */
$.extend($.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function (oSettings, nPaging, fnDraw) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function (e) {
                e.preventDefault();
                if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                    fnDraw(oSettings);
                }
            };

            $(nPaging).append(
                    '<ul class="pagination">' +
                    '<li class="prev disabled"><a href="#"><i class="icon-double-angle-left"></i> ' + oLang.sPrevious + '</a></li>' +
                    '<li class="next disabled"><a href="#">' + oLang.sNext + ' <i class="icon-double-angle-right"></i></a></li>' +
                    '</ul>'
                    );
            var els = $('a', nPaging);
            $(els[0]).bind('click.DT', {
                action: "previous"
            }, fnClickHandler);
            $(els[1]).bind('click.DT', {
                action: "next"
            }, fnClickHandler);
        },
        "fnUpdate": function (oSettings, fnDraw) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, ien, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

            if (oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            } else if (oPaging.iPage <= iHalf) {
                iStart = 1;
                iEnd = iListLength;
            } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }

            for (i = 0, ien = an.length; i < ien; i++) {
                // Remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                // Add the new list items and their event handlers
                for (j = iStart; j <= iEnd; j++) {
                    sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                    $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                            .insertBefore($('li:last', an[i])[0])
                            .bind('click', function (e) {
                                e.preventDefault();
                                oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                                fnDraw(oSettings);
                            });
                }

                // Add / remove disabled classes from the static elements
                if (oPaging.iPage === 0) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }

                if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
});


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ($.fn.DataTable.TableTools) {
    // Set the classes that TableTools uses to something suitable for Bootstrap
    $.extend(true, $.fn.DataTable.TableTools.classes, {
        "container": "DTTT btn-group",
        "buttons": {
            "normal": "btn",
            "disabled": "disabled"
        },
        "collection": {
            "container": "DTTT_dropdown dropdown-menu",
            "buttons": {
                "normal": "",
                "disabled": "disabled"
            }
        },
        "print": {
            "info": "DTTT_print_info modal"
        },
        "select": {
            "row": "active"
        }
    });

    // Have the collection use a bootstrap compatible dropdown
    $.extend(true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
        "collection": {
            "container": "ul",
            "button": "li",
            "liner": "a"
        }
    });
}

function addPartProject() {
    var $listePartProject = $("#listePartProject");

    $listePartProject.append('<li>'
            + '<input type="hidden" name="partProject[id][]" value="' + $("#partProject").val() + '" />'
            + '<label>' + $("#partProject option:selected").text() + '</label>'
            + '<input class="indexPartProject" type="text" name="partProject[index][]" value="' + $("#indexPartProject").val() + '" />'
            + '<label onclick="delPartProject(this);">x</label></li>');
}

function delPartProject(lignePartProject) {
    lignePartProject.parentNode.parentNode.removeChild(lignePartProject.parentNode);
}

function addMotCle() {
    var $listeMotCle = $("#listeMotCle");

    $listeMotCle.append('<li><input class="indexPartProject" type="text" name="motCle[]" />'
            + '<button onclick="delMotCle(this);">x</button></li>');
    
    $("#listeMotCle input").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "../motcle",
                dataType: "json",
                type:"POST",
                data: {
                    q: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function (event, ui) {
            this.value = ui.item.label;
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
}

function delMotCle(ligneMotCle) {
    ligneMotCle.parentNode.parentNode.removeChild(ligneMotCle.parentNode);
}

function openKCFinder(field) {
    window.KCFinder = {
        callBack: function (url) {
            field.value = url;
            window.KCFinder = null;
        }
    };
    window.open('/kcfinder/browse.php?type=images', 'kcfinder_textbox',
            'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
            'resizable=1, scrollbars=0, width=800, height=600'
            );
}