<?php
$SQLNEWS = "SELECT * FROM acms_articles_list ORDER BY alist_id DESC LIMIT 3";
$RESNEWS = $_CON->query($SQLNEWS);

$cnt = 1;
while($ROWNEWS = $RESNEWS->fetch(PDO::FETCH_ASSOC)){
    $news_cnt = ($cnt < 10) ? '0'.$cnt : $cnt;

echo '<li>
        <span>' . $news_cnt . '/</span>
        <h2>' . $ROWNEWS['alist_title'] . '</h2>
        <p>';
        $title_link = explode(' ', $ROWNEWS['alist_title']);
        $title_link = implode('-', $title_link);
        $description = '';

        $desc = preg_replace('/\s+/', ' ', strip_tags($ROWNEWS['alist_details']));
        $desc = explode(' ', $desc);

        for($i = 0; $i < 16; $i++){
            @$description .= $desc[$i] . ' ';
        }
        echo  $description . ' ...</p>
        <article>
            <span>' . date("D, F d, Y", $ROWNEWS['alist_postdate']) . '</span>
            <a href="news-events/news-details.php?dt=' . $ROWNEWS['alist_postdate'] . '&ttl=' . $title_link . '" id="more">
                read on
                <i class="fa fa-angle-right"></i>
            </a>
        </article>
    </li>';
    $cnt++;
}
?>