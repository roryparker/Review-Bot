<?php
require "includes/header.php";
require "includes/form_handlers/register_handler.php";
require "includes/classes/user.php";
require "includes/classes/post.php";

if (isset($_POST['post'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
    header("Location: index.php");
}

?>

    <div class="user_details column">

        <a href="#" 
           img src="<?php echo isset($user['profile_pic']); ?>"> 
        </a> <!-- links to profile page -->

        <div class="user_details_left_right">
            <a href="<?php echo $userLoggedIn; ?>"> <!-- links to profile page -->

                <?php 
                    echo isset($user['first_name']) . " " . isset($user['last_name']);
                    // added isset to correct $user errors in php 7 (https://stackoverflow.com/questions/66949863/warning-undefined-array-key)
                ?>
            </a>
            <br>

            <?php
                echo "Posts: " . isset($user['num_posts']). "<br>";   
                echo "Likes: " . isset($user['num_likes']);
            ?>
        </div>
    </div>

    <div class="main_column column"> 
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" 
                      id="post_text" 
                      placeholder="Got something to say?"> </textarea>
            <input type="submit" name="post" id="post_button" value="Post">
        </form>
    </div>

    </div>


</body>

</html>
