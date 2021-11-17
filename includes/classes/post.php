<?php
class post
{
    private $user_obj;
    private $con;
    
    /**
     * __construct
     *
     * @param  mixed $con  // user object
     * @param  mixed $user // the user object
     * @return void
     */
    public function __construct($con, $user)
    {
        $this->con = $con;
        $this->user_obj = new User($con, $user);
    }

    /**
     * submitPost
     *
     * @param  mixed $body       // the body of the post
     * @param  mixed $user_token // end
     * @return void
     */
    public function submitPost($body, $user_token)
    {
        $body = strip_tags($body); //removes html tags
        $body = mysqli_real_escape_string($this->con, $body);
        
        //checks body string and replaces return with new line
        $body = str_replace('\r\n', '\n', $body);
        
        // Look for any line break and replace with HTML line break.
        $body = nl2br($body);
        $check_empty = preg_replace('/\s+/', '', $body); // deletes all spaces

        if ($check_empty != "") {

            // Current date and time
            $date_added = date("Y-m-d H:i:s");
            // Get username
            $added_by = $this->user_obj->getUsername();
            //if user is on own profile, user_to is 'none'
            if ($user_to == $added_by) {
                $user_to = "none";
            }
            
            //insert post
            $query = mysqli_query(
                $this->con, "INSERT INTO posts VALUES('', '$body', 'added_by', 
                '$user_to', '$date_added', 'no', 'no', '0')"
            );
            $returned_id = mysqli_insert_id($this->con);

            //Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query(
                $this->con, "UPDATE users 
                            SET num_posts = '$num_posts' 
                            WHERE username='$added_by'"
            );

        }
    }

}
