
        <?php
        include "../layouts/header.php";

        $SQLCONTENT = "SELECT * FROM acms_pages WHERE page_menu_id = '11'";
        $RESCONTENT = $_CON->query($SQLCONTENT);
        while($ROWCONTENT = $RESCONTENT->fetch(PDO::FETCH_ASSOC)){
            echo stripslashes($ROWCONTENT['page_title']) . '</article>';
            echo '<h1>' . stripslashes($ROWCONTENT['page_title']) . '</h1>';
            echo '<ul>
                    <li class="left-side">
                        <p>' . stripslashes($ROWCONTENT['page_content']) . '</p>
                    </li>';
        }
        ?>
                    
                    <li class="right-side">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.549621726269!2d-0.09984728566988942!3d5.633291195916345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf84b1249f2709%3A0x6fde8c2c3389e134!2sZenith+Bank+-+Spintex+Road+Branch!5e0!3m2!1sen!2sgh!4v1512747681585" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen>
                        </iframe>
                    </li>
                </ul>

                <form action="" method="post" class="feedback-form">
                    <h2>Feedback Form</h2>
                    <input type="" name="" placeholder="Name">
                    <input type="" name="" placeholder="Email">
                    <input type="" name="" placeholder="Telephone">
                    <textarea placeholder="Message"></textarea>

                    <button type="submit">
                        submit message
                    </button>
                </form>
            </section>

    <?php include "../layouts/footer.php"; ?>