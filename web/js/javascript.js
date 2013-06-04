$(document).ready(function() {

    $(".lightbox").attr('rel', 'gallery').fancybox();
    createSommaire();
    
    $('table').addClass('table table-striped');
});

function createSommaire() {

    var arraySommaire = new Array();
    var j = 0;
    var listeLi = "";

    $(".content h1, h2, h3").each(function(i) {
        var current = $(this);

        if ($.inArray($(this).html(), arraySommaire) >= 0) {

        }
        else {

            arraySommaire[j] = $(this).html();

            current.attr("id", "title" + i);

            listeLi += "<li><a id='link" + i + "' href='#title" +
                    i + "' title='" + current.attr("tagName") + "'>" + "<i class='icon-chevron-right'></i>" +
                    current.html() + "</a></li>"

            j++;
        }
    });
    
    $("#sommaire").prepend(listeLi);
    
    
}
