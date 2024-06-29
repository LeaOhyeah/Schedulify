<!DOCTYPE html>
<html>

<head>
     <title>Reset Password</title>
</head>

<body>
     <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div>
               <label for="email">Email</label>
               <input type="email" name="email" id="email" required>
          </div>
          <div>
               <button type="submit">Send Password Reset Link</button>
          </div>
     </form>
</body>

</html>