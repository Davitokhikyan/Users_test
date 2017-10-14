<?php

/* @var $this yii\web\View */

$this->title = 'History';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Sender</th>
                <th>Reciever</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($transfers as $transfer) { ?>
              <tr>
                <td><?= $transfer->id ?></td>
                <td><?= $transfer->sender->username ?></td>
                <td><?= $transfer->reciever->username ?></td>
                <td><?= $transfer->amount ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>

    </div>
</div>
