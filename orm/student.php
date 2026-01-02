<?php

class Student
{
    private $phone;
    private $password;
    private $email;
    private $surname;
    private $idstudent;
    private $profileimage;
    private $name;

    public function __construct(
        $phone,
        $password,
        $email,
        $surname,
        $idstudent,
        $profileimage,
        $name
    ) {
        $this->phone = $phone;
        $this->password = $password;
        $this->email = $email;
        $this->surname = $surname;
        $this->idstudent = $idstudent;
        $this->profileimage = $profileimage;
        $this->name = $name;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getIdStudent()
    {
        return $this->idstudent;
    }

    public function getProfileImage()
    {
        return $this->profileimage;
    }

    public function getName()
    {
        return $this->name;
    }
}
?>