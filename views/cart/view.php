<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container">

    <?php if(!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><a href="<?= Url::to(['product/view', 'id'=>$id]) ?>"><?= \yii\helpers\Html::img("@web/images/products/{$item['img']}", [alt=>$item['name'], 'height' =>'50px'])  ?></a></td>
                        <td><a href="<?= Url::to(['product/view', 'id'=>$id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty']*$item['price'] ?></td>
                        <td><span data-id="<?=$id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <? endforeach; ?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php $form = ActiveForm::begin();?>
    <?php echo $form->field($order, 'name'); ?>
    <?php echo $form->field($order, 'email'); ?>
    <?php echo $form->field($order, 'phone'); ?>
    <?php echo $form->field($order, 'address'); ?>
    <?php echo Html::submitButton('Заказать', ['class' => 'btn btn-success']); ?>
    <?php ActiveForm::end();?>
    <? else: ?>
        <h3>Корзина пуста</h3>
    <? endif; ?>

</div>
