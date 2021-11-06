<?php
function connectDb()
{
    return mysqli_connect('localhost', 'root', '', 'colegiodb');
}
function disconnectDb($conn)
{
    mysqli_close($conn);
}
