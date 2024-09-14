import './bootstrap';

import {Grid} from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import {
    Aperture,
    BadgeEuro,
    createIcons,
    Eye,
    Film,
    MessageCircleQuestion,
    Minus,
    Pencil,
    Plus,
    Store,
    UserCog,
    Users,
    Menu,
    Clock,
    RefreshCw,
    Delete,
    Link,
    Heart,
    CopyPlus,
    FileClock
} from 'lucide';

createIcons({
    icons: {
        Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users, Pencil, Menu, Clock, Heart, RefreshCw, Delete, Link, FileClock, CopyPlus
    }
});

document.addEventListener("DOMContentLoaded", function() {

    function tableStatesListener(state, prevState) {
        if (prevState.status < state.status) {
            if (prevState.status === 2 && state.status === 3) {
                const triggers = document.querySelectorAll('.add-offer');
                triggers.forEach(el => el.addEventListener('click', event => {
                    document.getElementById("offer_shop").value = event.currentTarget.getAttribute("data-shop");
                    document.getElementById("offer_product").value = event.currentTarget.getAttribute("data-product");

                    document.getElementById("add_offer_modal").showModal();
                }));

                const triggerProducts = document.querySelectorAll('.add-products');
                triggerProducts.forEach(el => el.addEventListener('click', event => {
                    document.getElementById("shop_id").value = event.currentTarget.getAttribute("data-shop");
                    document.getElementById("add_products_modal").showModal();
                }));

                const triggersUsers = document.querySelectorAll('.edit-user-role');
                triggersUsers.forEach(el => el.addEventListener('click', event => {
                    document.getElementById("user_id").value = event.currentTarget.getAttribute("data-user");
                    document.getElementById("user_edit_modal").showModal();
                }));

                //edit products
                const triggersProducts = document.querySelectorAll('.edit-product');
                triggersProducts.forEach(el => el.addEventListener('click', event => {
                    let productId = event.currentTarget.getAttribute("data-id");
                    let productName = event.currentTarget.getAttribute("data-name");
                    let productBrandId = event.currentTarget.getAttribute("data-brand-id");

                    document.getElementById("edit-product-id").value = productId;
                    document.getElementById("edit-product-name").value = productName;

                    let elementBrand = document.getElementById("edit-product-brand");
                    elementBrand.selectedIndex = [...elementBrand.options].find(o => o.value === productBrandId).index;

                    for (let i = 1; i < 6; i++) {
                        let property = event.currentTarget.getAttribute("data-prop" + i);

                        let element = document.getElementById("edit-product-prop" + i);
                        if (element.tagName.toLowerCase() === 'input') {
                            element.value = property;
                        } else {
                            //element is a select
                            console.log(element.options);
                            element.selectedIndex = [...element.options].find(o => o.value === property || {}).index;
                        }
                    }
                    document.getElementById("my-drawer-4").checked = true;
                }));

                //delete offers
                const triggersOffers = document.querySelectorAll('.delete-offer');
                triggersOffers.forEach(el => el.addEventListener('click', event => {
                    document.getElementById("delete-offer-id").value = event.currentTarget.getAttribute("data-id");
                    document.getElementById("modal-delete-offer").showModal()
                }));

            }
        }
    }

    let sourceTable = document.getElementById('sourceTable');
    if( document.body.contains(sourceTable) ){
        const grid = new Grid({
            from: sourceTable,
            sort: true,
            search: true,
            fixedHeader: true,
            resizable: true,
            language: {
                'search': {
                    'placeholder': '🔍 Recherche...'
                }
            }
        });
        grid.config.store.subscribe(tableStatesListener);
        grid.render(document.getElementById('destinationWrapper'));
    }

    /*
     * Au clic sur add-product les champs du formulaire d'ajout/édition de produit sont réinitialisés et le drawer ouvert via la checkbox
     */
    let addProduct = document.getElementById('add-product');
    if( document.body.contains(addProduct) ) {
        addProduct.addEventListener("click", function () {
            document.getElementById("edit-product-id").value = '';
            document.getElementById("edit-product-name").value = '';
            document.getElementById("edit-product-brand").selectedIndex = 0;

            for (let i = 1; i < 6; i++) {
                let element = document.getElementById("edit-product-prop" + i);
                if (element.tagName.toLowerCase() === 'input') {
                    element.value = '';
                } else {
                    //element is a select
                    element.selectedIndex = 0;
                }
            }

            document.getElementById("my-drawer-4").checked = true;
        });
    }

    /*
     * Au clic sur add-product-fom-shop on regarde si un produit existant a été ajouté, sinon on en créé un
     */
    let addProductFromShop = document.getElementById('add-product-from-shop');
    if( document.body.contains(addProductFromShop) ) {
        addProductFromShop.addEventListener("click", function () {

            let postObj = {
                _token: document.getElementsByName("_token")[0].value,
                brand_id: document.getElementById("add-product-brand").value,
                name: document.getElementById("add-product-name").value,
                prop1: document.getElementById("add-product-prop1").value,
                prop2: document.getElementById("add-product-prop2").value,
                prop3: document.getElementById("add-product-prop3").value,
                prop4: document.getElementById("add-product-prop4").value,
                prop5: document.getElementById("add-product-prop5").value,
                gtin: document.getElementById("add-product-gtin").value
            }
            let post = JSON.stringify(postObj)

            const url = "/products/add"
            let xhr = new XMLHttpRequest()
            xhr.open('POST', url, true)
            xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8')
            xhr.responseType = 'json';
            xhr.send(post);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    let loop = document.getElementById("loop_index").value;
                    let productSelect = document.getElementById('add-product-from-shop-product-exists-' + loop );
                    productSelect.options[productSelect.options.length] =
                        new Option(xhr.response.brand.name + ' ' + xhr.response.productAdded.name,
                            xhr.response.productAdded.id);
                    productSelect.value = xhr.response.productAdded.id;

                    document.getElementById("modal-link-product").close()
                }
            }
        });
    }

    /*
     * Au clic on montre la modal de liaison de produit
     */
    const triggersLinkProduct = document.querySelectorAll('.link-product');
    triggersLinkProduct.forEach(el => el.addEventListener('click', event => {
        document.getElementById("loop_index").value = event.currentTarget.getAttribute("data-loop-index");
        document.getElementById("add-product-modal-title").innerText = event.currentTarget.getAttribute("data-product-name");
        document.getElementById("add-product-gtin").value = event.currentTarget.getAttribute("data-product-gtin");
        document.getElementById("add-product-url").setAttribute('href', event.currentTarget.getAttribute("data-product-url"));
        document.getElementById("modal-link-product").showModal()
    }));

});
