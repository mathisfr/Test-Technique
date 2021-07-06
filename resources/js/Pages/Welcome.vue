<template>
    <div class="min-h-screen sm:pt-0">
        <div v-if="canLogin" class="px-6 py-4 sm:block bg-white shadow">
            <inertia-link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                Hubspot
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                    Connexion
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                    Inscription
                </inertia-link>
            </template>
        </div>

        <div class="py-12 px-0 flex lg:flex-row flex-col">
            <div class="flex flex-col p-3 flex-1 shadow-xl lg:m-12 m-4 rounded">
                <p class="text-2xl mb-2">Bienvenue sur l'accueil de votre plateforme de visualisation</p>
                <p>Vous pouvez vous connecter pour pouvoir accéder à l'application où vous enregistrez si vous n'avez pas de comptes.</p>
                <img class="justify-self-center py-8 h-96" src="/images/presentation.svg" alt="presentation">
            </div>
            <div class="p-3 flex-1 shadow-xl lg:m-12 m-4 rounded">
                <p class="text-2xl">Quelles données pouvons-nous voir sur l'application ?</p>
                <ul class="list-inside list-disc">
                    <li class="p-2">Le nom de l'entreprise</li>
                    <li class="p-2">Le secteur de l'entreprise</li>
                    <li class="p-2">Le site web de l'entreprise</li>
                    <li class="p-2">Le numéro de téléphone de l'entreprise</li>
                    <li class="p-2">Le pays, ville et zip de l'entreprise</li>
                    <li class="p-2">Le contact associé à l'entreprise</li>
                    <li class="p-2">L'email du contact</li>
                    <li class="p-2">Le nom complet du contact</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
