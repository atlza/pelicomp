import './bootstrap';

import { Grid } from "gridjs";
import "gridjs/dist/theme/mermaid.css";

import { createIcons, Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus
} from 'lucide';

createIcons({
    icons: {
        Plus, Aperture, Film, Store, BadgeEuro, Eye, Minus
    }
});



const grid = new Grid({
    columns: ['Name', 'Email', 'Phone Number'],
    data: [
        ["John", "john@example.com", "(353) 01 222 3333"],
        ["Mark", "mark@gmail.com", "(01) 22 888 4444"],
        ["Eoin", "eoin@gmail.com", "0097 22 654 00033"],
        ["Sarah", "sarahcdd@gmail.com", "+322 876 1233"],
        ["Afshin", "afshin@mail.com", "(353) 22 87 8356"]
    ],
    sort: true,
    fixedHeader: true,
}).render(document.getElementById("wrapper"));

const triggers = document.querySelectorAll('.add-offer');
triggers.forEach(el => el.addEventListener('click', event => {
/*    console.log(event.currentTarget.getAttribute("data-shop"));
    console.log(event.currentTarget.getAttribute("data-product"));*/

    document.getElementById("offer_shop").value = event.currentTarget.getAttribute("data-shop");
    document.getElementById("offer_product").value = event.currentTarget.getAttribute("data-product");

    document.getElementById("add_offer_modal").showModal();
}));
