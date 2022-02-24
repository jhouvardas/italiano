
<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!$_SESSION['loggedin']) {
    //echo 'pisoooo';
    header('Location: login.php');
    exit;
}

function __autoload($name) {
    include_once $name . '.php';
}

$page = new PageMaker();
$form = new FormMaker;
$db = new DbHandler();
$page->displayHeadMatter();
?>
<div class="container-fluid">
    <div class="row">  
        <div class="col">
            <?php
            $page->displayMenu();
            ?>
        </div>
    </div>  
    <div class="row"> 
        <div class="col">
            <?php
            switch (@$_REQUEST['action']) {
                case 'newWord':
                    if (isset($_POST['submitWord'])) {
                        $exists = $db->checkIfWordExists();
                        if ($exists == false) {
                            $db->addWord();
                        } else {
                            echo '<div class="containter">';
                            echo '<b>Η λέξη υπάρχει ήδη στο λεξικό</b>';
                            echo '</div>';
                        }
                    }
                    $form->addWordForm();
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'newWord2':
                    $form->selectType();
                    if (isset($_POST['getWordForm'])) {
                        switch ($_POST['type']) {
                            case 'noun':
                                if (isset($_POST['submitWord'])) {
                                    $exists = $db->checkIfWordExists();
                                    if ($exists == false) {
                                        $db->addWord();
                                    } else {
                                        echo '<div class="containter">';
                                        echo '<b>Η λέξη υπάρχει ήδη στο λεξικό</b>';
                                        echo '</div>';
                                    }
                                } elseif ($_POST['type'] == 'noun') {
                                    $form->addWordForm();
                                }
                                break;
                            case 'verb':
                                if (isset($_POST['submitVerb'])) {
                                    $exists = $db->checkIfWordExists();
                                    if ($exists == false) {
                                        $db->addVerb();
                                    } else {
                                        echo '<div class="containter">';
                                        echo '<b>Η λέξη υπάρχει ήδη στο λεξικό</b>';
                                        echo '</div>';
                                    }
                                }
                                $form->addVerbForm();
                                break;
                        }
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'newWordCategory':
                    if (isset($_POST['submitNewWordCategory'])) {

                        $db->addWordCategory();
                    }
                    $form->addWordCategory();
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'editWord':
                    $form->findWordForm();
                    if (isset($_POST['findWord'])) {
                        $wordResource = $db->findWord();
                        $form->showWordsForEditForm($wordResource);
                    }
                    if (isset($_POST['editWord'])) {
                        
                        $form->editWordForm();
                    }
                    if (isset($_POST['updateWord'])) {
                        $db->updateWord();
                    }elseif (isset($_POST['deleteWord'])) {
                        $db->deleteWord();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'editSentence':
                    $form->selectSentence();
                    if (isset($_POST['wordId']) && !isset($_POST['updateSentence'])) {
                        $form->editSentenceForm();
                    }
                    if (isset($_POST['updateSentence'])) {
                        $db->updateSentence();
                    } elseif (isset($_POST['deleteSentence'])) {
                        $db->deleteWord();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'newVerb':
                    if (isset($_POST['submitVerb'])) {
                        $db->addVerb();
                    }
                        $form->addVerbForm();                    
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'newConiugazione':
                    $form->selectVerb();
                    if (isset($_POST['wordId'])) {
                        $form->addVerbConiugazione($_POST['wordId']);
                    }
                    if (isset($_POST['submitConiugazione'])) {
                        $db->addVerbConiugazione();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'newNote':
                    $form->addNoteForm();
                    if(isset($_POST['submitNote'])){
                        $db->addNote();
                    }
                    
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'showNotes':                    
                        $form->getNotesForm();                   
                    if (isset($_POST['getNotes'])) {
                        $notesResource = $db->getNotes();
                        $page->displayNotes($notesResource);
//                        echo '<a href="index.php?action=studentLessons" class="btn btn-dark btn-block" type="button">Νέα αναζήτηση</a>';
                    }
                    break;
                case 'editNote':
                    $form->getNotesForm();
                    if (isset($_POST['getNotes'])) {
                        $notesResource = $db->getNotes();
                        $form->displayEditDeleteNotes($notesResource);
                    }
                    if (isset($_POST['editOneNote'])) {
                        $oneNoteResource = $db->getNote($_POST['noteId']);
                        $form->editNoteForm($oneNoteResource);
                    } elseif (isset($_POST['updateNote'])) {
                        $db->updateNote();
                    } else if (isset($_POST['deleteNote'])) {
                        $db->deleteNote();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'showConiugazione':
                    $form->selectVerb();
                    if (isset($_POST['wordId'])) {
                        $coniugazioneResource = $db->getVerbConiugazione();
                        $page->displayConiugazione($coniugazioneResource);
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;

                case 'newSentence':
                    if (isset($_POST['submitSentence'])) {
                        $db->addSentence();
                    }
                    $form->addSentenceForm();
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'showDictionary':
                    if (isset($_POST['displayDictionary'])) {
                        $dictionaryResource = $db->getWords();
                        $page->displayDictionary($dictionaryResource);
                    } else {
                        $form->showDictionaryForm();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'findWord':
                    $form->findWordForm();
                    if (isset($_POST['findWord'])) {
                        $wordResource = $db->findWord();
                        $page->displayWord($wordResource);
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'testGreekItalian':
                    if (isset($_POST['startTest'])) {
                        $dictionaryResource = $db->getWordsForTest();
                        $page->testGreekItalian02($dictionaryResource);
                    } else {
                        $form->testForm();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'test':
                    $test = "l'";
                    echo $test;
                    $test = str_replace("'", "''", $test);
                    echo $test;
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
                case 'testItalianGreek':
                    if (isset($_POST['startTest'])) {
                        $dictionaryResource = $db->getWordsForTest();
                        $page->testItalianGreek02($dictionaryResource);
                    } else {
                        $form->testForm();
                    }
                    ?>
                    <script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>
                    <?php
                    break;
            }
            ?>
        </div>
    </div> 
    <div class="row">  
        <div class="col">
            <?php
            // $page->displayMenu();
            ?>
        </div>
    </div>  
</div>

<?php
$page->displayEndMatter();

