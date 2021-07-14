

            </section>

            <section class="news-block">
                <h1>latest news &amp; events</h1>
                <ul>
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
                            <a href="../news-events/news-details.php?dt=' . $ROWNEWS['alist_postdate'] . '&ttl=' . $title_link . '" id="more">
                                read on
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </article>
                    </li>';
                    $cnt++;
                }
                ?>
                </ul>

                <a href="../news-events/" id="more-all">
                    more new articles 
                    <i class="fa fa-angle-right"></i>
                </a>
            </section>

            <section class="footer-block">
                <ul class="quick-links">
                    <li class="">
                        <h1>about us</h1>
                        <p>
                            We are an investment company founded on the basis of innovation and excellence. Our customers’ interest is of importance to us and so the team work collectively to ensure that innovative products and services are tailored to meet each customer’s peculiar need.
                        </p>

                        <span id="tel">
                            <i class="fa fa-phone"></i> 
                            +233 302 802 050
                        </span>
                        <span id="soc">
                            <a href="https://www.facebook.com/pg/muteswancapital/" target="_blank" class="fa fa-facebook"></a>
                            <a href="https://www.twitter.com/@swan_mute" target="_blank" class="fa fa-twitter"></a>
                            <a href="https://www.instagram.com/muteswancapital/" target="_blank" class="fa fa-instagram"></a>
                        </span>
                    </li>
                    <li>
                        <a href="../" id="act">home</a>
                        <a href="../about/">about us</a>
                        <a href="../about/board-of-directors.php">board of directors</a>
                        <a href="../about/executive-team.php">executive team</a>
                        <a href="../about/research.php">research</a>
                        <a href="../services/">services</a>
                    </li>
                    <li>
                        <a href="../services/asset-management.php">asset management</a>
                        <a href="../contacts/">contact us</a>
                        <a href="../careers/">careers</a>
                        <a href="../news-events/">News &amp; Events</a>
                        <a href="../faqs/">FAQs</a>
                    </li>
                </ul>
            </section>

            <footer>
                Copyright &copy; 2018. 
                Mute Swan Capital Limited. 
                <span>|</span>
                Works by <a href="https://www.enovivo.com/" target="_blank">Enovivo</a>
            </footer>
        </section>
    </body>
</html>
