<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Link</title>
</head>

<body>
    <p>Hello {{ $user->name }} </p>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p>Please click the following link to reset your password:</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent


    <p>If you did not request a password reset, no further action is required.</p>

    <p>Thank you!</p>
</body>

</html>
