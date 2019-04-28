<div class="container">
    <h3>Account Details</h3>

    
    <p>UserName:<?= $locals['account']->getUsername() ?></p><br>
    
    <p>Email:<?= $locals['account']->getEmail() ?></p><br>
    <form action='<?= BASE_DIR ?>/accountedit/<?= $locals['account']->getId() ?>' method='post'>
        <input type='hidden' value=<?= $locals['account']->getId() ?>>
        <label for="nickname">Account Nickname:</label>
        <input value=<?= $locals['client']->getNickname() ?>><br>
        <p>RegisterDate:<?= $locals['client']->getRegisterdate() ?></p><br>
        <input type="submit" value='Submit'>
    </form>
    <a href="#">Reset Password</a>
</div>