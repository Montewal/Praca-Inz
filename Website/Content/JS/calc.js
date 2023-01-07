$(document).ready(function () 
{
    $("#calc1sub").click(function()
    {
        var width = $("#pxwidth").val();
        var height = $("#pxheight").val();
        var fps = $("#fps").val();
        var duration = $("#duration-1").val();
        var size = width * height * 3 * fps / (1024 * 1024) * duration / 1024
        alert("works");
        $(".calc1result").remove();
        $("#result1").append("<div class ='calc1result'>"+size.toFixed(2) +"/GB</div>");
    });
    $("#calc2sub").click(function()
    {
        var bitrate = $("#bitrate").val();
        var duration = $("#duration-2").val();
        var size = bitrate / 8 * duration /1024;
        alert("works");
        $(".calc2result").remove();
        $("#result2").append("<div class ='calc2result'>"+size.toFixed(2) +"/GB</div>");
    });
});