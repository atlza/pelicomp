import './bootstrap';

import { Grid } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { createIcons, Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users
} from 'lucide';

createIcons({
    icons: {
        Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus, MessageCircleQuestion, UserCog, Users
    }
});

document.addEventListener("DOMContentLoaded", function() {
    new Grid({
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
    }).render(document.getElementById('destinationWrapper'));
});

const triggers = document.querySelectorAll('.add-offer');
triggers.forEach(el => el.addEventListener('click', event => {
/*    console.log(event.currentTarget.getAttribute("data-shop"));
    console.log(event.currentTarget.getAttribute("data-product"));*/

    document.getElementById("offer_shop").value = event.currentTarget.getAttribute("data-shop");
    document.getElementById("offer_product").value = event.currentTarget.getAttribute("data-product");

    document.getElementById("add_offer_modal").showModal();
}));
