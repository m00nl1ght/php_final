'use strict';

//функция отправки на сервер json
let sendToController = async function(data, url) {
  let response = await fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json;charset=utf-8'
      },
      body: JSON.stringify(data)
  });
        
  if(response.ok) {
      let result = await response.text();

      return result;
  };
}

//функция отправки на сервер формы
const ajaxSend = async (formData, url) => {
  const fetchResp = await fetch(url, {
      method: 'POST',
      body: formData
  });
  if (!fetchResp.ok) {
      throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
  }
  return await fetchResp.text();
};

const toggleHidden = (...fields) => {

  fields.forEach((field) => {

    if (field.hidden === true) {

      field.hidden = false;

    } else {

      field.hidden = true;

    }
  });
};

const labelHidden = (form) => {

  form.addEventListener('focusout', (evt) => {

    const field = evt.target;
    const label = field.nextElementSibling;

    if (field.tagName === 'INPUT' && field.value && label) {

      label.hidden = true;

    } else if (label) {

      label.hidden = false;

    }
  });
};

const toggleDelivery = (elem) => {

  const delivery = elem.querySelector('.js-radio');
  const deliveryYes = elem.querySelector('.shop-page__delivery--yes');
  const deliveryNo = elem.querySelector('.shop-page__delivery--no');
  const fields = deliveryYes.querySelectorAll('.custom-form__input');

  delivery.addEventListener('change', (evt) => {

    if (evt.target.id === 'dev-no') {

      fields.forEach(inp => {
        if (inp.required === true) {
          inp.required = false;
        }
      });


      toggleHidden(deliveryYes, deliveryNo);

      deliveryNo.classList.add('fade');
      setTimeout(() => {
        deliveryNo.classList.remove('fade');
      }, 1000);

    } else {

      fields.forEach(inp => {
        if (inp.required === false) {
          inp.required = true;
        }
      });

      toggleHidden(deliveryYes, deliveryNo);

      deliveryYes.classList.add('fade');
      setTimeout(() => {
        deliveryYes.classList.remove('fade');
      }, 1000);
    }
  });
};

const filterWrapper = document.querySelector('.filter__list');
if (filterWrapper) {

  filterWrapper.addEventListener('click', evt => {

    const filterList = filterWrapper.querySelectorAll('.filter__list-item');

    filterList.forEach(filter => {

      if (filter.classList.contains('active')) {

        filter.classList.remove('active');

      }

    });

    const filter = evt.target;

    filter.classList.add('active');

  });

}

const shopList = document.querySelector('.shop__list');
if (shopList) {

  shopList.addEventListener('click', (evt) => { //клик на товар -> переход к форме заказа (evt.target - карточка товара)

    const productPrice = evt.target.querySelector('.js-product__price').textContent;
    const prod = evt.path || (evt.composedPath && evt.composedPath());;

    if (prod.some(pathItem => pathItem.classList && pathItem.classList.contains('shop__item'))) {

      const shopOrder = document.querySelector('.shop-page__order');

      toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);

      window.scroll(0, 0);

      shopOrder.classList.add('fade');
      setTimeout(() => shopOrder.classList.remove('fade'), 1000);

      const form = shopOrder.querySelector('.custom-form');
      labelHidden(form);

      toggleDelivery(shopOrder);

      const buttonOrder = shopOrder.querySelector('.button');
      const popupEnd = document.querySelector('.shop-page__popup-end');

      buttonOrder.addEventListener('click', (evt) => { //кнопка сабмит формы

        form.noValidate = true;

        const inputs = Array.from(shopOrder.querySelectorAll('[required]'));

        inputs.forEach(inp => {

          if (!!inp.value) {

            if (inp.classList.contains('custom-form__input--error')) {
              inp.classList.remove('custom-form__input--error');
            }

          } else {

            inp.classList.add('custom-form__input--error');

          }
        });

        if (inputs.every(inp => !!inp.value)) { //сабмит формы заказа товара

          evt.preventDefault();

          let formData = new FormData(form);
          formData.append('price', productPrice);

          ajaxSend(formData, '/orders/store')
          .then((response) => {
            if (response == 'success') {
              toggleHidden(shopOrder, popupEnd);
              popupEnd.classList.add('fade');
              setTimeout(() => popupEnd.classList.remove('fade'), 1000);
              window.scroll(0, 0);
    
              const buttonEnd = popupEnd.querySelector('.button');
    
              buttonEnd.addEventListener('click', () => { //кнопка перехода Возвращеине к покупкам
                popupEnd.classList.add('fade-reverse');
    
                setTimeout(() => {
                  popupEnd.classList.remove('fade-reverse');
    
                  toggleHidden(popupEnd, document.querySelector('.intro'), document.querySelector('.shop')); 
                }, 1000);
              });
            } else {
              alert ('Что-то пошло не так, попробуйте еще раз!');
            }
          })
          .catch((err) => console.error(err));

        } else {
          window.scroll(0, 0);
          evt.preventDefault();
        }
      });
    }
  });
}

const pageOrderList = document.querySelector('.page-order__list');
if (pageOrderList) {

  pageOrderList.addEventListener('click', evt => {


    if (evt.target.classList && evt.target.classList.contains('order-item__toggle')) {
      var path = evt.path || (evt.composedPath && evt.composedPath());
      Array.from(path).forEach(element => {

        if (element.classList && element.classList.contains('page-order__item')) {

          element.classList.toggle('order-item--active');

        }

      });

      evt.target.classList.toggle('order-item__toggle--active');

    }

    if (evt.target.classList && evt.target.classList.contains('order-item__btn')) {

      const status = evt.target.previousElementSibling;

      let data = {
        'id': status.closest('.js-order').querySelector('.js-order__id').textContent,
        'status': status.classList.contains('order-item__info--no')?'completed':'new'
      };

      sendToController(data, '/admin/orders/status').then((response) => {
        if(response) {
          if (status.classList && status.classList.contains('order-item__info--no')) {
            status.textContent = 'Выполнено';
          } else {
            status.textContent = 'Не выполнено';
          }

          status.classList.toggle('order-item__info--no');
          status.classList.toggle('order-item__info--yes');
        }
      });
    }
  });

}

const checkList = (list, btn) => {

  if (list.children.length === 1) {

    btn.hidden = false;

  } else {
    btn.hidden = true;
  }

};

//форма добавления товара
const addList = document.querySelector('.add-list');
if (addList) {

  const form = document.querySelector('.custom-form');
  labelHidden(form);

  const addButton = addList.querySelector('.add-list__item--add');
  const addInput = addList.querySelector('#product-photo');

  checkList(addList, addButton);

  addInput.addEventListener('change', evt => {

    const template = document.createElement('LI');
    const img = document.createElement('IMG');

    template.className = 'add-list__item add-list__item--active';
    template.addEventListener('click', evt => {
      addList.removeChild(evt.target);
      addInput.value = '';
      checkList(addList, addButton);
    });

    const file = evt.target.files[0];
    const reader = new FileReader();

    reader.onload = (evt) => {
      img.src = evt.target.result;
      template.appendChild(img);
      addList.appendChild(template);
      checkList(addList, addButton);
    };

    reader.readAsDataURL(file);

  });

  const popupEnd = document.querySelector('.page-add__popup-end');

  form.addEventListener('submit', (evt) => {

    evt.preventDefault();

    const productIdElem = document.querySelector('#product-id');
    let serverUrl = '';

    if(productIdElem.value == '') {
      serverUrl = '/admin/products/store';
    } else {
      serverUrl = '/admin/products/update';
    }

    const formData = new FormData(evt.target);

    ajaxSend(formData, serverUrl)
      .then((response) => {
        if(response == 'success') {
          form.hidden = true;
          popupEnd.hidden = false;
          form.reset(); // очищаем поля формы 
        } else {
          alert(response);
        }
      })
      .catch((err) => console.error(err));
  });

}

//кнопка удаления товара
const productsList = document.querySelector('.page-products__list');
if (productsList) {

  productsList.addEventListener('click', evt => {

    const target = evt.target;

    if (target.classList && target.classList.contains('product-item__delete')) {

      let data = {
        'id': target.parentElement.querySelector('.js-product-id').textContent
      };

      sendToController(data, '/admin/products/destroy').then((response) => {
        if (response) {
          productsList.removeChild(target.parentElement);
        }
      });
    }
  });
}

// jquery range maxmin
if (document.querySelector('.shop-page')) {
  const minPriceElem = document.querySelector('.js-min__price');
  const maxPriceElem = document.querySelector('.js-max__price');

  $('.range__line').slider({
    min: Number(minPriceElem.textContent),
    max: Number(maxPriceElem.textContent),
    values: [minPriceElem.textContent, maxPriceElem.textContent],
    range: true,
    stop: function(event, ui) {

      $('.js-min__price').text($('.range__line').slider('values', 0));
      $('.js-max__price').text($('.range__line').slider('values', 1));

    },
    slide: function(event, ui) {

      $('.js-min__price').text($('.range__line').slider('values', 0));
      $('.js-max__price').text($('.range__line').slider('values', 1));

    }
  });

}
