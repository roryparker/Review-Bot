<?php



/**
 * User
 * 
 * @category User
 * @package  User
 * @author   Rory Parker <rorysethparker@gmail.com>
 * @license  http://www.opensource.org/licenses/ open-source
 * @link     http://www.me.me.me.com
 */

class user
{
    private $user;
    private $con;
    
    /**
     * __construct
     *
     * @param  mixed $con
     * @param  mixed $user
     * @return void
     */
    public function __construct($con, $user)
    {
        $this->con = $con;
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }
    
    /**
     * GetUsername
     *
     * @return void
     */
    public function getUsername()
    {
        return $this->user['username'];
    }
    
    /**
     * GetNumPosts
     *
     * @return void
     */
    public function getNumPosts()
    {
        $username = $this->user['username'];
        $query = mysqli_query(
            $this->con, "SELECT num_posts FROM users WHERE username='$username'"
        );
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }
    
    /**
     * GetFirstAndLastName
     *
     * @return void
     */
    public function getFirstAndLastName()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }
    
    /**
     * isClosed
     *
     * @return void
     */
    public function isClosed() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);

        if ($row['user_closed'] == 'yes')
            return true;
        else
            return false;
    }

}

?>
