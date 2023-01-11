$(document).ready(function () 
{
    $('.pages').children().hide();
    if($('.current-page').attr("value") == "")
    {
        $('.page-0').show();
    }
    else 
    {
        var num = $('.current-page').attr("value");
        $('.page-'+num).show();
    }   
    function Display(id) 
    {
        $('.pages').children().hide();
        $(id).show();
    };
    $(".turn").on("click", function()
    {   
        var num = $(this).text();  
        Display(".page-"+num);   
    });
});