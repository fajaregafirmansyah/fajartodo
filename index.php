<?php
    require_once "config/config.php";

    spl_autoload_register(function($className){
        require_once 'todo/model/' . $className . '.php';
    });

    function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }

    if (isset($_COOKIE["user_info"])) {
        $user_info = $_COOKIE["user_info"];
        
        list($user_id, $username, $name) = explode("|", $user_info);
    
        header("Location: ".URLROOT."/todo");
    } else {
        session_start();
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    }

    if (!empty($_SERVER['REQUEST_URI']) && strlen($_SERVER['REQUEST_URI']) > 1) {
        $url = getUrl();

        if (is_dir($url[0])) {
            
            if (@file_exists("/$url[0]/$url[1]")) {
                echo "File Exists";

                print_r($url); die;
            } else {
                header("Location: ".URLROOT."/404");
            }
        } else {
            header("Location: ".URLROOT."/404");
        }
    }

    
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <title>Todo Apps</title>
        <!-- Meta tags -->
        <meta content="Belajar HTML CSS" name="description" />
        <meta content="HTML CSS" name="keywords" />
        <!-- Icon Web -->
        <link rel="icon" href="<?= URLROOT ?>/asset/favicon/icons8-star-papercut-16.png" sizes="16x16" type="image/png">
        <link rel="icon" href="<?= URLROOT ?>/asset/favicon/icons8-star-papercut-32.png" sizes="32x32" type="image/png">
        <!-- External Dependency here -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM+Serif+Text">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display">
        <link rel="stylesheet" href="<?= URLROOT ?>/css/main.css">
        <!-- Js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>

        <!-- Modal Login -->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLoginTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= URLROOT ?>/todo/user">

                    <div class="modal-body">
                    <div class="form-outline mb-4">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? ''?>" class="form-control" />
                        <input type="hidden" name="code" value="login" class="form-control" />
                        <input type="text" id="loginName" name="username" class="form-control" />
                        <label class="form-label" for="loginName">Email or username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="loginPassword" name="password" class="form-control" />
                        <label class="form-label" for="loginPassword">Password</label>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
        <!-- Modal Login End Here -->

        <!-- Modal Login -->
        <div class="modal fade" id="modalSignup" tabindex="-1" role="dialog" aria-labelledby="modalSignUpTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSignUpTitle">Sign Up Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?= URLROOT ?>/todo/user">

                    <div class="modal-body">
                         <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? ''?>" class="form-control" />
                            <input type="hidden" name="code" value="register" class="form-control" />
                            <input type="text" id="registerName" name="name" class="form-control" />
                            <label class="form-label" for="registerName">Name</label>
                        </div>

                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="registerUsername" name="username" class="form-control" />
                            <label class="form-label" for="registerUsername">Username</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="registerEmail" name="email" class="form-control" />
                            <label class="form-label" for="registerEmail">Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="registerPassword" name="password" class="form-control" />
                            <label class="form-label" for="registerPassword">Password</label>
                        </div>

                        <!-- Repeat Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="registerRepeatPassword" name="repeat_password" class="form-control" />
                            <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
        <!-- Modal Login End Here -->

        <footer>
            <div class="container mb-5">
    
            </div>
            <div class="copyright mt-7">
                <div class="container">
                    <div class="row">
                        <p>Copyright 2023 Fajar Ega Firmansyah &copy;. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    <script>
        $(document).ready(function() {

        });
    </script>
</html>