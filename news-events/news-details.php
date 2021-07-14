<?php include "../layouts/header.php"; ?>

            news &amp; events
        </article>

        <h1>news &amp; events</h1>
        <?php

        $SQLNEWS = "SELECT * FROM acms_articles_list WHERE alist_postdate = '$_GET[dt]'";
        $RESNEWS = $_CON->query($SQLNEWS);

        $cnt = 1;
        while($ROWNEWS = $RESNEWS->fetch(PDO::FETCH_ASSOC)){

        echo '
            <section class="news-list news-list-details" style="">
                <h2>' . $ROWNEWS['alist_title'] . '</h2>
                <p>'.  $ROWNEWS['alist_details'] . '</p>
                <article>
                    <span>' . date("D, F d, Y", $ROWNEWS['alist_postdate']) . '</span>
                </article>
            </section>';
        }
        ?>

<?php include "../layouts/footer.php";?>

