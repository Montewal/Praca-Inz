$(document).ready(function () 
{
    $('.pages').children().hide();
    $('.page-0').show();
    function Display(name) 
    {
        $('.pages').children().hide();
        $(name).show();
    };
    $(".turn").on("click", function()
    {   
        var num = $(this).text();  
        Display(".page-"+num);
            
            //$("#page-"+num).css();   
    });
});