$(document).ready(function () 
{
    $("#buy").click(function()
    {
        window.open("Invoice.php", '_blank');
        window.open("Finalize.php").delay(1000);
    }); 
});