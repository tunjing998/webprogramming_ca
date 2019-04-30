<div class="container">
    <h3 class="text-center">Account Details</h3>
    <div class="row justify-content-center">
        <div class="border border-secondary col-6">
            <p class="mb-0">ID: <?= $locals['account']->getId() ?></p>
            <p class="mb-1">Username:<?= $locals['account']->getUsername() ?></p>
            <form action='<?= BASE_DIR ?>/accountedit/<?= $locals['account']->getId() ?>' method='post'>
                <input type='hidden' name='id' value=<?= $locals['account']->getId() ?>>
                <!-- <div class="text-center"> -->
                <label class="" for="nickname">Account Nickname:</label>
                <input class="" name='nickname' value=<?= $locals['client']->getNickname() ?>><br>
                <!-- </div> -->
                <p class="mb-0">Email: <?= $locals['account']->getEmail() ?></p>
                <p class="mb-1">Register Date: <?= $locals['client']->getRegisterdate() ?></p>
                <div class="text-center">
                    <input class="d-inline-block" type="submit" value='Submit'>
                    <a class="d-block" href="#">Reset Password</a>
                </div>
            </form>

        </div>
    </div>
</div>