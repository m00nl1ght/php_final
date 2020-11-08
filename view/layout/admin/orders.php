<main class="page-order">
  <h1 class="h h--1">Список заказов</h1>
  <ul class="page-order__list">
  <?php 
    if(isset($ordersNew)):
      foreach ($ordersNew as $item): 
        include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/order_item.php';
      endforeach; 
    endif;

    if(isset($ordersCompleted)):
      foreach ($ordersCompleted as $item): 
        include $_SERVER['DOCUMENT_ROOT'] . '/view/layout/admin/order_item.php';
      endforeach; 
    endif;
  ?>
  </ul>
</main>

