<div class="container">
    <h3 class="text-center">Account Details</h3>
    <p hidden><?= $locals['account']->getId() ?></p>
    <p class="row mb-1 text-left d-flex justify-content-center"><span class="col-2">Username :</span><span class="col-3"><?= $locals['account']->getUsername() ?></span></p>
    <p class="row mb-1 text-left d-flex justify-content-center"><span class="col-2">Email : </span><span class="col-3"><?= $locals['account']->getEmail() ?></span></p>
    <p class="row mb-1 text-left d-flex justify-content-center"><span class="col-2">Nickname : </span><span class="col-3"><?= $locals['client']->getNickname() ?></span></p>
    <p class="row mb-1 text-left d-flex justify-content-center"><span class="col-2">Register Date : </span><span class="col-3"><?= $locals['client']->getRegisterdate() ?></span></p>
</div>