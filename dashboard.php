<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro de Ayuda - [Nombre del Servicio/Producto]</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1, h2, h3 {
            color: #333;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar button {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-right: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .navbar button:hover {
            background-color: #1976D2;
        }
        .section {
            background-color: #fff;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .rules {
            list-style-type: none;
            padding: 0;
        }
        .rules li {
            margin: 5px 0;
        }
        .contact {
            background-color: #e7f3fe;
            padding: 10px;
            border-left: 4px solid #2196F3;
        }
    </style>
</head>
<body>

    <h1>Foro de Ayuda - [Nombre del Servicio/Producto]</h1>

    <div class="navbar">
        <button onclick="document.getElementById('anuncios').scrollIntoView();">Anuncios Importantes</button>
        <button onclick="document.getElementById('faq').scrollIntoView();">Preguntas Frecuentes</button>
        <button onclick="document.getElementById('soporte').scrollIntoView();">Soporte Técnico</button>
        <button onclick="document.getElementById('sugerencias').scrollIntoView();">Sugerencias</button>
        <button onclick="document.getElementById('general').scrollIntoView();">General</button>
        <button onclick="document.getElementById('reglas').scrollIntoView();">Reglas</button>
        <button onclick="document.getElementById('contacto').scrollIntoView();">Contacto</button>
    </div>

    <div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación de dudas</title>
    <style>
        .boton {
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 20px; /* Espaciado interno */
            text-align: center; /* Centrar texto */
            text-decoration: none; /* Sin subrayado */
            display: inline-block; /* Mostrar como bloque en línea */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar cursor al pasar el mouse */
        }
    </style>
    <a href="http://localhost/ayuda%20leon/dudas_v1.php" class="boton">Publicación de dudas</a>
    </div>
    <div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación de temas</title>
    <style>
        .boton {
            background-color: #4CAF50; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 20px; /* Espaciado interno */
            text-align: center; /* Centrar texto */
            text-decoration: none; /* Sin subrayado */
            display: inline-block; /* Mostrar como bloque en línea */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambiar cursor al pasar el mouse */
        }
    </style>
    <a href="http://localhost/ayuda%20leon/temas.php" class="boton">Publicación de temas</a>
    </div>

    <div class="section" id="anuncios">
        <h2>Anuncios Importantes</h2>
        <p>Información sobre actualizaciones, mantenimiento y novedades.</p>
    </div>

    <div class="section" id="faq">
        <h2>Preguntas Frecuentes (FAQ)</h2>
        <p>Respuestas a las preguntas más comunes.</p>
    </div>

    <div class="section" id="soporte">
        <h2>Soporte Técnico</h2>
        <p>Publica aquí tus problemas técnicos y recibe ayuda.</p>
        <h3>Formato de Publicación:</h3>
        <ul>
            <li>Título del Problema:</li>
            <li>Descripción Detallada:</li>
            <li>Pasos que has Intentado:</li>
            <li>Capturas de Pantalla (si es necesario):</li>
        </ul>
    </div>

    <div class="section" id="sugerencias">
        <h2>Sugerencias y Mejora</h2>
        <p>Comparte tus ideas para mejorar [Nombre del Servicio/Producto].</p>
        <h3>Formato de Publicación:</h3>
        <ul>
            <li>Sugerencia:</li>
            <li>Razón de la Sugerencia:</li>
        </ul>
    </div>

    <div class="section" id="general">
        <h2>General</h2>
        <p>Discusiones sobre temas generales relacionados con [Nombre del Servicio/Producto].</p>
        <h3>Formato de Publicación:</h3>
        <ul>
            <li>Tema:</li>
            <li>Descripción:</li>
        </ul>
    </div>

<footer>
    <div class="contact">
        <h2>Contacto</h2>
        <p>Si necesitas asistencia inmediata, puedes contactar a nuestro equipo de soporte en <a href="mailto:soporte@ejemplo.com">soporte@ejemplo.com</a> o a través de [método de contacto alternativo].</p>
    </div>

    <div class="section">
        <h2>Cierre</h2>
        <p>Esperamos que encuentres útil este foro. Tu participación es valiosa para nuestra comunidad. ¡Gracias por ser
</footer>

