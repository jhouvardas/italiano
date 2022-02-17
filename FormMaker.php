<?php
require_once 'DbHandler.php';
$db = new DbHandler();

class FormMaker {

    public function addWordCategory() {
        ?>
        <!--<div class="container">-->  
        <h2>Νέα κατηγορία λέξεων</h2>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> "  method="post">  
            <div class="form-group">         
                <label for="categoryName">Όνομα Κατηγορίας:</label>             
                <input type="text" class="form-control" id="name" placeholder="Δώστε όνομα" name="categoryName" required>             
            </div>                   
            <button type="submit" class="btn btn-success" name="submitNewWordCategory">Υποβολή</button>         
        </form>  
        <!--</div>-->  
        <?php
    }

    public function addWordForm() {
        ?>        
        <!--<div class="container">-->
        <h5>Νέα Λέξη</h5>            
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <?php $this->selectWordTypeAutofocus($type); ?>
            <div class="form-group">
                <label for="italian" class="form-label">Italian</label>                
                <input type="text" class="form-control" id="italian" name="italian" required>                
            </div>
            <div class="form-group">
                <label for="articoloD" class="form-label">Articolo Determinativo</label>                
                <input type="text" class="form-control" id="articoloD" name="articoloD">                
            </div>

            <div class="form-group">
                <label for="greek" class="form-label">Greek</label>                
                <input type="text" class="form-control" id="greek" name="greek">                
            </div>
            <div class="form-group">
                <label for="plural" class="form-label">Plural</label>                
                <input type="text" class="form-control" id="greek" name="plural">                
            </div>
            <div class="form-group">
                <label for="articoloDP" class="form-label">Articolo Determinativo Plurale</label>                
                <input type="text" class="form-control" id="articoloDP" name="articoloDP">                
            </div>

            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="masc">masc
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="fem">fem
                    </label>
                </div>
            </div>
            <?php
            $this->selectWordCategory();
            ?>  
            <div class="form-group">
                <label for="comment">Σημείωση</label>
                <textarea class="form-control" rows="4" name="comment" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="submitWord">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function addSentenceForm() {
        ?>        
        <!--<div class="container">-->
        <h5>Νέα Πρόταση</h5>            
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="form-group">
                <label for="italian" class="form-label">Italian</label>                
                <input type="text" class="form-control" id="italian" name="italian" required autofocus>                
            </div>
            <div class="form-group">
                <label for="greek" class="form-label">Greek</label>                
                <input type="text" class="form-control" id="greek" name="greek">                
            </div>                
            <button type="submit" class="btn btn-success" name="submitSentence">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function editSentenceForm() {
        $db = new DbHandler();
        $wordResource = $db->getWord();
        $row = $wordResource->fetch_assoc();
        ?>        
        <!--<div class="container">-->
        <h5>Διόρθωση πρότασης</h5>            
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <input type="hidden" id="custId" name="wordId" value="<?php echo $row['wordId'] ?>">
            <div class="form-group">
                <label for="italian" class="form-label">italiano</label>                
                <input type="text" class="form-control" id="italian" name="italian" value="<?php echo $row['italian']; ?>" required>                
            </div>
            <div class="form-group">
                <label for="greek" class="form-label">greco</label>                
                <input type="text" class="form-control" id="greek" name="greek" value="<?php echo $row['greek']; ?>">                
            </div>                
            <button type="submit" class="btn btn-success" name="updateSentence">Διόρθωση</button>
            <button type="submit" class="btn btn-success" name="deleteSentence">Διαγραφή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function addVerbConiugazione($wordId) {
        ?>
        <!--<div class="container">-->
        <h5>Νέα κλίση ρήματος</h5>            
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <input type="hidden" id="wordId" name="wordId" value="<?php echo $wordId ?>">
            <div class="form-group">
                <label for="type">Τύπος:</label>
                <select class="form-control" id="type" name="type">
                    <option value=""></option>
                    <option value="indicativo">indicativo</option>
                    <option value="congiuntivo">congiuntivo</option>
                    <option value="condizionale">condizionale</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tense">Χρόνος:</label>
                <select class="form-control" id="tense" name="tense">
                    <option value=""></option>
                    <option value="presente">presente</option>
                    <option value="passato prossimo">passato prossimo</option>
                    <!--<option value="condizionale">ondizionale</option>-->
                </select>
            </div>
            <div class="form-group">
                <label for="coniugazione">Σημείωση</label>
                <textarea class="form-control" rows="8" name="coniugazione" id="coniugazione"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="submitConiugazione">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function addNoteForm() {
        ?>

        <!--<div class="container">-->
        <h5>Νέα Σημείωση</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <?php // $this->selectStudent(); ?>
            <?php $this->selectDate(); ?>
            <div class="form-group">
                <label for="note">Σημείωση</label>
                <textarea class="form-control" rows="4" name="note" id="note"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="submitNote">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function getNotesForm() {
        ?>

        <!--<div class="container">-->  
        <h5>Αναζήτηση Σημειώσεων</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post">  
            <?php // $this->selectStudent(); ?>
            <?php $this->selectDateNotRequired(); ?>    
            <?php // $this->selectToDateNotRequired(); ?> 
            <button type="submit" class="btn btn-success" name="getNotes">Υποβολή</button>         
        </form>                
        <!--</div>-->  
        <?php
    }

    public function editNoteForm($noteResource) {
        ?>        
        <!--<div class="container">-->
        <h5>Διόρθωση Σημείωσης</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="form-group">
                <label for="note">Σημείωση</label>
                <textarea class="form-control" rows="4" name="note" id="note">
                    <?php
                    while ($row = $noteResource->fetch_assoc()) {
                        echo $row['note'];
                        $noteId = $row['noteId'];
                    }
                    ?>
                </textarea>
                <input type="hidden" id="noteId" name="noteId" value="<?php echo $noteId; ?>">
            </div>
            <button type="submit" class="btn btn-success" name="updateNote">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function displayEditDeleteNotes($notesResource) {
        ?>        
        <!--<div class="container">-->  
        <h5>Επιλογή Σημείωσης</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post">  
            <?php
            $i = 1;
            while ($row = $notesResource->fetch_assoc()) {
                echo '<div class="form-check">';
                echo '<label class="form-check-label" for="check1">';
                $date = date_create($row['date']);
                echo ' <input type="radio" class="form-check-input" name="noteId" value="' . $row['noteId'] . '">' . date_format($date, "D d/m/y") . ' ' . $row['note'];
                echo ' </div>';
                echo '<hr>';
                $i++;
            }
            ?>
            <button type="submit" class="btn btn-success" name="editOneNote">Διόρθωση</button>  
            <button type="submit" class="btn btn-success" name="deleteNote">Διαγραφή</button> 
        </form>                
        <!--</div>-->  
        <?php
    }

    public function showWordsForEditForm($wordResource) {
        ?>
        <!--<div class="container">-->
        <!--<h5>Νέα κλίση ρήματος</h5>-->            
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>                                
                            <th>Italiano</th>
                            <th>Greco</th>
                            <th>Επιλογή</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        while ($row = $wordResource->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['italian'] . '</td>';
                            echo '<td>' . $row['greek'] . '</td>';
                            echo '<td>';
                            echo '<div class="form-check">';
                            echo '<input type="radio" class="form-check-input" id="radio2" name="wordId" value="' . $row['wordId'] . '">';
                            echo '</div>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success" name="editWord">Διόρθωση Λέξης</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function editWordForm() {
        $db = new DbHandler();
        $wordResource = $db->getWord();
        $row = $wordResource->fetch_assoc();
        ?>        
        <!--<div class="container">-->
        <h5>Διόρθωση Λέξης</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <input type="hidden" id="custId" name="wordId" value="<?php echo $row['wordId'] ?>">
            <div class="form-group">
                <label for="italian" class="form-label">Italian</label>                
                <input type="text" class="form-control" id="italian" name="italian" value="<?php echo $row['italian'] ?>" >                
            </div>
            <div class="form-group">
                <label for="articoloD" class="form-label">Articolo Determinativo</label>                
                <input type="text" class="form-control" id="articoloD" name="articoloD" value="<?php echo $row['articoloD'] ?>">                
            </div>

            <div class="form-group">
                <label for="greek" class="form-label">Greek</label>                
                <input type="text" class="form-control" id="greek" name="greek" value="<?php echo $row['greek'] ?>">                
            </div>
            <div class="form-group">
                <label for="plural" class="form-label">Plural</label>                
                <input type="text" class="form-control" id="greek" name="plural" value="<?php echo $row['plural'] ?>">                
            </div>
            <div class="form-group">
                <label for="articoloDP" class="form-label">Articolo Determinativo Plurale</label>                
                <input type="text" class="form-control" id="articoloDP" name="articoloDP" value="<?php echo $row['articoloDP'] ?>">                
            </div>

            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="masc" <?php
                        if ($row['gender'] == 'masc') {
                            echo 'checked';
                        };
                        ?> >masc
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="fem" <?php
                        if ($row['gender'] == 'fem') {
                            echo 'checked';
                        };
                        ?>>fem
                    </label>
                </div>
            </div>
            <?php
            $this->selectWordType($row['type']);
            $this->selectWordCategoryNotRequired($row['categoryId']);
            ?>  
            <div class="form-group">
                <label for="comment">Σημείωση</label>
        <!--                    <textarea class="form-control" rows="4" name="comment" id="comment"></textarea>-->
                <textarea id="comment" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="updateWord">Διόρθωση</button>
            <button type="submit" class="btn btn-success" name="deleteWord">Διαγραφή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function testForm() {
        ?>        
        <!--<div class="container">-->
        <h5>Νέο Test</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <?php
            $this->selectWordCategory();
            $this->selectWordType($type);
            ?>
            <button type="submit" class="btn btn-success" name="startTest">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function findWordForm() {
        ?>

        <!--<div class="container">-->
        <h5>Αναζήτηση λέξης</h5>
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="form-group">
                <label for="word" class="form-label">Λέξη</label>                
                <input type="text" class="form-control" id="word" name="word" autofocus>                
            </div>
            <button type="submit" class="btn btn-success" name="findWord">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function findWordFormAjax() {
        ?>
        <h3>Start typing a name in the input field below:</h3>

        <p>Suggestions: <span id="txtHint"></span></p> 
        <p>First name: <input type="text" id="txt1" onkeyup="showHint(this.value)"></p>

        <script>
            function showHint(str) {
                if (str.length == 0) {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function () {
                    document.getElementById("txtHint").innerHTML =
                            this.responseText;
                }
                xhttp.open("GET", "gethint.php?q=" + str);
                xhttp.send();
            }
        </script>

        <?php
    }

    public function addVerbForm() {
        ?>
        <h5>Νέο Ρήμα</h5>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="form-group">
                <label for="italian" class="form-label">Italian</label>                
                <input type="text" class="form-control" id="italian" name="italian" autofocus>                
            </div>
            <div class="form-group">
                <label for="greek" class="form-label">Greek</label>                
                <input type="text" class="form-control" id="greek" name="greek">                
            </div>

            <div class="form-group">
                <label for="comment">Σημείωση</label>
                <textarea class="form-control" rows="4" name="comment" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="submitVerb">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function addVerbStuffForm() {
        ?>
        <h5>Νέο Ρήμα</h5>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> " method="post" >
            <div class="form-group">
                <label for="italian" class="form-label">Italian</label>                
                <input type="text" class="form-control" id="italian" name="italian">                
            </div>
            <div class="form-group">
                <label for="greek" class="form-label">Greek</label>                
                <input type="text" class="form-control" id="greek" name="greek">                
            </div>

            <div class="form-group">
                <textarea id="mytextarea" name="test"></textarea>

            </div>
            <button type="submit" class="btn btn-success" name="submitVerb">Υποβολή</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function showDictionaryForm() {
        ?>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> "  method="post">                
            <?php
            $this->selectWordCategory();
            ?>              

            <div class="form-group">
                <label for="orderBy">Ταξινόμηση:</label>
                <select class="form-control" id="orderBy" name="orderBy">
                    <option value=""></option>
                    <option value="wordAsc">Αλφαβητικά αύξουσα </option>
                    <option value="wordDesc">Αλφαβητικά φθίνουσα</option>
                    <option value="category">Κατηγορία</option>
                    <option value="dateAdded">Ημερομηνία Καταχώρησης</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="italian">
                        <input type="checkbox" class="form-check-input" id="italiano" name="italian" value="yes">italiano
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="greek">
                        <input type="checkbox" class="form-check-input" id="greek" name="greek" value="yes">Greco
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="articoloD">
                        <input type="checkbox" class="form-check-input" id="lastName" name="articoloD" value="yes">articolo determinativo
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="articoloDP">
                        <input type="checkbox" class="form-check-input" id="showLocation" name="articoloDP" value="yes">articolo determinativo plurale
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="gender">
                        <input type="checkbox" class="form-check-input" id="gender" name="gender" value="yes">genere
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="plural">
                        <input type="checkbox" class="form-check-input" id="gender" name="plural" value="yes">plurale
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="displayDictionary">Submit</button>
        </form>
        <!--</div>-->
        <?php
    }

    public function selectDate() {
        ?>
        <div class="mb-3">  
            <label for="date">Ημερομηνία:</label>             
            <input type="date" class="form-control" id="date" placeholder="Ημερομηνία" name="date" required>  
        </div> 
        <?php
    }

    public function selectDateLocal() {
        ?>
        <div class="mb-3">  
            <label for="date">Ημερομηνία:</label>             
            <input type="datetime-local" class="form-control" id="date" placeholder="Ημερομηνία" name="date" required>  
        </div> 
        <?php
    }

    public function selectToDateNotRequired() {
        ?>
        <div class="mb-3">  
            <label for="date">Μέχρι Ημερομηνία:</label>             
            <input type="date" class="form-control" id="date" placeholder="Ημερομηνία" name="toDate">  
        </div> 
        <?php
    }

    public function selectDateNotRequired() {
        ?>
        <div class="mb-3">  
            <label for="date">Ημερομηνία:</label>             
            <input type="date" class="form-control" id="date" placeholder="Ημερομηνία" name="date">  
        </div> 
        <?php
    }

    public function selectWord() {
        $wordList = new DbHandler;
        ?>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> "  method="post"> 
            <div class="form-group">         
                <label for="words">Λέξεις:</label>  
                <select class="form-control" id="lessonId" name="wordId" onchange="this.form.submit()">             
                    <?php
                    $result = $wordList->getWords();
                    echo '<option value=""></option>';
                    while ($row = $result->fetch_assoc()) {
                        echo'<option value="' . $row['wordId'] . '">' . $row['italian'] . '</option>';
                    }
                    ?>
                </select>             
            </div>
        </form>
        <!--</div>-->
        <?php
    }

    public function selectSentence() {
        $sentenceList = new DbHandler;
        ?>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> "  method="post"> 
            <div class="form-group">         
                <label for="wordId">Προτάσεις:</label>  
                <select class="form-control" id="wordId" name="wordId" onchange="this.form.submit()">             
                    <?php
                    $result = $sentenceList->getSentences();
                    echo '<option value=""></option>';
                    while ($row = $result->fetch_assoc()) {
                        echo'<option value="' . $row['wordId'] . '">' . $row['italian'] . '</option>';
                    }
                    ?>
                </select>             
            </div>
        </form>
        <!--</div>-->
        <?php
    }

    public function selectVerb() {
        $verbList = new DbHandler;
        ?>
        <!--<div class="container">-->
        <form action="<?php htmlspecialchars($_SERVER[PHP_SELF]) ?> "  method="post"> 
            <div class="form-group">         
                <label for="words">Ρήματα:</label>  
                <select class="form-control" id="lessonId" name="wordId" onchange="this.form.submit()">             
                    <?php
                    $result = $verbList->getVerbs();
                    echo '<option value=""></option>';
                    while ($row = $result->fetch_assoc()) {
                        $italian = $row['italian'];
//                            if(isset($_POST['italian'])&& $_POST['italian']==$row['italian']){
//                                $selected = 'selected';
//                            } else {
//                               $selected=''; 
//                            }
                        echo'<option value="' . $row['wordId'] . '">' . $italian . '</option>';
                    }
                    ?>
                </select>             
            </div>
        </form>
        <!--</div>-->
        <?php
    }

    public function selectWordCategory() {
        $wordCategoryList = new DbHandler();
        ?>
        <div class="form-group">         
            <label for="categoryId">Κατηγορία:</label>  
            <select class="form-control" id="categoryId" name="categoryId">             
                <?php
                $result = $wordCategoryList->getWordCategories();
                echo '<option></option>';
                while ($row = $result->fetch_assoc()) {
                    echo'<option value="' . $row['categoryId'] . '">' . $row['categoryName'] . '</option>';
                }
                ?>
            </select>             
        </div>
        <?php
    }

    public function selectWordType($type) {
        $wordCategoryList = new DbHandler();
        ?>
        <div class="form-group">         
            <label for="type">Τύπος:</label>  
            <select class="form-control" id="categoryId" name="type">             
                <?php
                $result = $wordCategoryList->getTypes();
                echo '<option></option>';
                while ($row = $result->fetch_assoc()) {
                    if ($row['type'] == $type) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    echo'<option value="' . $row['type'] . '" ' . $selected . '>' . $row['type'] . '</option>';
                }
                ?>
            </select>             
        </div>
        <?php
    }

    public function selectWordTypeAutofocus($type) {
        $wordCategoryList = new DbHandler();
        ?>
        <div class="form-group">         
            <label for="type">Τύπος:</label>  
            <select class="form-control" id="categoryId" name="type" autofocus="">             
                <?php
                $result = $wordCategoryList->getTypes();
                echo '<option></option>';
                while ($row = $result->fetch_assoc()) {
                    if ($row['type'] == $type) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    echo'<option value="' . $row['type'] . '" ' . $selected . '>' . $row['type'] . '</option>';
                }
                ?>
            </select>             
        </div>
        <?php
    }

    public function selectWordCategoryNotRequired($categoryId) {
        $wordCategoryList = new DbHandler();
        ?>
        <div class="form-group">         
            <label for="categoryId">Κατηγορία:</label>  
            <select class="form-control" id="categoryId" name="categoryId">             
                <?php
                $result = $wordCategoryList->getWordCategories();
//                $categoryId = $row['categoryId'];
                echo '<option></option>';
                while ($row = $result->fetch_assoc()) {
                    if ($row['categoryId'] == $categoryId) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    echo'<option value="' . $row['categoryId'] . '" ' . $selected . ' >' . $row['categoryName'] . '</option>';
                }
                ?>
            </select>             
        </div>
        <?php
    }

    public function loginForm() {
        ?>    
        <div class="container">
            <form action="authenticate.php" class="needs-validation" novalidate method="post">
                <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>            
                <button type="submit" class="btn btn-success" name="login">Submit</button>
            </form>
        </div>        
        <?php
        $this->addFormValidation();
    }

    public function addFormValidation() {
        ?>
        <script>
            // Disable form submissions if there are invalid fields
            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Get the forms we want to add validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script> 
        <?php
    }

}
