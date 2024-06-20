import './bootstrap';

import { Grid } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { createIcons, Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users, Pencil
} from 'lucide';

createIcons({
    icons: {
        Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users, Pencil
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const grid = new Grid({
        from: document.getElementById('sourceTable'),
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
            }
        }
    }

    grid.config.store.subscribe(tableStatesListener);
    grid.render(document.getElementById('destinationWrapper'));

});
