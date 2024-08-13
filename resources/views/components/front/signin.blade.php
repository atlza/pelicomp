<x-layout pageTitle="Connexion à votre compte" >
    <section  class="mb-16 h-screen max-h-[900px] flex justify-center">
        <div class="box-login">
            <form action="{{ route('signin-authenticate')  }}" method="post">
                @csrf
                <div class="prose mb-6">
                    <p>Un compte est nécessaire pour ajouter un film ou une offre.</p>
                    <h1>Se connecter</h1>
                </div>
                <label class="form-control w-full mb-6">
                    <div class="label">
                        <span class="label-text">Votre adresse email ?</span>
                    </div>
                    <input type="text" name="email" placeholder="moi@domaine.fr" class="input input-bordered w-full" />
                    <input type="text" name="login" placeholder="Leave empty if your are humain" class="invisible input input-bordered w-full" />
                </label>
                <p class="text-base-300 mb-6">
                    Nous n'utilisons pas de mot de passe, entrez votre email et vous recevrez un lien vous permettant de vous connecter.<br />
                    Ainsi vous êtes tranquilles, vous n'oublierez pas votre mot de passe et personne ne le volera.
                </p>
                <button type="submit" class="btn btn-success mb-6 w-full">Connexion</button>
            </form>
        </div>
    </section>
</x-layout>
