<?php
session_start();
$res = $_SESSION['library'];


foreach ($res as $book) {
    ?>
    <div class="book">
        <div>
            <?php echo $book['title']; ?>
        </div>
        <div>
            <?php echo $book['author']; ?>
        </div>
        <div>
            <?php echo $book['year']; ?>
        </div>
        <div>
            <?php echo $book['genre']; ?>
        </div>
        <a class="delete" onclick="deletebook(<?php echo $book['index'] ?>)">X</a>
    </div>
    <?php
}
?>