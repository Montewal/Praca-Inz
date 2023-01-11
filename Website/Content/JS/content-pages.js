$(document).ready(function () 
{
    $('.page-toggle').children().hide();
    $('.page-toggle div:nth-child(1)').show();
    function Display(id) 
    {
        $('.page-toggle').children().hide();
        $("."+id).show();
    };
    $(".toggle").on("click", function()
    {   
        var page = $(this).attr("name");  
        Display(page);   
    });
});