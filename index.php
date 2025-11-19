
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TLUK Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <style>
        body {
            background: #f8f6f2;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
           background-image: 
        linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)),
        url('assets/images/OR7TU70-removebg-preview.png');
            background-size: cover;
            background-position: center;
            ackground-repeat: no-repeat;      /* Avoid repetition */

    background-position: center center;/* Exactly centered */
    background-attachment: fixed;      /* Smooth scroll + depth */
            /* From https://css.glass */

        }

        .login-container {
            width: 900px;
            background: #ffffff;
            border-radius: 25px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.2);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .left-panel {
            width: 45%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .left-panel img {
            width: 100%;
            filter: drop-shadow(0 0 12px rgba(0, 0, 0, 0.15));
            
        }

        /* SHORT Vertical Divider */
        .divider {
            width: 2px;
            background: #e6e1d8;
            height: 80%;      /* SHORTER HEIGHT */
            margin: auto 0;   /* CENTER VERTICALLY */
        }

        .right-panel {
            width: 55%;
            padding: 60px 50px;
        }

        .heading {
            font-size: 30px;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        .sub-heading {
            text-align: center;
            color: #777;
            margin-bottom: 35px;
            font-size: 15px;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 2px solid #e6e1d8;
            padding-left: 15px;
        }

        .form-control:focus {
            border-color: #d4a05f;
            box-shadow: 0 0 0 0.1rem rgba(212, 160, 95, 0.3);
        }

        .btn-login {
            width: 100%;
            height: 50px;
            background: #834692;
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-3px);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-text {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            color: #b88646;
            cursor: pointer;
            font-weight: 600;
        }

        @media(max-width: 850px) {
            .login-container {
                flex-direction: column;
                width: 90%;
            }

            .divider {
                display: none;
            }

            .left-panel,
            .right-panel {
                width: 100%;
                padding: 40px 30px;
            }

            .left-panel img {
                width: 130px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="left-panel d-none d-md-flex">
            <img src="assets/logoicon.png" alt="TLUK Logo">
        </div>

        <!-- SHORT Vertical Divider -->
        <div class="divider d-none d-md-block"></div>

        <div class="right-panel">

            <div class="heading text-center">Welcome Back</div>
          
            <input type="email" id="username" class="form-control mb-3" placeholder="Email Address">

            <!-- PASSWORD FIELD WITH SHOW/HIDE -->
            <div class="password-wrapper mb-3">
                <input type="password" id="password" class="form-control" placeholder="Password">
                <span class="toggle-text" onclick="togglePassword()">Show</span>
            </div>

            <button class="btn-login" onclick="loginval()">Login</button>

        </div>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="js/login.js"></script>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const toggle = document.querySelector(".toggle-text");

            if (password.type === "password") {
                password.type = "text";
                toggle.textContent = "Hide";
            } else {
                password.type = "password";
                toggle.textContent = "Show";
            }
        }
    </script>

</body>

</html>
