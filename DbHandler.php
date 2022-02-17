<?php

class DbHandler {

    public function connectToFamilyDB() {
        $servername = "jhouv.eu";
        $username = "familyUser";
        $password = "Geo@1994!";
        $dbname = "familyDB";
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_set_charset($conn, "utf8");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            //echo 'welcome ha';
        }
        return $conn;
    }

    public function login($username, $password) {
        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_user WHERE username = '" . $username . "' AND password = '" . $password . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            throw new Exception('Could not log you in');
        }
    }

    public function addWord() {
        $conn = $this->connectToFamilyDB();
        $italian = $_POST['italian'];
        $type = $_POST['type'];
        $greek = $_POST['greek'];
        $plural = $_POST['plural'];
        $articoloD = $_POST['articoloD'];
        $articoloD = str_replace("'", "''", "$articoloD");
//        echo $articoloD;
        $articoloDP = $_POST['articoloDP'];
        $comment = $_POST['comment'];
        $comment = str_replace("'", "''", "$comment");
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '') {
            $categoryId = $_POST['categoryId'];
        } else {
            $categoryId = 'null';
        }
        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
        } else {
            $gender = null;
        }
        $sql = "INSERT INTO italiano_word (italian,greek,gender,plural,articoloD,articoloDP,date,comment,type,categoryId) VALUES ('$italian','$greek','$gender','$plural','$articoloD','$articoloDP',CURDATE(),'$comment','$type',$categoryId)";
        if ($conn->query($sql) === TRUE) {
            echo "<b>Προστέθηκε το $italian</b>";
        } else {
            echo "Error" . $sql;
        }
        $conn->close();
    }

    public function addWordCategory() {
        $conn = $this->connectToFamilyDB();
        $categoryName = $_POST['categoryName'];
        $sql = "INSERT INTO italiano_wordCategories (categoryName) VALUES ('$categoryName')";
//        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "<b>Προστέθηκε το $categoryName</b>";
        } else {
            echo "Error";
        }
        $conn->close();
    }

    public function updateWord() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $italian = $_POST['italian'];
        $italian = str_replace("'", "''", $italian);
        $greek = $_POST['greek'];
        $greek = str_replace("'", "''", $greek);
        $plural = $_POST['plural'];
        $articoloD = $_POST['articoloD'];
        $articoloD = str_replace("'", "''", $articoloD);
        $articoloDP = $_POST['articoloDP'];
        $articoloDP = str_replace("'", "''", $articoloDP);
        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
        } else {
            $gender = null;
        }
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '') {
            $categoryId = $_POST['categoryId'];
        } else {
            $categoryId = 'null';
        }

        $type = $_POST['type'];
        $sql = "UPDATE italiano_word set italian='$italian',greek='$greek',gender='$gender',plural='$plural',articoloD='$articoloD',articoloDP='$articoloDP',date=CURDATE(), categoryId = $categoryId, type = '$type' WHERE wordId = $wordId";
//        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "Διορθώθηκε το $italian";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function updateSentence() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $italian = $_POST['italian'];
        $italian = str_replace("'", "''", $italian);
        $greek = $_POST['greek'];
        $greek = str_replace("'", "''", $greek);
        $sql = "UPDATE italiano_word set italian='$italian',greek='$greek' WHERE wordId = $wordId";
        if ($conn->query($sql) === TRUE) {
            echo "Διορθώθηκε το $italian";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function deleteWord() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $italian = $_POST['italian'];
        $sql = "DELETE FROM italiano_word WHERE wordId = $wordId";
        if ($conn->query($sql) === TRUE) {
            echo "Διαγράφηκε το $italian";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function addVerb() {
        $conn = $this->connectToFamilyDB();
        $italian = $_POST['italian'];
        $greek = $_POST['greek'];
        $sql = "INSERT INTO italiano_word (italian,greek,type) VALUES ('$italian','$greek','ρήμα')";
        if ($conn->query($sql) === TRUE) {
            echo "Προστέθηκε το $italian";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function addVerbConiugazione() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $coniugazione = $_POST['coniugazione'];
        $type = $_POST['type'];
        $tense = $_POST['tense'];
        $sql = "INSERT INTO italiano_verbConiugazione (wordId,type,tense,coniugazione) VALUES ('$wordId','$type','$tense','$coniugazione')";
        if ($conn->query($sql) === TRUE) {
            echo "Προστέθηκε o $type $tense";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function getVerbConiugazione() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $sql = "SELECT * FROM italiano_verbConiugazione WHERE wordId = $wordId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            $conn->close();
            return $result;
        } else {
            $conn->close();
            echo "Δεν έχουν καταχωρηθεί κλίσεις ακόμα σε αυτό το ρήμα";
        }
    }

    public function addNote() {
        $conn = $this->connectToFamilyDB();
        $note = $_POST['note'];
        $date = $_POST['date'];
        if (isset($_POST['submitNote'])) {
            //echo 'eeeeeeeeeeeeeeeeeeee';
            $sql = "INSERT INTO italiano_note (note,date) VALUES ('" . $note . "','" . $date . "')";
            if ($conn->query($sql) === TRUE) {
                echo "Η σημείωση αποθηκεύτηκε";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    
    public function updateNote() {
        $conn = $this->connectToFamilyDB();
        $noteId = $_POST['noteId'];
        $note = $_POST['note'];
        $date = $_POST['date'];
        if (isset($_POST['updateNote'])) {
            $sql = "UPDATE italiano_note SET note= '$note'  WHERE noteId = $noteId";
            if ($conn->query($sql) === TRUE) {
                echo "Η σημείωση διορθώθηκε";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    
    public function deleteNote() {
        $conn = $this->connectToFamilyDB();
        $noteId = $_POST['noteId'];        
        if (isset($_POST['deleteNote'])) {
            $sql = "DELETE FROM italiano_note  WHERE noteId = $noteId";
            if ($conn->query($sql) === TRUE) {
                echo "Η σημείωση διαγράφηκε";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }


    public function getNotes() {
        $conn = $this->connectToFamilyDB();
        if (isset($_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $date = '2020-01-01';
        }
        $sql = "SELECT * FROM italiano_note WHERE date >= '" . $date . "' ORDER BY date DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
//                 echo 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee' . $sql;
            return $result;
        } else {
            echo '0 results';
        }
    }
    
    public function getNote($noteId) {
        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_note WHERE noteId = $noteId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo 'μπράβο';
            return $result;
        } else {
            echo '0 results '.$sql;
        }
    }

    public function addSentence() {
        $conn = $this->connectToFamilyDB();
        $italian = $_POST['italian'];
        $italian = str_replace("'", "''", "$italian");
        $greek = $_POST['greek'];
        $greek = str_replace("'", "''", "$greek");
        $sql = "INSERT INTO italiano_word (italian,greek,type,categoryId) VALUES ('$italian','$greek',πρόταση',7)";
        if ($conn->query($sql) === TRUE) {
            echo "Προστέθηκε το $italian";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    public function getWords() {
        $conn = $this->connectToFamilyDB();
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '') {
            $categoryId = 'WHERE categoryId = ' . $_POST['categoryId'];
        } else {
            $categoryId = '';
        }
        $orderBy = $_POST['orderBy'];
        $order = 'ORDER BY italian ASC';
        if (isset($_POST['italian'])) {
            $language = 'italian';
        } else {
            $language = 'greek';
        }
        if ($orderBy == 'dateAdded') {
            $order = 'ORDER BY date ASC';
        } elseif ($orderBy == 'wordAsc') {
            $order = 'ORDER BY ' . $language . ' ASC';
        } elseif ($orderBy == 'wordDesc') {
            $order = 'ORDER BY ' . $language . ' DESC';
        } elseif ($orderBy == 'category') {
            $order = 'ORDER BY category ASC';
        }
        $sql = "SELECT * FROM italiano_word $category  $order";
//        echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "Δεν υπάρχουν λέξεις στην κατηγορία " . $_POST['categoryId'];
        }
    }

    public function getWordsForTest() {
        $conn = $this->connectToFamilyDB();
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '') {
            $categoryId = 'categoryId = ' . $_POST['categoryId'];
        } else {
            $categoryId = '';
        }
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '' || isset($_POST['type']) && $_POST['type'] != '') {
            $where = 'WHERE';
        } else {
            $where = '';
        }
        if (isset($_POST['categoryId']) && $_POST['categoryId'] != '' && isset($_POST['type']) && $_POST['type'] != '') {
            $and = 'and';
        } else {
            $and = '';
        }
        if (isset($_POST['type']) && $_POST['type'] != '') {
            $type = "type = '" . $_POST['type'] . "' ";
        } else {
            $type = '';
        }
        $sql = "SELECT * FROM italiano_word $where $type $and $categoryId";
//        echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "Δεν υπάρχουν λέξεις στην κατηγορία " . $_POST['categoryId'];
        }
    }

    public function getVerbs() {
        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_word WHERE type = 'ρήμα' ORDER BY italian ASC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo 'error';
        }
    }

    public function getSentences() {

        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_word WHERE type = 'πρόταση' ORDER BY italian ASC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
//            echo $sql;
            return $result;
        } else {
            echo 'error';
//            echo $sql;
        }
    }

    public function getWord() {
        $conn = $this->connectToFamilyDB();
        $wordId = $_POST['wordId'];
        $sql = "SELECT * FROM italiano_word WHERE wordId = $wordId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "0 results", $sql;
        }
    }

    public function findWord() {
        $conn = $this->connectToFamilyDB();
        $word = $_POST['word'];
        $sql = "SELECT * FROM italiano_word WHERE italian LIKE '%$word%' OR greek LIKE '%$word%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "<p class=\"text-center\">Δεν υπάρχει στο λεξικό η λέξη <b>$word</b></p>";
        }
    }

    public function getWordCategories() {
        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_wordCategories";
//        echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "0 results", $sql;
        }
    }

    public function getTypes() {
        $conn = $this->connectToFamilyDB();
        $sql = "SELECT * FROM italiano_wordType ORDER BY type ASC";
//        echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        } else {
            echo "0 results", $sql;
        }
    }

    public function checkIfWordExists() {
        $conn = $this->connectToFamilyDB();
        $word = $_POST['italian'];
        $sql = "SELECT * FROM italiano_word WHERE italian = '$word'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $conn->close();
            return true;
        } else {
            return false;
        }
    }

}
