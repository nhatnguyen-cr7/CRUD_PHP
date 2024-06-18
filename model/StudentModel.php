<?php
class StudentModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getAllStudents() {
        $query = "SELECT * FROM students";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getStudentById($student_id) {
        $query = "SELECT * FROM students WHERE id = $student_id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function addStudent($name, $address, $phone) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $address = mysqli_real_escape_string($this->conn, $address);
        $phone = mysqli_real_escape_string($this->conn, $phone);
    
        $query = "INSERT INTO students (name, address, phone) 
                  VALUES ('$name', '$address', '$phone')";
        
        return mysqli_query($this->conn, $query);
    }
    

    public function updateStudent($student_id, $name, $address, $phone) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $address = mysqli_real_escape_string($this->conn, $address);
        $phone = mysqli_real_escape_string($this->conn, $phone);
    
        $query = "UPDATE students SET name='$name', address='$address', phone='$phone' WHERE id=$student_id";
        return mysqli_query($this->conn, $query);
    }
    
    public function deleteStudent($student_id) {
        $query = "DELETE FROM students WHERE id = $student_id";
        return mysqli_query($this->conn, $query);
    }
}
?>
