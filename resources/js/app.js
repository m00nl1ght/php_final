'use strict';

const checkboxAllElem = document.querySelectorAll('input[type=checkbox]');
const filterFormElem = document.querySelector('.js-filter__form'); //форма фильтра
const shopWrapperElem = document.querySelector('.js-shop__wrapper'); //центральная колонка
const shopListElem = document.querySelector('.js-shop__list');

//чекбоксы - смена статуса
for (let checkBox of checkboxAllElem) {
    checkBox.addEventListener('click', (elem) => elem.target.toggleAttribute('checked') );
}

//сабмит фильтра
const filterCategoryElem = document.querySelectorAll('.js-filter__category');
const checkboxNewElem = document.querySelector('#new');
const checkboxSaleElem = document.querySelector('#sale');
const minPriceElem = document.querySelector('.js-min__price');
const maxPriceElem = document.querySelector('.js-max__price');

filterFormElem.addEventListener('submit', (e) => {
    e.preventDefault();
    
    let filterCategory = '';
    
    filterCategoryElem.forEach((elem) => {
        if(elem.classList.contains('active')){
            filterCategory = elem.getAttribute('href');
        }
    });

    let data = {
        filterCategoryUrl: filterCategory,
        filterNew: checkboxNewElem.hasAttribute('checked'),
        filterSale: checkboxSaleElem.hasAttribute('checked'),
        filterMin: minPriceElem.textContent,
        filterMax: maxPriceElem.textContent
    }

    sendData(data).then((response) => {
        insertContent(shopWrapperElem, response);
    });
});

//отправка в контроллер
let sendData = async function(data) {
    let response = await fetch('/controllers/index.php', {
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

//вставка контента
let insertContent = function (parent, content) {
    while(parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }

    parent.innerHTML = content;
}

//фильтр компановки
const sortCategoryElem = document.querySelector('.js-sort-category');
const sortPriceElem = document.querySelector('.js-sort-prices');

sortCategoryElem.addEventListener('change', () => {
    checkSortField();
});

sortPriceElem.addEventListener('change', () => {
    checkSortField();
});

let checkSortField = function() {
    let sortCategory = sortCategoryElem.options[sortCategoryElem.selectedIndex].value;
    let sortPrice = sortPriceElem.options[sortPriceElem.selectedIndex].value;
    
    if(sortCategory !== "" && sortPrice !== "") {
        sortFunc();
        console.log('поехали');
    }
}

let sortFunc = function() {
    let filterCategory = '';
    
    filterCategoryElem.forEach((elem) => {
        if(elem.classList.contains('active')){
            filterCategory = elem.getAttribute('href');
        }
    });

    let data = {
        filterCategoryUrl: filterCategory,
        filterNew: checkboxNewElem.hasAttribute('checked'),
        filterSale: checkboxSaleElem.hasAttribute('checked'),
        filterMin: minPriceElem.textContent,
        filterMax: maxPriceElem.textContent,
        sortCategory: sortCategoryElem.options[sortCategoryElem.selectedIndex].value,
        sortPrice: sortPriceElem.options[sortPriceElem.selectedIndex].value
    }

    sendData(data).then((response) => {
        insertContent(shopListElem, response);
    });
}