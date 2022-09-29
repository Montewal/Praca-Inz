<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" /> 
    <title>Login It Service</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="Website/Content/CSS/menu.css" />
    <script>
        $(document).ready(function()
        {
            $("li").mouseenter(function()
            {
                $(this).children('ul').css("display", "block");
            });
            $("li").mouseleave(function()
            {
                $(this).children('ul').css("display", "none");
            });
        });
    </script>
</head>
<body>   
<div class="section">
        <div class="section menu">
            <div class="menu-container">
                <div class="menu-wrap">
                    <header>
                        <nav>
                            <ul>
                                <table>
                                    <tr>
                                        <td> <li><a href="#">Home</li> </td>
                                        <td> <li><a href="">Serwis</a>
                                            <ul>
                                                <li ><a href="#">Komputery</li>
                                                <li ><a href="#">Laptopy</li>
                                                <li ><a href="#">Czyszczenie</li>
                                            </ul>
                                        </li> </td>
                                        <td> <li><a href="">Usługi</a>
                                            <ul>
                                                <li ><a href="#">System Windows</li>
                                                <li ><a href="#">Bezpieczeństwo</li>
                                                <li ><a href="#">Odzyskiwanie danych</li>
                                                <li ><a href="#">Optymalizacja</li>
                                            </ul>
                                        </li> </td>
                                        <td><li> <a href="#">Cennik</li> </td>
                                        <td><li> <a href="#">Zamów Serwis</li> </td>
                                        <td><li> <a href="#">Kontakt</li> </td>
                                        <td><li> <a href="#">Sklep</li> </td>
                                    </tr>
                                </table>
                            </ul>     
                        </nav>
                    </header>
                </div>
            </div>
        </div>
        <div class="section content">
              
        </div>
    </div> 
</body>
</html>