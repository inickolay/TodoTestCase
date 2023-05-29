<div class="row justify-content-center text-center">
    <form class="col-lg-4 just" method="post" action="/auth">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>


        <div class="form-floating">
            <input class="form-control" id="login" placeholder="Login" name="login" required>
            <label for="floatingInput">Login</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
</div>