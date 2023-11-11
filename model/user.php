<?php
class User
{
    private $id_user;
    private $email;
    private $password;
    private $genre;
    private $firstname;
    private $lastname;
    private $birthdate;
    //private $profile_image;

    public function __construct(
        $id_user,
        $email,
        $password,
        $genre,
        $firstname,
        $lastname,
        $birthdate
    ) {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->password = $password;
        $this->genre = $genre;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getNames()
    {
        return $this->firstname;
    }

    public function setNames($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    static public function parseJson($json) {
        $user = new User(
            isset($json["id_user"]) ? $json["id_user"] : "",
            isset($json["email"]) ? $json["email"] : "",
            isset($json["user_password"]) ? $json["user_password"] : "",
            isset($json["genre"]) ? $json["genre"] : "",
            isset($json["firstname"]) ? $json["firstname"] : "",
            isset($json["lastname"]) ? $json["lastname"] : "",
            isset($json["birthdate"]) ? $json["birthdate"] : ""
        );
        return $user;
    }

    public static function AuthenticateUser($mysqli, $email, $password)
    {
        
        $sql = "SELECT id_user, email FROM users WHERE email = ? AND user_password = ? LIMIT 1;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss",$email, $password);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : NULL;
    }

    public static function SaveUser(
        $mysqli,
        $password, 
        $email,
        $name,
        $lastname,
        $birthdate,
        $genre
    )
    {
        $sql = "INSERT INTO `users`( `email`, `user_password`, `firstname`, `lastname`, `birthdate`, `genre`) VALUES (?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param
        (
            "sssssi",
            $email,
            $password,
            $name,
            $lastname,
            $birthdate,
            $genre
        );
        $stmt->execute();
    }
}
?>