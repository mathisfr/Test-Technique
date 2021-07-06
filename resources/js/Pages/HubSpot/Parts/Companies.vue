<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-col items-center justify-between p-3 lg:flex-row mb-4">
        <img class="w-40" src="/images/blue.png" alt="">  
        <div class="flex flex-col sm:flex-row w-full py-6 lg:py-0">
            <p class="mx-2 flex-1"><span class="font-bold">Entreprise: </span><slot name='name'></slot></p>
            <p class="mx-2 flex-1"><span class="font-bold">Secteur: </span><slot name='sector'></slot></p>
            <p class="mx-2 flex-1"><span class="font-bold">Ville: </span><slot name='city'></slot></p>
            <p class="mx-2 flex-1"><span class="font-bold">Pays: </span><slot name='country'></slot></p>
        </div> 
        <button @click="ClickButton" class="bg-blue-500 text-white hover:bg-blue-700 h-auto py-2 px-6 rounded min-w-max">Voir la fiche</button>
    </div>
</template>

<script>
export default {
    name:'Companies',
    methods:{
        ClickButton(){
            // Envoie un nouvel événement quand le bouton est cliqué pour ouvrir le pop-up
            this.$emit('click-button')
        }
    }
}
</script>

<style>

</style>