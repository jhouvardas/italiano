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
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
                <link rel="stylesheet" href="myCSS.css">
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

                <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Italiano</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="mynavbar">
                            <ul class="navbar-nav me-auto">                            
                                <!--                            <li class="nav-item">
                                                                <a class="nav-link" href="index.php?action=showDictionary">Λεξικό</a>
                                                            </li>-->
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=findWord"><?php echo _SEARCHWORD ?></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="index.php?action=debit" role="button" data-bs-toggle="dropdown">
                                        <?php echo _TEST ?>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?action=testGreekItalian"><?php echo _YOURLANGUAGEITALIAN ?></a>   
                                        <a class="dropdown-item" href="index.php?action=testItalianGreek"><?php echo _ITALIANYOURLANGUAGE ?></a>
                                        <!--<a class="dropdown-item" href="index.php?action=showConiugazione">Κλίσεις ρημάτων</a>-->                                   
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=showConiugazione"><?php echo _VERBCONJUGATIONS ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=showNotes"><?php echo _NOTES ?></a>
                                </li>
                                <?php if ($_SESSION['name'] == 'jhouv' || $_SESSION['name'] == 'vagelitsa') { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="index.php?action=debit" role="button" data-bs-toggle="dropdown">
                                            <?php echo _CONTENTMANAGEMENT ?>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="index.php?action=newWord"><?php echo _ADDWORD ?></a>   
                                            <a class="dropdown-item" href="index.php?action=editWord"><?php echo _EDITWORD ?></a>
                                            <a class="dropdown-item" href="index.php?action=newVerb"><?php echo _ADDVERB ?></a>
                                            <a class="dropdown-item" href="index.php?action=newConiugazione"><?php echo _ADDVERBCONJUGATION ?></a>
                                            <a class="dropdown-item" href="index.php?action=newSentence"><?php echo _ADDSENTENCE ?></a>
                                            <a class="dropdown-item" href="index.php?action=editSentence"><?php echo _EDITSENTENCE ?></a>
                                            <a class="dropdown-item" href="index.php?action=newWordCategory"><?php echo _ADDWORDCATEGORY ?></a>
                                            <a class="dropdown-item" href="index.php?action=newNote"><?php echo _ADDNOTE ?></a>
                                            <a class="dropdown-item" href="index.php?action=editNote"><?php echo _EDITNOTE ?></a>
                                        </div>
                                    </li>
                                <?php } ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="index.php?action=debit" role="button" data-bs-toggle="dropdown">
                                        <?php echo _LANGUAGE ?>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="index.php?lang=langEl"><?php echo _LANGEL ?></a>   
                                        <a class="dropdown-item" href="index.php?lang=langEn"><?php echo _LANGEN ?></a>
                                        <!--<a class="dropdown-item" href="index.php?action=showConiugazione">Κλίσεις ρημάτων</a>-->                                   
                                    </div>
                                </li>
                            </ul>
                        </div>  
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
