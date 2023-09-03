<?php
session_start();
$_SESSION['library'] = [];
$_SESSION['ind'] = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="../assets/jquery.js"></script>
</head>

<body>
    <div class="addbook">
        <h1>Add a New Book</h1>
        <input type="text" name="" id="title" placeholder="Book Name">
        <input type="text" name="" id="author" placeholder="Author Name">
        <input type="number" name="" id="publishedin" placeholder="Year Of Published">
        <input type="text" name="" id="genre" placeholder="Genre">
        <div class="btns">
            <button onclick="addbook()">Add</button>
            <button class="cancle">Cancle</button>
        </div>
    </div>
    <div class="main">
        <h1>Library Management</h1>


        <div class="books_container">
            <div class="search">
                <input type="text" name="searbox" id="searbox">
                <button onclick="searchstr()">Search</button>
                <button class="add" id="addbook">Add Book</button>
            </div>
            <div class="books" id="books">
                <div class="book">
                    <div>pather pachali Lorem ipsum dolor sit amet.</div>
                    <div>author Lorem ipsum dolor sit amet, consectetur adipisicing.</div>
                    <div>year Lorem ipsum dolor sit amet consectetur adipisicing.</div>
                    <div>genra Lorem ipsum, dolor sit amet consectetur adipisicing.</div>
                    <div>delete Lorem ipsum dolor sit amet consectetur.</div>
                    <div class="delete">X</div>
                </div>

            </div>

        </div>
    </div>
    <script>
        updateBookList();
        function updateBookList() {
            var bookList = document.getElementById("books");
            bookList.innerHTML = "";

            <?php
            // Convert the PHP session data to a JavaScript array
            if (isset($_SESSION['library'])) {
                $sessionData = json_encode($_SESSION['library']);
                echo "var sessionData = $sessionData;";

                // Loop through the session data and display it
                echo "sessionData.forEach(function(book) {";
                echo "var li = document.createElement('li');";
                echo "li.textContent = 'Title: ' + book.title + ', Author: ' + book.author + ', Year: ' + book.year + ', Genre: ' + book.genre;";
                echo "bookList.appendChild(li);";
                echo "});";
            }
            ?>
        }

        document.getElementById('addbook').addEventListener('click', () => {
            let main = document.querySelector('.main');
            main.classList.add('hide');
            let popup = document.querySelector('.addbook');
            popup.classList.add('show');
        });
        document.querySelector('.cancle').addEventListener('click', () => {
            let main = document.querySelector('.main');
            main.classList.remove('hide');
            let popup = document.querySelector('.addbook');
            popup.classList.remove('show');
        });
        function loadbook() {
            $.ajax({
                type: 'GET',
                url: '../Controller/bookloader.php',
                data: "",
                success: function (e) {
                    $('#books').html(e);
                }
            });
        }
        function searchstr() {
            let searchbox = document.getElementById('searbox');
            let searchterm = searchbox.value;
            searchbox.value = "";
            const data = {
                searchterm: searchterm,
            };
            $.ajax({
                url: '../Controller/searchbook.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    $('#books').html(response);
                    // Optionally, you can call a function to reload the book list here
                    // Assuming you have a loadBook() function to refresh the book list
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        function addbook() {
            let main = document.querySelector('.main');
            main.classList.remove('hide');
            let popup = document.querySelector('.addbook');
            popup.classList.remove('show');

            var title = document.querySelector('#title').value;
            var author = document.querySelector('#author').value;
            var year = document.querySelector('#publishedin').value;
            var genre = document.querySelector('#genre').value; // corrected variable name

            const data = {
                title: title,
                author: author,
                year: year,
                genre: genre
            };
            $.ajax({
                url: '../Controller/addbook.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    console.log(response);
                    // Optionally, you can call a function to reload the book list here
                    // Assuming you have a loadBook() function to refresh the book list
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            loadbook();
        }

        function deletebook(id) {
            const data = {
                id: id
            };
            $.ajax({
                url: '../Controller/deletebook.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            loadbook();

        }

    </script>
    <script src="../Controller/script.js"></script>
</body>

</html>