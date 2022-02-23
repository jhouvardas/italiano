<?php
require_once 'DbHandler.php';
$db = new DbHandler();

class PageMaker {

    public function displayHeadMatter() {
        ?>
        <!DOCTYPE html>
        <html lang="el">
            <head>
                <title>Italiano</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="myCSS.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <link rel="icon" href="images/favicon.jpg" sizes="16x16" type="image/jpg">
                <script src="https://cdn.tiny.cloud/1/00egprfeg5a0fti37lygyyjkx7k4qrv5y3mm1d208ebhi99j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: 'textarea',
                        force_br_newlines: true,
                        force_p_newlines: false,
                        forced_root_block: '',
                        entity_encoding: "raw",
                        height: "260",
                        init_instance_callback: function (editor) {
                            var freeTiny = document.querySelector('.tox .tox-notification--in');
                            freeTiny.style.display = 'none';
                        }
                    });
                </script>
                <script src="myJavaScripts.js.js"></script>                
            </head>
            <?php
            session_start();

// Set Language variable
            if (isset($_GET['lang']) && !empty($_GET['lang'])) {
                $_SESSION['lang'] = $_GET['lang'];

                if (isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {
                    echo "<script type='text/javascript'> location.reload(); </script>";
                }
            }

// Include Language file
            if (isset($_SESSION['lang'])) {
                include $_SESSION['lang'] . ".php";
            } else {
                include "langEn.php";
            }
            ?>
            <body class="bg-light text-dark">
                <?php
            }

            public function displayMenu() {
                ?>
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a class="navbar-brand" href="#">Italiano</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">                            
                            <!--                            <li class="nav-item">
                                                            <a class="nav-link" href="index.php?action=showDictionary">Λεξικό</a>
                                                        </li>-->
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=findWord"><?=_SEARCHWORD ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="index.php?action=debit" id="navbardrop" data-toggle="dropdown">
                                    Τεστ
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="index.php?action=testGreekItalian">Ελληνικά - Ιταλικά</a>   
                                    <a class="dropdown-item" href="index.php?action=testItalianGreek">Ιταλικά - Ελληνικά</a>
                                    <!--<a class="dropdown-item" href="index.php?action=showConiugazione">Κλίσεις ρημάτων</a>-->                                   
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=showConiugazione">Κλίσεις ρημάτων</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=showNotes">Σημειώσεις</a>
                            </li>
                            <?php if ($_SESSION['name'] == 'jhouv' || $_SESSION['name'] == 'vagelitsa') { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="index.php?action=debit" id="navbardrop" data-toggle="dropdown">
                                        Διαχείριση
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?action=newWord">Εισαγωγή λέξης</a>   
                                        <a class="dropdown-item" href="index.php?action=editWord">Διόρθωση λέξης</a>
                                        <a class="dropdown-item" href="index.php?action=newVerb">Εισαγωγή ρήματος</a>
                                        <a class="dropdown-item" href="index.php?action=newConiugazione">Εισαγωγή κλίσης ρήματος</a>
                                        <a class="dropdown-item" href="index.php?action=newSentence">Εισαγωγή πρότασης</a>
                                        <a class="dropdown-item" href="index.php?action=editSentence">Διόρθωση πρότασης</a>
                                        <a class="dropdown-item" href="index.php?action=newWordCategory">Νέα κατηγορία λέξεων</a>
                                        <a class="dropdown-item" href="index.php?action=newNote">Νέα Σημείωση</a>
                                        <a class="dropdown-item" href="index.php?action=editNote">Διόρθωση Σημείωσης</a>
                                    </div>
                                </li>
                            <?php } ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="index.php?action=debit" id="navbardrop" data-toggle="dropdown">
                                    Γλώσσα
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="index.php?lang=langEl">Ελληνικά</a>   
                                    <a class="dropdown-item" href="index.php?lang=langEn">Αγγλικά</a>
                                    <!--<a class="dropdown-item" href="index.php?action=showConiugazione">Κλίσεις ρημάτων</a>-->                                   
                                </div>
                            </li>
                        </ul>
                    </div>  
                </nav>
                <?php
            }

            public function displayDictionary($dictionaryResource) {
                ?>
                <div class="table-responsive-sm">
                    <table class="table table-bordered">

                        <tbody>
                            <?php
                            while ($row = $dictionaryResource->fetch_assoc()) {
                                echo '<tr>';
                                $articoloD = '';
                                if (isset($_POST['articoloD'])) {
                                    $articoloD = $row['articoloD'] . ' ';
                                }
                                if (isset($_POST['italian'])) {
                                    echo '<td>' . $articoloD . $row['italian'] . '</td>';
                                }

                                if (isset($_POST['greek'])) {
                                    echo '<td>' . $row['greek'] . '</td>';
                                }
                                $gender = '';
                                if (isset($_POST['gender'])) {
                                    echo '<td>' . $row['gender'] . '</td>';
                                }
                                $plural = $_POST['plural'];
                                if (isset($plural) && isset($_POST['italian'])) {
                                    $articoloDP = '';
                                    if (isset($_POST['articoloDP'])) {
                                        $articoloDP = $row['articoloDP'] . ' ';
                                    }
                                    echo '<td>' . $articoloDP . $row['plural'] . '</td>';
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }

            public function testGreekItalian02($dictionaryResource) {
                ?>
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = $dictionaryResource->fetch_assoc()) {
                                echo '<tr>';
                                $greek = $row['greek'];
                                $italian = $row['italian'];
                                ?>
                            <td><?php echo $i; ?></td><td onclick="document.getElementById('greektr<?php echo $i; ?>').innerHTML = '<?php echo $italian; ?>'"><?php echo $greek; ?></td><td onclick="this.innerHTML = ''" id="greektr<?php echo $i; ?>"></td>
                            <?php
                            $i = $i + 1;
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <?php
            }

            public function testItalianGreek02($dictionaryResource) {
                ?>
                <div class="table-responsive-sm">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = $dictionaryResource->fetch_assoc()) {
                                echo '<tr>';
                                $greek = $row['greek'];
                                $italian = $row['italian'];
                                ?>
                            <td><?php echo $i; ?></td><td onclick="document.getElementById('greektr<?php echo $i; ?>').innerHTML = '<?php echo $greek; ?>'"><?php echo $italian; ?></td><td onclick="this.innerHTML = ''" id="greektr<?php echo $i; ?>"></td>
                            <?php
                            $i = $i + 1;
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }

            public function displayWord($wordResource) {
                ?>
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Italiano</th>
                                    <th>Greco</th>
                                    <th></th>
                                    <th>Plurale</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = $wordResource->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['articoloD'] . '</td>';
                                    echo '<td>' . $row['italian'] . '</td>';
                                    echo '<td>' . $row['greek'] . '</td>';
                                    echo '<td>' . $row['articoloDP'] . '</td>';
                                    echo '<td>' . $row['plural'] . '</td>';
                                    echo '<td>' . $row['gender'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }

            public function displayConiugazione($coniugazioneResource) {
                ?>
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered">                            
                            <tbody>
                                <?php
                                while ($row = $coniugazioneResource->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td> <b>' . $row['type'] . '</b>' . '  ' . '<b>' . $row['tense'] . '</b></td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<td>' . $row['coniugazione'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }

            public function displayNotes($notesResource) {
                ?>
                <div class="container">
                    <div class="table-responsive-sm">
                        <table class="table table-bordered">
                            <?php
                            $i = 1;
                            while ($row = $notesResource->fetch_assoc()) {
                                echo '<tbody>';
                                echo '<tr>';
                                $date = date_create($row['date']);
                                echo '<td>' . date_format($date, "D d/m/y") . '     <b>' . $row['lastName'] . '</b></td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td>' . $row['note'] . '</td>';
                                echo '</tr>';
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
//                }
            }

            public function displayEndMatter() {
                ?>
            </body>
        </html>
        <?php
    }

}
