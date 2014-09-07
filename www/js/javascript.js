$(document).ready(function() {

    $(".lightbox").attr('rel', 'gallery').fancybox();
    createSommaire();
    
    $(".lightbox > img").addClass("img-responsive");

    $('table').addClass('table table-striped');
    
    $('iframe[src^="//www.youtube.com/embed/"]').each(function( index ) {
        $(this).wrapAll(document.createElement("div"));
        $(this).parent().addClass("embed-responsive embed-responsive-16by9");
    });
    
    // initialize Isotope
    var iso = new Isotope( container, {
      transitionDuration: 0
    });
    // layout Isotope again after all images have loaded
    imagesLoaded( container, function() {
      iso.layout();
    });
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

            listeLi += "<li class='list-right'><i class='glyphicon glyphicon-chevron-right'></i>  &nbsp;<a id='link" + i + "' href='#title" +
                    i + "' title='" + current.attr("tagName") + "'>" + ""+
                    current.html() + "</a></li>"

            j++;
        }
    });
    $("#sommaire").prepend(listeLi);


}
