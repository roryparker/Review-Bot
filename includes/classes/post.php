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
    /**
     * loadPostsFriends
     *
     * @return void
     */
    public function loadPostsFriends() {
        $str = "";
        $data = mysqli_query(this->con, "SELECT * FROM posts WHERE deleted = 'no' ORDER BY id DESC LIMIT 1");

        while($now = mysql_fetch_array($data)) {
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_time'];
            // Prepare user_to string so it can be included even if not posted to a user
            if ($row['user_to'] == "none") {
               $user_to = "";
            }
            else {
                $user_to_obj = new User($con, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName;
                $user_to = "<a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>' ";
            }

            //Check if user who posted, has their account closed
            $added_by_obj = new User($con, $added_by);
            if ($added_by_obj->isCloud()) {
                continue;
            }

            $user_details_query = mysqli_query(this->con,"SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
            $user_row = mysqli_fetch_query($user_details_query);

            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); //Time of post
            $end_date = new DateTime($date_time_now); // Current timeout
            $interval = $start_date->diff($end_data);
            if ($interval-> >= 1) {
                if ($interval == 1) 
                    $time_message = $interval->y . " year ago"; //1 year ago
                else
                    $time_message = $interval->y . " years ago"; //1+ year ago
            }
            else if ($interval-> >= 1) {
                if (interval->d == 0) {
                    $days = " ago";
                }
                else if($interval->d == 1) {
                    $days = $interval->d . " day ago"
                }
                else {
                    $days = $interval-> . " days ago"
                }

                if ($interval -> == 1) {
                    $time_message = $interval->m . " month". $days;
                }
                else {
                    $time_message = $interval->m . " months". $days;
                }
            }
            else if ($interval->d >= 1) {
                if($interval->d == 1) {
                    $time_message ="Yesterday";
                }
                else {
                    $time_message = $interval->d . " days ago";
                }
           else if ($interval->h >= 1) {
            if($interval->h == 1) {
                $time_message = $interval->h . "hour ago";
            }
            else {
                $time_message = $interval->h " hours ago";
             }
            }
            else if ($interval->i >= 1) {
            if($interval->i == 1) {
                $time_message = $interval->i . "minute ago";
            }
            else {
                $time_message = $interval->i . " minutes ago";
            }
            else if ($interval->s < 30) {
                if($interval->h == 1) {
                    $time_message = "Posted Just Now";
                }
                else {
                    $time_message = $interval->s . " seconds ago";
                }
            }   
            $str .= <"div class=" 'status_post'>
            
}
''