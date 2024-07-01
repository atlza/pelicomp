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
    Menu
} from 'lucide';

createIcons({
    icons: {
        Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users, Pencil, Menu
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
                            element.selectedIndex = [...element.options].find(o => o.value === property).index;
                        }
                    }
                    document.getElementById("my-drawer-4").checked = true;
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

});
