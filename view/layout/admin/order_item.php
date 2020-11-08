<li class="order-item page-order__item js-order">
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--id">
          <span class="order-item__title">Номер заказа</span>
          <span class="order-item__info order-item__info--id js-order__id"><?=$item['order_id']?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Сумма заказа</span>
          <?=$item['price']?> руб.
        </div>
        <button class="order-item__toggle"></button>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--margin">
          <span class="order-item__title">Заказчик</span>
          <span class="order-item__info"><?=$item['surname'] . " " . $item['name'] . " " . $item['patronymic']?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Номер телефона</span>
          <span class="order-item__info"><?=$item['phone']?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Способ доставки</span>
          <span class="order-item__info"><?= ($item['delivery'] == 'dev-yes')?"Курьер":"Самовывоз" ?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Способ оплаты</span>
          <span class="order-item__info"><?= ($item['payment'] == 'cash')?"Наличными":"Картой" ?></span>
        </div>
        <div class="order-item__group order-item__group--status">
          <span class="order-item__title">Статус заказа</span>
          <span class="order-item__info <?= ($item['status'] == 'new')?"order-item__info--no":"order-item__info--yes" ?>"><?= ($item['status'] == 'new')?"Не выполнено":"Выполнено" ?></span>
          <button class="order-item__btn js-order__btn">Изменить</button>
        </div>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Адрес доставки</span>
          <span class="order-item__info"><?= ($item['delivery'] == 'dev-yes')
          ?"г.". $item['city'] .", ул.". $item['street'] .", д.". $item['home'] .", кв. " . $item['aprt']
          :"г. Москва, ул. Пушкина, д.5, кв. 233" ?></span>
        </div>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Комментарий к заказу</span>
          <span class="order-item__info"><?=$item['comment']?></span>
        </div>
      </div>
    </li>