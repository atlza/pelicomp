<dialog id="my_modal_4" class="modal">
    <div class="modal-box w-2/12 max-w-5xl">
        <h3 class="font-bold text-lg mb-3">Voleuses !</h3>

        <div class="rating rating-lg rating-half text-center">
            <input type="radio" name="rating-10" class="rating-hidden" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-1" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-2" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-1" checked />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-2" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-1" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-2" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-1" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-2" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-1" />
            <input type="radio" name="rating-10" class="bg-orange-400 mask mask-star-2 mask-half-2" />
        </div>

        <div class="divider"></div>

        <div class="modal-action">
            <form method="dialog" >

                <div class="flex flex-wrap mb-2">
                    <div class="w-1/6">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                    </div>
                    <div class="w-4/6 pl-2">Je veux le voir</div>
                    <div class="w-1/6 text-right pl-2">
                        <i class="h-4 w-4" data-lucide="Eye"></i>
                    </div>
                </div>
                <div class="flex flex-wrap mb-2">
                    <div class="w-1/6">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                    </div>
                    <div class="w-4/6 pl-2">Je suis fan</div>
                    <div class="w-1/6 text-right pl-2">
                        <i class="h-4 w-4" data-lucide="Heart"></i>
                    </div>
                </div>
                <div class="flex flex-wrap mb-2">
                    <div class="w-1/6">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-primary checkbox-sm" />
                    </div>
                    <div class="w-4/6 pl-2">Dans ma collection</div>
                    <div class="w-1/6 text-right pl-2">
                        <i class="h-4 w-4" data-lucide="Folder-plus"></i>
                    </div>
                </div>

                <div class="divider"></div>

            </form>
        </div>

        <button class="btn btn-sm w-full">
            Créer une liste
            <i class="ml-2" data-lucide="chevron-down"></i>
        </button>
    </div>
</dialog>
