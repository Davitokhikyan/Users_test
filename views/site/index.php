<?php

/* @var $this yii\web\View */

$this->title = 'Users';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Balance</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) { ?>
              <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->balance ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>

    </div>
</div>
