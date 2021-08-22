<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJ Freeway | Signup</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signup {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signup .logo {
            max-width: 13rem;
        }

        .form-signup .form-floating:focus-within {
            z-index: 2;
        }

        .form-signup input[name="name"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signup input[type="email"] {
            margin-bottom: -1px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signup input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
    <main class="form-signup">

        <img class="mb-4 logo" src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://mjplatform.com/wp-content/uploads/2020/12/mjfreeway_logolockup_pos_HOR.png" data-src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img/https://mjplatform.com/wp-content/uploads/2020/12/mjfreeway_logolockup_pos_HOR.png" alt="MJ Freeway">

        <form action="{{ url('signup') }}" method="post">
            @csrf

            <!-- <label for="name">Name</label>
        <!-- <label for="name">Name</label>
        <input type="text" name="name" id="name"> -->

            <div class="form-floating">
                <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Name">
                <label for="floatingInput">Name</label>
            </div>

            <!-- <label for="email">Email</label>
        <input type="text" name="email" id="email"> -->
            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="Email">
                <label for="floatingInput">Email address</label>
            </div>

            <!-- <label for="password">Password</label>
        <input type="password" name="password" id="password"> -->
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <!-- <button type="submit">Signup</button> -->
            <button class="w-100 btn btn-lg btn-warning" type="submit">Sign up</button>

            <a href="{{ route('login') }}">Back to login</a>
        </form>
        </div>

</body>

</html>