<div class="container">
    <h3>Client List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Nickname</th>
                <th>Register Date</th>
                <th>Show Account</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($locals['clients'] as $client) { ?>
                <tr class='bg-light'>
                    <td><?= $client->getClientId() ?></td>
                    <td><?= $client->getNickname() ?></td>
                    <td><?= $client->getRegisterdate() ?></td>
                    <td><a href='<?= BASE_DIR ?>/accountedit/<?= $client->getClientId() ?>'>Show Details</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>