<?php
class StudentModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }


    public function getAllStudents() {
        $query = "SELECT * FROM students";
        $result = mysqli_query($this->conn, $query);
        
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        
        return $students;
    }
    

    public function getStudentById($student_id) {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();
        return $student;
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

    public function searchStudents($search_query) {
        $search_query = mysqli_real_escape_string($this->conn, $search_query);
        $query = "SELECT * FROM students WHERE name LIKE '%$search_query%' OR address LIKE '%$search_query%' OR phone LIKE '%$search_query%'";
        $result = mysqli_query($this->conn, $query);
        
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        
        return $students;
    }

    public function getStudentsByPage($limit, $offset) {
        $stmt = $this->conn->prepare("SELECT * FROM students LIMIT ? OFFSET ?");
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $students = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $students;
    }

    public function getTotalStudents() {
        $result = $this->conn->query("SELECT COUNT(*) AS total FROM students");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function getStudentsByPageWithSort($limit, $offset, $sort, $order) {
        $validColumns = ['id', 'name', 'address', 'phone'];
        if (!in_array($sort, $validColumns)) {
            $sort = 'id'; 
        }
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

        $sql = "SELECT * FROM students";
        $sql .= " ORDER BY $sort $order";
        $sql .= " LIMIT $limit OFFSET $offset";

        $result = mysqli_query($this->conn, $sql);
        $students = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }
    
        return $students;
    }
    
    
    
    
}
?>
