<?php

class Contestant
{
    // Properties
    private $db;
    private $name;
    private $email;
    private $catname;
    private $breed;

    function __construct()
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function addParticipant(string $name, string $email, string $catname, string $breed): bool
    {
        if (!$this->setName($name)) return false;
        if (!$this->setEmail($email)) return false;
        if (!$this->setCatName($catname)) return false;
        if (!$this->setBreed($breed)) return false;

        // Store in database
        $sql = "INSERT INTO contestants(name, email, catname, breed)VALUES('" . $this->name . "', '" . $this->email . "', '" . $this->catname . "','" . $this->breed . "')";

        $result = $this->db->query($sql);

        return $result;
    }

    public function getParticipants(): array
    {
        $sql = "SELECT * FROM contestants ORDER BY name;";

        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function sendMail(): bool
    {
        $sql = "SELECT email FROM contestants";
        $result = $this->db->query($sql);

        // Loop through all contestants and send an email
        while ($row = $result->fetch_assoc()) {
            $to = $row['email'];
            $subject = "Kattutställning";
            $message = "Hej!\n\nDin anmälan till kattutställningen är mottagen.\n\nMvh\nKattutställningen";

            mail($to, $subject, $message);
        }

        return true;
    }

    /** Setter and getters */
    public function setName(string $name): bool
    {
        if ($name != "") {
            $this->name = $this->db->real_escape_string($name);
            return true;
        }

        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $this->db->real_escape_string($email);;
            return true;
        }

        return false;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setCatname(string $catname): bool
    {
        if ($catname != "") {
            $this->catname = $this->db->real_escape_string($catname);;
            return true;
        }

        return false;
    }

    public function getCatName(): string
    {
        return $this->catname;
    }

    public function setBreed(string $breed): bool
    {
        if ($breed != "") {
            $this->breed = $this->db->real_escape_string($breed);;
            return true;
        }

        return false;
    }

    public function getBreed(): string
    {
        return $this->breed;
    }

    /** Destructor */
    function __destruct()
    {
        $this->db->close();
    }
}
